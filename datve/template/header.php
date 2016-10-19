<?php session_start(); ?>
<!doctype html>
<html>
<title> TRAIN </title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
 
<!-- Optional theme -->
<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
 
<!-- Latest compiled and minified JavaScript -->
<link rel="stylesheet" href="../w3/w3.css">
<link rel="stylesheet" href="../w3/font-awesome.min.css">
<script src="../js/bootstrap.min.js"></script>
<div class="w3-topnav w3-center w3-theme w3-card-4 w3-teal w3-top">
  <a href="home.php"><i class="fa fa-home w3-xlarge"></i></a>
  <a href="gioithieu.php">Giới Thiệu</a>
  <a href="timve2.php">Tìm vé</a>
  <a href="giotau_giave.php">Giờ Tàu-Giá Vé</a>
  <?php if(!isset($_SESSION["username"])){ ?>
  <a href="dangnhap.php">Đăng Nhập</a>
  <a href="dangkitk.php">Đăng Kí tài khoản</a>
  <?php }
  else {
   ?>
  <a href="giove.php">Giỏ Vé</a>
	<a href="thongtin_user.php"><?php echo "Khách Hàng ","<b>",$_SESSION["username"],"</b>"; ?></a>
	<a href="dangxuat.php">Đăng Xuất</a>
	<?php } ?>
 <!--  <a href="giave.php">Giá Vé</a> -->
<!--   <a href="javascript:void(0)">Link 3</a>
  <a href="javascript:void(0)">Link 4</a> -->
</div>
<br><br>