
<html>
<head>
	<meta charset="utf-8">
	<meta hgatau-equiv="X-UA-Compatible" content="IE=edge">
	<title>chỉnh sửa chuyến tàu</title>
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
					$machuyen=$_POST["machuyen"];
					$tenchuyen=$_POST["tenchuyen"];
					$sotoa=$_POST["sotoa"];
					$magadau=$_POST["magadau"];
					$magacuoi=$_POST["magacuoi"];
					$giokhoihanh=$_POST["giokhoihanh"];
					$gioketthuc=$_POST["gioketthuc"];
					if($machuyen==""||$tenchuyen==""||$sotoa==""||$magadau==""||$magacuoi==""||$giokhoihanh==""||$gioketthuc=="")echo "Không được để trống trường nào !";
					else
					{
						$sql="update chuyentau set machuyen='".$machuyen."',tenchuyen='".$tenchuyen."',sotoa='".$sotoa."',magadau='".$magadau."',magacuoi='".$magacuoi."',giokhoihanh='".$giokhoihanh."',gioketthuc='".$gioketthuc."' where machuyen='".$id."'";
						$query=pg_query($conn,$sql);
						if($query)header('Location:../pages/chuyentau.php?id=ud1');
						else header('Location:../pages/chuyentau.php?id=ud0');
					}
				}
				$machuyen="";
				$tenchuyen="";
				$sotoa="";
				$magadau="";
				$magacuoi="";
				$giokhoihanh="";
				$gioketthuc="";
				if(isset($_GET["id"]))
				{
					$id=$_GET["id"];
					$sql="select * from chuyentau where machuyen='".$id."'";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$machuyen=$data["machuyen"];
					$tenchuyen=$data["tenchuyen"];
					$sotoa=$data["sotoa"];
					$magadau=$data["magadau"];
					$magacuoi=$data["magacuoi"];
					$giokhoihanh=$data["giokhoihanh"];
					$gioketthuc=$data["gioketthuc"];
				}
				
			 ?>
			 <form action="chinh-sua-chuyentau.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin thành phố</caption>
			 		<input type="hidden" name="id" value="<?php echo $id; ?>">
			 		<tr>
			 			<td>Mã Chuyến</td>
			 			<td><input type="text" name="machuyen" value="<?php echo $machuyen; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Tên Chuyến</td>
			 			<td><input type="text" name="tenchuyen" value="<?php echo $tenchuyen; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Số Toa</td>
			 			<td><input type="number" name="sotoa" value="<?php echo $sotoa; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Mã Ga Đầu</td>
			 			<td><input type="text" name="magadau" value="<?php echo $magadau; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Mã Ga Cuối</td>
			 			<td><input type="text" name="magacuoi" value="<?php echo $magacuoi; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Giờ Khởi Hành</td>
			 			<td><input type="time" name="giokhoihanh" value="<?php echo $giokhoihanh; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Giờ Kết Thúc</td>
			 			<td><input type="time" name="gioketthuc" value="<?php echo $gioketthuc; ?>"></td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/chuyentau.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>