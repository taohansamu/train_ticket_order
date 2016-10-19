<?php
session_start();
 ?>
<!doctype html>
<html>
<head>

  <title> TRAIN </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../w3/w3.css">
  <link rel="stylesheet" href="../w3/font-awesome.min.css">
    <script>
  function motchieu (form) {
    window.location.href="timve.php?id=motchieu"
  }
  function khuhoi (form) {
    window.location.href="timve.php?id=khuhoi"
  }
  </script>
  <style>
</head>
body{
background-image: url("../jpg/images.jpg");
}
</style>
<body >

  <?php
  $conn=require_once("../lib/connection.php");
   if(isset($_GET["id"]))
  {
    $id=$_GET["id"];
    if($id=="khuhoi")$show="";
    if($id=="motchieu")$show="disabled";
    $magadi=$_GET["magadi"];
    $magaden=$_GET["magaden"];
    $tgdi=$_GET["tgdi"];
    $tgve=$_GET["tgve"];
  }
  else {$id=""; $magadi=""; $magaden=""; $tgdi="" ;$tgve="";}
   if(isset($_POST["bt_submit"]))
{
  $loaichieu=$_POST["loaichieu"];$_SESSION["loaichieu"]=$_POST["loaichieu"];
  $magadi=$_POST["magadi"];$_SESSION["magadi"]=$_POST["magadi"];
  $magaden=$_POST["magaden"];$_SESSION["magaden"]=$_POST["magaden"];
  $ngaydi=$_POST["tgdi"];$_SESSION["tgdi"]=$_POST["tgdi"];
 if($loaichieu=="khuhoi") {$ngayve=$_POST["tgve"];$_SESSION["tgve"]=$_POST["tgve"];}
}
?>
<?php include("../template/header.php"); ?>
<div class="w3-row">
<div class="w3-third">
<form name="FORM" class="w3-padding w3-card-4 w3-margin-4 w3-white" method="POST">
  <h2 class="w3-teal w3-center">Tìm vé</h2>
  <div class="w3-group">
    <div class="w3-row">
  <div class="w3-half">
    <label class="w3-checkbox">
      <input type="radio" name="loaichieu" value="motchieu" onClick="motchieu(FORM)" <?php if($id=="khuhoi")echo "";else echo "checked"; ?>>
      <div class="w3-checkmark"></div> Một chiều
    </label><br>
  </div>
  <div class="w3-half">
    <label class="w3-checkbox">
        <input type="radio" name="loaichieu" value="khuhoi" onClick="khuhoi(FORM)" <?php if($id=="motchieu")echo "";else echo "checked"; ?> >
        <div class="w3-checkmark"></div> Khứ hồi
      </label><br>
  </div>
  </div>
  <p>Ga đi</p>
  <?php
    $sql="select maga,tenga from gatau order by tenga";
    $query=pg_query($conn,$sql);
   ?>
  <select name="magadi" id="gadi" >
    <?php while($row=pg_fetch_array($query)){
      ?>
      <option value="<?php echo $row["maga"]; ?>" <?php if($row["maga"]==$_SESSION["magadi"]) echo "selected" ;?>><?php echo $row["tenga"]; ?></option>
      <?php
    } ?>
  </select></div>

  <div class="w3-group">
  <p>Ga đến</p>
  <?php
    $sql="select maga,tenga from gatau order by tenga desc";
    $query=pg_query($conn,$sql);
   ?>
  <select name="magaden" id="gaden" >
    <?php while($row=pg_fetch_array($query)){
      ?>
      <option value="<?php echo $row["maga"]; ?>" <?php if($row["maga"]==$_SESSION["magaden"]) echo "selected" ;?>><?php echo $row["tenga"]; ?></option>
      <?php
    } ?>
  </select></div>

	<div class="w3-group">
	<p>Ngày Đi</p>
	  <input type="date" name="tgdi" value=<?php echo date("Y-m-d"); ?>>
	  </div>
	<div class="w3-group">
	<p>Ngày Về</p>
	  <input type="date" name="tgve" value=<?php echo date("Y-m-d");?> <?php echo $show; ?> >
	  </div>

	<input class="w3-submit w3-teal w3-section" type="submit" name="bt_submit" value="Tìm Vé">
</form>
</div>  <br>
<!-- kêt quả tìm kiếm -->
<div class="w3-third">
<?php
if(isset($_POST["bt_submit"]))
{
 $sql="select machuyen from gadung where maga='".$magadi."' INTERSECT select machuyen from gadung where maga='".$magaden."'";
?>

<!-- Chiều Đi -->
<form action="ketquatimve.php" method="POST" role="form">
  <legend>Chọn chuyến tàu và toa để xem vé</legend>
  <div class="form-group">
    <h4>Chuyến Tàu <?php echo get_name_ga($magadi,$conn),"-",get_name_ga($magaden,$conn); ?></h4>

  </div>

<table class="table table-hover">
  <!-- Cac chuyen -->
  <thead><tr>
    <?php $query=pg_query($conn,$sql);
      while($row=pg_fetch_array($query))
      {
        $machuyen=$row["machuyen"];
        if(chuyendihayve($conn,$machuyen,$magadi,$magaden))
        {
       ?>
      <th><label>
        <input type="radio" name="chuyendi" id="input" value="<?php echo $machuyen; ?>">
        <?php echo $machuyen; ?>
      </label></th>
    <?php }
      } ?>
  </thead>
<!-- Thong tin chuyen tau -->
    </tr>
  <tbody>
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
                <input type="radio" name="toadi" id="inputMatoa" value="<?php echo $tmp; ?>" <?php echo $show; ?>>
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
<?php
}
 ?>

<!-- Chiều khứ hồi -->
<?php
if($loaichieu=="khuhoi")
{//ngoac mo dau
 $sql="select machuyen from gadung where maga='".$magadi."' INTERSECT select machuyen from gadung where maga='".$magaden."'";
 ?>
<div class="form-group">
    <h4>Chuyến Tàu <?php echo get_name_ga($magaden,$conn),"-",get_name_ga($magadi,$conn); ?></h4>
  </div>
<table class="table table-hover">
  <thead><tr>
    <?php $query=pg_query($conn,$sql);
      while($row=pg_fetch_array($query))
      {
        $machuyen=$row["machuyen"];
        if(chuyendihayve($conn,$machuyen,$magaden,$magadi))
        {
       ?>

      <th><label>
        <input type="radio" name="chuyenve" id="input" value="<?php echo $machuyen; ?>" >
        <?php echo $machuyen; ?>
      </label></th>
    <?php }
      } ?>
  </thead>

    </tr>
  <tbody>
    <tr>
    <?php $query=pg_query($conn,$sql);
      while($row=pg_fetch_array($query))
      {
        $machuyen=$row["machuyen"];
        if(chuyendihayve($conn,$machuyen,$magaden,$magadi))
        {
       ?>
      <td>
        <?php tgdive($conn,$machuyen,$magaden,$magadi,$ngayve); ?>
    </td>
      <?php }
      } ?>
      </tr>
      <tr>
    <?php $query=pg_query($conn,$sql);
      while($row=pg_fetch_array($query))
      {
        $machuyen=$row["machuyen"];
        if(chuyendihayve($conn,$machuyen,$magaden,$magadi))
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
            $soghetrong=soghe_available_toa($conn,$tmp,$ngayve);
            if($soghetrong==0)$show="disabled";
            else $show="checked";
            ?>
            <div class="radio">
              <label>
                <input type="radio" name="toave" id="inputMatoa" value="$tmp" <?php echo $show; ?>>
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
<input type="hidden" name="loaichieu" id="inputLoaichieu" class="form-control" value="<?php echo $loaichieu; ?>">
<button type="submit" class="btn btn-primary" name="xacnhan">Xác Nhận</button>
</form>
 </div>
</body>
</html>
<!-- CAC HAM PHP -->
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
 ?>
