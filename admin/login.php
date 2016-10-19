<?php
session_start();
?>
<html>

<title> TRAIN </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
body{
background-image: url("img/images.jpg");
}
</style>

<body>
	<?php 
		$conn=require_once("lib/connection.php");

		//$conn=pg_connect("host=localhost port=5432 dbname=quanlitau user=postgres password=dinhtao995");
		if(!$conn)print "Không thể kết nối tới database";
		if(isset($_POST["btn_submit"]))
		{	
			$username=$_POST["username"];
			$password=$_POST["password"];
			if($username=="" or $password=="")
			{
				print "Bạn không được bỏ trống trường nào !";
			}
			else
				{
					
					$sql="select * from admin where login='".$username."' and password='".$password."'";
					$query=pg_query($conn,$sql);
					$num_row=pg_num_rows($query);

					if($num_row==0)
	{					        echo '<script language="javascript">';
                echo 'alert("Sai mật khẩu")';
                echo '</script>';
      }
					else
						{
							$_SESSION['username']=$username;
							header('Location:index.php');
						}
				}
		}
	 ?>
	<div class="w3-row">
<div class="w3-third">
	<form method="POST" action="login.php" class="w3-form w3-padding w3-card-4 w3-margin-64 w3-white">
  <h2>Đăng nhập</h2>
  <div class="w3-group">  
    <input class="w3-input" type="text" name="username" style="width:90%" required>
    <label class="w3-label">Tài khoản</label>
  </div>
  <div class="w3-group">      
    <input class="w3-input" type="password" name="password" style="width:90%" required>
    <label class="w3-label">Mật khẩu</label>  </div>
 <button class="w3-btn w3-teal w3-section" name="btn_submit" type="submit" value="Đăng nhập">Đăng nhập</button>

  </form>
</body>
</html>