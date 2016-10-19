<!doctype html>
<html>

<title> TRAIN </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
body{
background-image: url("images.jpg");
}
</style>
<html>
<body>
<body >
<div class="w3-topnav w3-center w3-theme w3-card-4 w3-teal w3-top">
  <a href="home.php"><i class="fa fa-home w3-xlarge"></i></a>
  <a href="gioithieu.php">Giới Thiệu</a>
  <a href="timve.php">Tìm vé</a>
  <a href="giotau.php">Giờ tàu</a>
  <a href="javascript:void(0)">Link 4</a>
</div>
<br><br>

<div class="w3-row w3-margin-8 w3-animate-opacity">
<div class="w3-third">
<form class="w3-padding w3-card-4 w3-margin-4 w3-white">
  <h2 class="w3-teal w3-center">Tìm vé</h2>
  <div class="w3-group">
  <p>Ga đi</p>
  <select name="Ga di">
    <option value="Ha Noi">Hà Nội</option>
    <option value="Hai Phong">Hải Phòng</option>
    <option value="Hai Duong">Hải Dương</option>
    <option value="Da Nang">Đà Nẵng</option>
  </select></div>
  
  <div class="w3-group">
  <p>Ga đến</p>
  <select name="Ga den">
    <option value="Ha Noi">Hà Nội</option>
    <option value="Hai Phong">Hải Phòng</option>
    <option value="Hai Duong">Hải Dương</option>
    <option value="Da Nang">Đà Nẵng</option>
  </select></div>
  <div class="w3-row">
  <div class="w3-half">
    <label class="w3-checkbox">
      <input type="radio" name="loaive" value="motchieu" checked>
      <div class="w3-checkmark"></div> Một chiều
    </label><br>
	</div>
  <div class="w3-half">
    <label class="w3-checkbox">
      <input type="radio" name="loaive" value="khuhoi">
      <div class="w3-checkmark"></div> Khứ hồi
    </label><br>
	</div>
	</div>
	
	<div class="w3-group">
	<p>Thời gian đi</p>
	  <input type="datetime-local" name="tgdi">
	  </div>
	<div class="w3-group">
	<p>Thời gian về</p>
	  <input type="datetime-local" name="tgden">
	  </div>
	
	<button class="w3-btn w3-teal w3-section">Tìm kiếm</button>
</form> 
</div>


 </div>
</body>
</html>