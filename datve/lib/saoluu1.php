<!-- sao luu cua function.php -->
<?php
function get_stt_toa($conn,$matoa)
{
  $sql="select stttoa from toatau where matoa='".$matoa."'";
  $query=pg_query($conn,$sql);
  $row=pg_fetch_array($query);
  return $row["stttoa"];
}
function chuyendihayve($conn,$machuyen,$magadi,$magaden)
{
  $sql="select sttdung from gadung where machuyen='".$machuyen."' and maga='".$magadi."'";
  $query=pg_query($sql);
  $row1=pg_fetch_array($query);
  $sql="select sttdung from gadung where machuyen='".$machuyen."' and maga='".$magaden."'";
  $query=pg_query($sql);
  $row2=pg_fetch_array($query);
  return $row2["sttdung"]>$row1["sttdung"]?1:0;
  // tra ve 1 tuc la chuyen tau di,nguoc lai la chuyen tau den
}
function tgdive($conn,$machuyen,$magadi,$magaden,$ngaydi)
{
  $sql="select giodi from gadung where machuyen='".$machuyen."' and maga='".$magadi."'";
  $query=pg_query($conn,$sql);
  $row=pg_fetch_array($query);
  $giodi=$row["giodi"];
  $sql="select giodung from gadung where machuyen='".$machuyen."' and maga='".$magaden."'";
  $query=pg_query($conn,$sql);
  $row=pg_fetch_array($query);
  $gioden=$row["giodung"];
  echo "<b>Ngày Đi</b>:",$ngaydi,"<br>";
  echo "<b>Giờ Đi:</b>",$giodi,"<br>","<b>Giờ Đến:</b>",$gioden,"<br>Số ghế trống:",soghe_available_chuyen($conn,$machuyen,$ngaydi);
}
function soghe_available_toa($conn,$matoa,$ngaydi)
{
  $sql="select soluongghe from toatau where matoa='".$matoa."'";
  $query=pg_query($conn,$sql);
  $row=pg_fetch_array($query);
  $slg=$row["soluongghe"];
  $sql="select count(mave) as sv from vetau where matoa='".$matoa."' and ngaydi='".$ngaydi."'";
  $query=pg_query($conn,$sql);
  $row=pg_fetch_array($query);
  $sv=$row["sv"];
  return ($slg-$sv);
}
function soghe_available_chuyen($conn,$machuyen,$ngaydi)
{
  $sum=0;
  $sql="select matoa from toatau where machuyen='".$machuyen."'";
  $query=pg_query($conn,$sql);
  while($row=pg_fetch_array($query))
  {
    $tmp=$row["matoa"];
    $sum=$sum+soghe_available_toa($conn,$tmp,$ngaydi);
  }
  return $sum;
}
function get_name_ga($id,$conn)
  {
      $sql="select * from gatau where maga='".$id."';";
      $tmp=pg_query($conn,$sql);
      if(!$tmp)echo "co loi xay ra";
      $row=pg_fetch_array($tmp);
      return $row["tenga"];
  }
function templade1($conn,$magadi,$magaden,$ngaydi,$radio_chuyen,$radio_toa)
{
   $sql="select machuyen from gadung where maga='".$magadi."' INTERSECT select machuyen from gadung where maga='".$magaden."'";

 ?>
<div class="form-group">
    <h4>Chuyến Tàu <?php echo get_name_ga($magadi,$conn),"-",get_name_ga($magaden,$conn); ?></h4>

  </div>
<table class="table table-hover">
  <!-- Liet ke cac chuyen tau -->
  <thead><tr>
    <?php $query=pg_query($conn,$sql);
      while($row=pg_fetch_array($query))
      {
        $machuyen=$row["machuyen"];
        if(chuyendihayve($conn,$machuyen,$magadi,$magaden))
        {
       ?>
      <th><b><?php echo $machuyen; ?></b></th>
    <?php }
      } ?>
  </thead>
    </tr>
  <tbody>
    <!-- Thong tin chuyen tau -->
    <tr>
    <?php $query=pg_query($conn,$sql);
      while($row=pg_fetch_array($query))
      {
        $machuyen=$row["machuyen"];
        if(chuyendihayve($conn,$machuyen,$magadi,$magaden))
        {
       ?>

      <td>
        <?php tgdive($conn,$machuyen,$magadi,$magaden,$ngaydi); ?>
    </td>

      <?php }
      } ?>
      </tr>
      <!-- Liet ke cac toa tau -->
      <tr>
    <?php $query=pg_query($conn,$sql);
      while($row=pg_fetch_array($query))
      {
        $machuyen=$row["machuyen"];
        if(chuyendihayve($conn,$machuyen,$magadi,$magaden))
        {
       ?>

      <td>
        <?php
          $sql="select matoa from toatau where machuyen='".$machuyen."'";
          $query=pg_query($conn,$sql);
          while($row=pg_fetch_array($query))
          {
            $tmp=$row["matoa"];
            $stttoa=get_stt_toa($conn,$tmp);
            $soghetrong=soghe_available_toa($conn,$tmp,$ngaydi);
            if($soghetrong==0)$show="disabled";
            else $show="";
            ?>
            <div class="radio">
              <label>
                <input type="radio" name="<?php echo $radio_toa; ?>" id="inputMatoa" value="<?php echo $tmp; ?>" <?php echo $show; ?>>
                <?php echo "<b>Toa ",$stttoa,"</b>-số ghế trống:",$soghetrong; ?>
              </label>
            </div>
            <?php
          }
        ?>
    </td>

      <?php }
      } ?>
      </tr>
  </tbody>
</table>
<?php } ?>