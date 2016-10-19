<?php
session_start();

$conn=require_once("../lib/connection.php"); 
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
		header("Location:timve2.php");
	}
	else echo "<script>alert('"."Email hoặc mật khẩu sai,xin thử lại !"."')</script>";
}
 ?>
 <?php include("../template/header.php"); ?>
<!doctype html>
<html>
<title> TRAIN </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../w3/w3.css">
<link rel="stylesheet" href="../w3/font-awesome.min.css">
<style>
body{
background-image: url("images.jpg");
}
</style>
<body>
<div class="w3-row">
<div class="w3-third">
<form class="w3-padding w3-card-4 w3-margin-64 w3-white" action="dangnhap.php" method="POST">
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

</html>