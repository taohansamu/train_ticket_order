
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>UPDATE TTP</title>
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
					$maloaitoa=$_POST["maloaitoa"];
					$tenloaitoa=$_POST["tenloaitoa"];
					$heso=$_POST["heso"];
					if($maloaitoa=="" OR $tenloaitoa=="" OR $heso=="")echo "Không được để trống trường nào !";
					else
					{
						$sql="update loaitoa set maloaitoa='".$maloaitoa."',tenloaitoa='".$tenloaitoa."',heso=".$heso." where maloaitoa='".$id."'";
						$query=pg_query($conn,$sql);
						if(!$query){
										header('Location:../pages/loaitoa.php?id=ud0');
									}
									else
									header('Location:../pages/loaitoa.php?id=ud1');
									
					}
				}
				$maloaitoa="";
				$tenloaitoa="";
				$heso="";
				if(isset($_GET["id"]))
				{
					$id=$_GET["id"];
					$sql="select * from loaitoa where maloaitoa='".$id."'";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$maloaitoa=$data["maloaitoa"];
					$tenloaitoa=$data["tenloaitoa"];
					$heso=$data["heso"];
				}
				
			 ?>
			 <form action="chinh-sua-loaitoa.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin thành phố</caption>
			 		<input type="hidden" name="id" value="<?php echo $id; ?>">
			 		<tr>
			 			<td>Mã TP</td>
			 			<td><input type="text" name="maloaitoa" value="<?php echo $maloaitoa; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Tên TP</td>
			 			<td><input type="text" name="tenloaitoa" value="<?php echo $tenloaitoa; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Hệ Số Nhân</td>
			 			<td><input type="number" step=0.25 name="heso" value="<?php echo $heso; ?>"></td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/loaitoa.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>