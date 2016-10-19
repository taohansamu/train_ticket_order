<!-- sao luu cua ketquatimkiem.php -->
<?php
session_start();
 ?>
<!-- An nut xac nhan -->
<?php $conn=require_once("../lib/connection.php"); ?>
<!-- Nhan du lieu tu submit -->
<?php if(isset($_SESSION["loaichieu"])) $loaichieu=$_SESSION["loaichieu"];
      if(isset($_SESSION["toadi"])) $toadi=$_SESSION["toadi"];
      if(isset($_SESSION["chuyendi"])) $chuyendi=$_SESSION["chuyendi"];
      if(isset($_SESSION["toave"])) $toave=$_SESSION["toave"];
      if(isset($_SESSION["chuyenve"])) $chuyenve=$_SESSION["chuyenve"];
      if(isset($_SESSION["tgdi"])) $tgdi=$_SESSION["tgdi"];
      if(isset($_SESSION["tgve"])) $tgve=$_SESSION["tgve"];
      if(isset($_SESSION["magadi"])) $magadi=$_SESSION["magadi"];
      if(isset($_SESSION["magaden"])) $magaden=$_SESSION["magaden"];

 ?>
<?php if(isset($_POST["xacnhan"]))

{
  $toadi=$_POST["toadi"];$_SESSION["toadi"]=$toadi;
  if($loaichieu=="khuhoi")
  {
    $toave=$_POST["toave"];$_SESSION["toave"]=$toave;
  }
   
}
  ?>
  <?php include("../template/header.php"); ?>
  <!-- Hien thi danh sach ghe toa di -->
  <br>
  <p>Danh sách ghế trong toa số <?php echo get_info_toa($conn,$toadi,"stttoa"); ?> của chuyến tàu <?php echo get_info_toa($conn,$toadi,"machuyen"); ?></p>
  <table class="table table-hover" border="1">

    <tbody>
      <?php $sttghedau=get_info_toa($conn,$toadi,"sttghedau");$sttghecuoi=get_info_toa($conn,$toadi,"sttghecuoi");
      for($i=$sttghedau;;$i++)
      {
       ?>
      <tr>
        <td><?php echo "GHẾ ",$i++,"<br>"; if(tinhtrangghe($conn,$toadi,$magadi,$magaden,$i,$ngaydi))echo "Đã được đặt"; else{?>
          <a href="datve.php?id=<?php echo $i,"&chieu=di"; ?>">Đặt Vé</a></td><?php if($i==$sttghecuoi)break; }?>
        <td><?php echo "GHẾ ",$i++,"<br>"; if(tinhtrangghe($conn,$toadi,$magadi,$magaden,$i,$ngaydi))echo "Đã được đặt"; else{?>
          <a href="datve.php?id=<?php echo $i,"&chieu=di"; ?>">Đặt Vé</a></td><?php if($i==$sttghecuoi)break; }?>
        <td>|<br>|</td>
        <td>|<br>|</td>
        <td><?php echo "GHẾ ",$i++,"<br>"; if(tinhtrangghe($conn,$toadi,$magadi,$magaden,$i,$ngaydi))echo "Đã được đặt"; else{?>
          <a href="datve.php?id=<?php echo $i,"&chieu=di"; ?>">Đặt Vé</a></td><?php if($i==$sttghecuoi)break; }?>
        <td><?php echo "GHẾ ",$i++,"<br>"; if(tinhtrangghe($conn,$toadi,$magadi,$magaden,$i,$ngaydi))echo "Đã được đặt"; else{?>
          <a href="datve.php?id=<?php echo $i,"&chieu=di"; ?>">Đặt Vé</a></td><?php if($i==$sttghecuoi)break; }?>
      </tr>
      <?php } ?>
    </tbody>
  </table>






  <?php 
  function get_info_toa($conn,$matoa,$str)
    {
      $sql="select * from toatau where matoa='".$matoa."' ";
      $query=pg_query($conn,$sql);
      $row=pg_fetch_array($query);
      $stttoa=$row["stttoa"];
      $maloaitoa=$row["maloaitoa"];
      $soluongghe=$row["soluongghe"];
      $machuyen=$row["machuyen"];
      $sql="select sum(soluongghe) as tmp from toatau where machuyen='".$row["machuyen"]."' and stttoa<".$stttoa."";
      $query=pg_query($conn,$sql);
      $row=pg_fetch_array($query);
      if($stttoa==1)$sttghedau=1;
      else $sttghedau=$row["tmp"]+1;
      $sttghecuoi=$sttghedau+$soluongghe-1;
      if($str=="stttoa")return $stttoa;
      if($str=="maloaitoa")return $maloaitoa;
      if($str=="soluongghe")return $soluongghe;
      if($str=="machuyen")return $machuyen;
      if($str=="sttghedau") return $sttghedau;
      if($str=="sttghecuoi") return $sttghecuoi;
    }
    function tinhtrangghe($conn,$matoa,$magadi,$magaden,$soghe,$ngaydi)
    {
      $sql="select count(mave) as tmp from vetau 
            where matoa='".$matoa."',magadi='".$magadi."',magaden='".$magaden."',soghe=".$soghe.",ngaydi='".$ngaydi."'";
      $query=pg_query($conn,$query);
      return pg_num_rows($query);
    }
   ?>
