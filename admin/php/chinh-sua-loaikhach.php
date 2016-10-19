
<html>
<head>
	<meta charset="utf-8">
	<title>UPDATE loaikhach</title>
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
					$maloaikhach=$_POST["maloaikhach"];
					$tenloaikhach=$_POST["tenloaikhach"];
					$phantramgiamgia=$_POST["phantramgiamgia"];
					if($maloaikhach=="" OR $tenloaikhach=="" OR $phantramgiamgia=="")echo "Không được để trống trường nào !";
					else
					{
						$sql="update loaikhach set maloaikhach='".$maloaikhach."',tenloaikhach='".$tenloaikhach."',phantramgiamgia='".$phantramgiamgia."' where maloaikhach='".$id."'";
						$query=pg_query($conn,$sql);
						if($query)header('Location:../pages/loaikhach.php?id=ud1');
						else header('Location:../pages/loaikhach.php?id=ud0');;
					}
				}
				$maloaikhach="";
				$tenloaikhach="";
				$phantramgiamgia="";
				if(isset($_GET["id"]))
				{
					$id=$_GET["id"];
					$sql="select * from loaikhach where maloaikhach='".$id."'";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$maloaikhach=$data["maloaikhach"];
					$tenloaikhach=$data["tenloaikhach"];
					$phantramgiamgia=$data["phantramgiamgia"];
				}
				
			 ?>
			 <form action="chinh-sua-loaikhach.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin thành phố</caption>
			 		<input type="hidden" name="id" value="<?php echo $id; ?>">
			 		<tr>
			 			<td>Mã Loại Khách</td>
			 			<td><input type="text" name="maloaikhach" value="<?php echo $maloaikhach; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Tên Loại Khách</td>
			 			<td><input type="text" name="tenloaikhach" value="<?php echo $tenloaikhach; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Phần Trăm Giảm Giá</td>
			 			<td><input type="number" name="phantramgiamgia" value="<?php echo $phantramgiamgia; ?>"></td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/loaikhach.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>