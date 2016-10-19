<?php 
session_start();
if(!isset($_SESSION['username']))
  header('Location:login.php');
 ?>
<html>
<head>
	<meta charset="utf-8">
	<title>UPDATE admin</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<?php 
				$conn=require_once("../lib/connection.php");
				if(isset($_POST["btn_submit"]))
				{
					$id=$_SESSION['username'];
					$sql="select * from admin where login='".$id."'";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$login_old=$data["login"];
					$email_old=$data["email"];
					$password_old=$data["password"];
					$login=$_POST["login"];
					$email=$_POST["email"];
					$password_new=$_POST["password_new"];
					$password_submit=$_POST["password_submit"];
					$password_repeat=$_POST["password_repeat"];
					if($login==""||$email==""||$password_new==""||$password_submit==""||$password_repeat=="")
						echo "Không được để trống trường nào !";
					else
					{
						if($password_new!=$password_repeat) echo "mật khẩu xác nhận và mật khẩu mới không trùng nhau !";
						else if($password_submit!=$password_old)echo "mật khẩu cũ không đúng !";
						else {$sql="update admin set login='".$login."',email='".$email."',password='".$password_new."'";
							$query=pg_query($conn,$sql);
							if($query){
									header('Location:../pages/thongtinadmin.php?id=ud1');
								}
								else header('Location:../pages/thongtinadmin.php?id=ud0');
							}
					}
				}
				$login="";
				$email="";
				$password="";
				if(isset($_SESSION['username']))
				{
					$id=$_SESSION['username'];
					$sql="select * from admin where login='".$id."'";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$login=$data["login"];
					$email=$data["email"];
					$password=$data["password"];
				}
				
			 ?>
			 <form action="chinh-sua-admin.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin admin</caption>
			 		<tr>
			 			<td>Tên đăng nhập </td>
			 			<td><input type="text" name="login" value="<?php echo $login; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Email</td>
			 			<td><input type="text" name="email" value="<?php echo $email; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Nhập mật mới</td>
			 			<td><input type="text" name="password_new"></td>
			 		</tr>
			 		<tr>
			 			<td>Xác nhận mật khẩu mới</td>
			 			<td><input type="password" name="password_repeat" ></td>
			 		</tr>
			 		<tr>
			 			<td>Nhập lại mật cũ</td>
			 			<td><input type="password" name="password_submit"></td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/thongtinadmin.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>