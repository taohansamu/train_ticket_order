
<html>
<head>
	<meta charset="utf-8">
	<meta hgatau-equiv="X-UA-Compatible" content="IE=edge">
	<title>UPDATE gatau</title>
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
					$maga=$_POST["maga"];
					$tenga=$_POST["tenga"];
					$matp=$_POST["matp"];
					$diachi=$_POST["diachi"];
					if($maga=="" OR $tenga=="" OR $matp=="" OR $diachi=="")echo "Không được để trống trường nào !";
					else
					{
						$sql="update gatau set maga='".$maga."',tenga='".$tenga."',matp='".$matp."',diachi='".$diachi."' where maga='".$id."'";
						$query=pg_query($conn,$sql);
						if($query)header('Location:../pages/ga.php?id=ud1');
						else header('Location:../pages/ga.php?id=ud0');;
					}
				}
				$maga="";
				$tenga="";
				$matp="";
				$diachi="";
				if(isset($_GET["id"]))
				{
					$id=$_GET["id"];
					$sql="select * from gatau where maga='".$id."'";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$maga=$data["maga"];
					$tenga=$data["tenga"];
					$matp=$data["matp"];
					$diachi=$data["diachi"];
				}
				
			 ?>
			 <form action="chinh-sua-ga.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin thành phố</caption>
			 		<input type="hidden" name="id" value="<?php echo $id; ?>">
			 		<tr>
			 			<td>Mã Ga</td>
			 			<td><input type="text" name="maga" value="<?php echo $maga; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Tên Ga</td>
			 			<td><input type="text" name="tenga" value="<?php echo $tenga; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Mã TP</td>
			 			<td><input type="text" name="matp" value="<?php echo $matp; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Địa Chỉ</td>
			 			<td><input type="text" name="diachi" value="<?php echo $diachi; ?>"></td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/ga.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>