
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
					$matp=$_POST["matp"];
					$tentp=$_POST["tentp"];
					if($matp=="" OR $tentp=="")echo "Không được để trống trường nào !";
					else
					{
						$sql="update ttp set matp='".$matp."',tentp='".$tentp."' where matp='".$id."'";
						$query=pg_query($conn,$sql);
						if(!$query){
										header('Location:../pages/thanhpho.php?id=ud0');
									}
									else
									header('Location:../pages/thanhpho.php?id=ud1');
									
					}
				}
				$matp="";
				$tentp="";
				if(isset($_GET["id"]))
				{
					$id=$_GET["id"];
					$sql="select * from ttp where matp='".$id."'";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$matp=$data["matp"];
					$tentp=$data["tentp"];
				}
				
			 ?>
			 <form action="chinh-sua-tp.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin thành phố</caption>
			 		<input type="hidden" name="id" value="<?php echo $id; ?>">
			 		<tr>
			 			<td>Mã TP</td>
			 			<td><input type="text" name="matp" value="<?php echo $matp; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Tên TP</td>
			 			<td><input type="text" name="tentp" value="<?php echo $tentp; ?>"></td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/thanhpho.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>