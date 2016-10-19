<!doctype html>
<html>
<title> TRAIN </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3/w3.css">
<link rel="stylesheet" href="w3/font-awesome.min.css">

<div class="w3-topnav w3-center w3-theme w3-card-4 w3-teal w3-top">
  <a href="home.php"><i class="fa fa-home w3-xlarge"></i></a>
  <a href="gioithieu.php">Giới Thiệu</a>
  <a href="timve.php">Tìm vé</a>
  <a href="giotau.php">Giờ tàu</a>
  <a href="javascript:void(0)">Link 4</a>
</div>
<br><br>

<nav class="w3-sidenav w3-teal w3-margin-8" style="width: 25%">
<ul class="w3-ul">
	<li><h2>Giờ tàu</h2></li>
	<a href="http://localhost/baitapnhom/thongnhat.php">Tàu khách Bắc Nam</a>
	<a href="#">Hà Nội- Lào Cai</a>
	<a href="#">Hà Nội - Hải Phòng</a>
	<a href="#">Sài Gòn- Quy Nhơn</a>
	<li><h2>Giá vé</h2></li>
	<a href="#">Tàu khách Bắc Nam</a>
	<a href="#">Hà Nội- Lào Cai</a>
	<a href="#">Hà Nội - Hải Phòng</a>
	<a href="#">Sài Gòn- Quy Nhơn</a>
</ul>
</nav>

<div style="margin-left: 26%">
<h2 style="color:teal"> Tra tìm giờ tàu Thống Nhất</h2>
<form class="w3-form">
<div class="w3-group">
	<p>Thời gian đi</p>
	 <input type="datetime-local" name="tgdi">
</div>


<div class="w3-group">
<p style="color:teal">Chiều</p>
<select name="chieu">
	<option value="chieu di"> Chiều đi</option>
	<option value="chieu den"> Chiều đến</option>
</select></div>



<div class="w3-group">
<p style="color:teal">Mã tàu</p>
<select name="ma">
	<option value="no1"> No.1</option>
	<option value="no2"> No.2</option>
	<option value="no3"> No.3</option>
	<option value="no4"> No.4</option>
</select></div>


<div class="w3-row">
<div class="w3-half">


 <div class="w3-group">
  <p style="color:teal">Ga đi</p>
  <select name="Ga di">
    <option value="Ha Noi">Hà Nội</option>
    <option value="Hai Phong">Hải Phòng</option>
    <option value="Hai Duong">Hải Dương</option>
    <option value="Da Nang">Đà Nẵng</option>
  </select></div>

</div>

<div class="w3-half">  
 <div class="w3-group">
  <p style="color:teal">Ga đến</p>
  <select name="Ga den">
    <option value="Ha Noi">Hà Nội</option>
    <option value="Hai Phong">Hải Phòng</option>
    <option value="Hai Duong">Hải Dương</option>
    <option value="Da Nang">Đà Nẵng</option>
  </select></div>
  
  </div>
  </div>
  
  <button class="w3-btn w3-teal w3-section">Tìm kiếm</button>
  <footer class="w3-container w3-padding-32 w3-theme w3-center w3-teal">
  <h4>Follow Us</h4>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Rss"><i class="fa fa-rss"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Facebook"><i class="fa fa-facebook"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Twitter"><i class="fa fa-twitter"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-google-plus"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Linkedin"><i class="fa fa-linkedin"></i></a>
  <p>&#169; Copyright whatever</p>
</footer>
</body>
</html>

<form>