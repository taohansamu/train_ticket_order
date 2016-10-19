
<!-- Sao luu cua timve2.php -->
<?php
session_start();
 ?>
<!doctype html>
<?php include '../lib/function.php' ;?>
<html>
<head>

  <title> TRAIN </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../w3/w3.css">
  <link rel="stylesheet" href="../w3/font-awesome.min.css">
    <script>
  function motchieu (form) {
    window.location.href="timve2.php?id=motchieu"
  }
  function khuhoi (form) {
    window.location.href="timve2.php?id=khuhoi"
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
   ?>
   <?php
if(isset($_POST["bt_submit"]))
{
  $loaichieu=$_POST["loaichieu"];$_SESSION["loaichieu"]=$_POST["loaichieu"];
  $magadi=$_POST["magadi"];$_SESSION["magadi"]=$_POST["magadi"];
  $magaden=$_POST["magaden"];$_SESSION["magaden"]=$_POST["magaden"];
  $ngaydi=$_POST["tgdi"];$_SESSION["tgdi"]=$_POST["tgdi"];
 if($loaichieu=="khuhoi") {$ngayve=$_POST["tgve"];$_SESSION["tgve"]=$_POST["tgve"];}
 $sql="select machuyen from gadung where maga='".$magadi."' INTERSECT select machuyen from gadung where maga='".$magaden."'";
}
?>
<?php include("../template/header.php"); ?>
<div class="w3-row">
<div class="w3-third">

  <!-- Form 1 -->
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
  <!-- GA DI -->
  <p>Ga đi</p>
  <?php
    $sql="select maga,tenga from gatau order by tenga";
    $query=pg_query($conn,$sql);
   ?>
  <select name="magadi" id="gadi" >
    <?php while($row=pg_fetch_array($query)){
      ?>
      <option value="<?php echo $row["maga"]; ?>" <?php if($row["maga"]==$_SESSION["magadi"])echo "selected"; ?>><?php echo $row["tenga"]; ?></option>
      <?php
    } ?>
  </select></div>
<!-- GA DEN -->
  <div class="w3-group">
  <p>Ga đến</p>
  <?php
    $sql="select maga,tenga from gatau order by tenga desc";
    $query=pg_query($conn,$sql);
   ?>
  <select name="magaden" id="gaden" >
    <?php while($row=pg_fetch_array($query)){
      ?>
      <option value="<?php echo $row["maga"]; ?>" <?php if($row["maga"]==$_SESSION["magaden"])echo "selected"; ?>><?php echo $row["tenga"]; ?></option>
      <?php
    } ?>
  </select></div>
<!-- NGAY DI -->
	<div class="w3-group">
	<p>Ngày Đi</p>
	  <input type="date" name="tgdi" value=<?php if(isset($_SESSION["tgdi"])) echo $_SESSION["tgdi"];else echo date("Y-m-d"); ?>>
	  </div>
    <!-- NGAY VE -->
	<div class="w3-group">
	<p>Ngày Về</p>
	  <input type="date" name="tgve" <?php echo $show; ?> value=<?php if(isset($_SESSION["tgve"])) echo $_SESSION["tgve"];else echo date("Y-m-d"); ?>>
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
<?php templade1($conn,$magadi,$magaden,$ngaydi,"chuyendi","toadi");
 if($loaichieu=="khuhoi")templade1($conn,$magaden,$magadi,$ngayve,"chuyenve","toave"); ?>
  <input type="hidden" name="loaichieu" id="input" class="form-control" value="<?php echo $loaichieu; ?>">
<button type="submit" class="btn btn-primary" name="xacnhan">Xác Nhận</button>
</form>
<?php } ?>
 </div>
</body>
</html>



