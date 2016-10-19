<?php
session_start();
$conn=require_once("lib/connection.php"); 
if(!isset($_SESSION["username"])){
if(isset($_POST["submit"]))
{
  $email=$_POST["email"];
  $password=$_POST["password"];
  $sql="select * from khachhang where email='".$email."' and password='".$password."'";
  $query=pg_query($conn,$sql);
  if(pg_num_rows($query)==1)
  {
    $row=pg_fetch_array($query);
    $_SESSION["username"]=$row["tenkhachhang"];
    $_SESSION["email"]=$row["email"];
    $_SESSION["loaikhach"]=$row["maloaikhach"];
    header("Location:pages/timve2.php");
  }
  else echo "<script>alert('"."Email hoặc mật khẩu sai,xin thử lại !"."')</script>";
}
 ?>

<!doctype html>
<html>
<title> TRAIN </title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
 
<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
 
<!-- Latest compiled and minified JavaScript -->
<link rel="stylesheet" href="w3/w3.css">
<link rel="stylesheet" href="w3/font-awesome.min.css">
<script src="js/bootstrap.min.js"></script>
<div class="w3-topnav w3-center w3-theme w3-card-4 w3-teal w3-top">
  <a href="pages/home.php"><i class="fa fa-home w3-xlarge"></i></a>
  <a href="pages/gioithieu.php">Giới Thiệu</a>
  <a href="pages/timve2.php">Tìm vé</a>
  <a href="pages/giotau_giave.php">Giờ Tàu-Giá Vé</a>
  <?php if(!isset($_SESSION["username"])){ ?>
  <a href="pages/dangnhap.php">Đăng Nhập</a>
  <a href="pages/dangkitk.php">Đăng Kí tài khoản</a>
  <?php }
  else {
   ?>
  <a href="pages/thongtin_user.php"><?php echo "Khách Hàng ","<b>",$_SESSION["username"],"</b>"; ?></a>
  <a href="pages/dangxuat.php">Đăng Xuất</a>
  <a href="pages/giove.php">Giỏ Vé</a>
  <?php } ?>
 <!--  <a href="giave.php">Giá Vé</a> -->
<!--   <a href="javascript:void(0)">Link 3</a>
  <a href="javascript:void(0)">Link 4</a> -->
</div>
<body>
<div class="w3-row">
<div class="w3-third">
<form class="w3-padding w3-card-4 w3-margin-64 w3-white" action="index.php" method="POST">
  <h2>Đăng nhập</h2>
  <div class="w3-group">  
    <input name="email" class="w3-input" type="email" style="width:90%" required>
    <label class="w3-label">Email</label>
  </div>
  <div class="w3-group">      
    <input name="password" class="w3-input" type="password" style="width:90%" required>
    <label class="w3-label">Mật khẩu</label>  </div>
  <button name="submit" class="w3-btn w3-teal w3-section">Đăng nhập</button>
</form>


</div>
</div>
</body>
<br><br>
<?php }
else header("Location:pages/timve2.php");
 ?>