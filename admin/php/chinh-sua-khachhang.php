
<html>
<head>
	<meta charset="utf-8">
	<meta hgatau-equiv="X-UA-Compatible" content="IE=edge">
	<title>chỉnh sửa khách hàng</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<?php 
				$conn=require_once("../lib/connection.php");
				if(isset($_POST["btn_submit"]))
				{
					$id=$_POST["id"];
					$email=$_POST["email"];
					$tenkhachhang=$_POST["tenkhachhang"];
					$sdt=$_POST["sdt"];
					$diachi=$_POST["diachi"];
					$maloaikhach=$_POST["maloaikhach"];
					if($email==""||$tenkhachhang==""||$sdt==""||$diachi==""||$maloaikhach=="")echo "Không được để trống trường nào !";
					else
					{
						$sql="update khachhang set email='".$email."',tenkhachhang='".$tenkhachhang."',sdt='".$sdt."',diachi='".$diachi."',maloaikhach='".$maloaikhach."' where email='".$id."'";
						$query=pg_query($conn,$sql);
						if($query)header('Location:../pages/khachhang.php?id=ud1');
						else header('Location:../pages/khachhang.php?id=ud0');
					}
				}
				$email="";
				$tenkhachhang="";
				$sdt="";
				$diachi="";
				$maloaikhach="";
				if(isset($_GET["id"]))
				{
					$id=$_GET["id"];
					$sql="select * from khachhang where email='".$id."'";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$email=$data["email"];
					$tenkhachhang=$data["tenkhachhang"];
					$sdt=$data["sdt"];
					$diachi=$data["diachi"];
					$maloaikhach=$data["maloaikhach"];
				}
				
			 ?>
			 <form action="chinh-sua-khachhang.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin khách hàng</caption>
			 		<input type="hidden" name="id" value="<?php echo $id; ?>">
			 		<tr>
			 			<td>Tên Khách Hàng</td>
			 			<td><input type="text" name="tenkhachhang" value="<?php echo $tenkhachhang; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Email</td>
			 			<td><input type="text" name="email" value="<?php echo $email; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>SĐT</td>
			 			<td><input type="number" name="sdt" value=<?php echo $sdt; ?>></td>
			 		</tr>
			 		<tr>
			 			<td>Địa Chỉ</td>
			 			<td><input type="text" name="diachi" value="<?php echo $diachi; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Mã Loại Khách</td>
			 			<td><input type="text" name="maloaikhach" value="<?php echo $maloaikhach; ?>"></td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/khachhang.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>