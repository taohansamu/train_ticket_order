<?php 
session_start();
if(!isset($_SESSION['username']))
  header('Location:../login.php');
 ?>



<!doctype html>
<html>
<title> TRAIN </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">


<style>
a:link {  text-decoration: none}
body{
background-image: url("../img/1.jpg");
background-repeat: no-repeat;
}
</style>
<div class=" w3-center w3-theme w3-card-4 w3-teal  w3-top">
  <h1><a href="../index.php">QUẢN LÍ ĐƯỜNG SẮT </a> </h1>
</div>
<br><br><br>

<div class="w3-container w3-center w3-margin-top">    
  <div class="w3-row">
    <div class="w3-col m3">
      <div class="w3-card-2  w3-teal">
    
        <div class="w3-container">
     <h4><?php print "Xin Chào, ";echo $_SESSION['username'];?></h4>
         <p><img src="../img/avatar.png" class="w3-circle" height="75" width="75" alt="Avatar"></p>
        </div>
      
      <div class="w3-row">
        <div class="w3-half">
          <a href="thongtinadmin.php"><button type="button" class="w3-btn w3-white"> Thông tin </button></a>
        </div>
        <div class="w3-half">
          <a href="../php/dangxuat.php"><button type="button" class="w3-btn w3-white"> Đăng xuất </button></a>
        </div>
      </div>
    <br>
      </div>
      <br>
  
     
    <ul class="w3-ul  w3-card-2" >
    <li class="w3-teal"><a href="thanhpho.php">Thành phố</a></li>  
    <li class="w3-teal"><a href="ga.php">Ga tàu </a></li>    
    <li class="w3-teal"><a href="chuyentau.php">Chuyến tàu</a></li> 
    <li class="w3-teal"><a href="gadung.php">Ga dừng</a></li>    
    <li class="w3-teal"><a href="loaitoa.php">Loại toa</a></li>
    <li class="w3-teal"><a href="toatau.php">Toa tàu</a></li>  
    <li class="w3-teal"><a href="loaikhach.php">Loại khách</a></li>
    <li class="w3-teal"><a href="khachhang.php">Khách Hàng</a></li> 
    <li class="w3-teal"><a href="gianiemyet.php">Giá niêm yết</a></li>
    <li class="w3-teal"><a href="bc_theongay.php">Thống Kê</a></li>
    </ul>
  </div>