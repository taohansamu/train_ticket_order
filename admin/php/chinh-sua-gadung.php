
<html>
<head>
	<meta charset="utf-8">
	<meta hgatau-equiv="X-UA-Compatible" content="IE=edge">
	<title>chỉnh sửa ga dừng</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<?php 
				$conn=require_once("../lib/connection.php");
				if(isset($_POST["btn_submit"]))
				{
					$machuyen_id=$_POST["machuyen_id"];
					$maga_id=$_POST["maga_id"];
					$machuyen=$_POST["machuyen"];
					$maga=$_POST["maga"];
					$sttdung=$_POST["sttdung"];
					$giodung=$_POST["giodung"];
					$giodi=$_POST["giodi"];
					if($machuyen==""||$maga==""||$giodung==""||$giodi==""||$sttdung=="")echo "Không được để trống trường nào !";
					else
					{
						$sql="update gadung set machuyen='".$machuyen."',maga='".$maga."',giodung='".$giodung."',giodi='".$giodi."',sttdung=".$sttdung." where machuyen='".$machuyen_id."' and maga='".$maga_id."' ";
						$query=pg_query($conn,$sql);
						if($query)header('Location:../pages/gadung.php?id=ud1');
						else header('Location:../pages/gadung.php?id=ud0');
					}
				}
				$machuyen="";
				$maga="";
				$giodung="";
				$giodi="";
				$sttdung="";
				if(isset($_GET["machuyen"]) and isset($_GET["maga"]))
				{
					$machuyen_id=$_GET["machuyen"];
					$maga_id=$_GET["maga"];
					$sql="select * from gadung where machuyen='".$machuyen_id."' and maga='".$maga_id."' ";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$machuyen=$data["machuyen"];
					$maga=$data["maga"];
					$giodung=$data["giodung"];
					$giodi=$data["giodi"];
					$sttdung=$data["sttdung"];
				}
				
			 ?>
			 <form action="chinh-sua-gadung.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin thành phố</caption>
			 		<input type="hidden" name="machuyen_id" value="<?php echo $machuyen_id; ?>">
			 		<input type="hidden" name="maga_id" value="<?php echo $maga_id; ?>">

			 		<tr>
			 			<td>Mã Chuyến</td>
			 			<td><input type="text" name="machuyen" value="<?php echo $machuyen; ?>" ></td>
			 		</tr>
			 		<tr>
			 			<td>Mã Ga</td>
			 			<td><input type="text" name="maga" value="<?php echo $maga; ?>" ></td>
			 		</tr>
			 		<tr>
			 			<td>STT Dừng</td>
			 			<td><input type="text" name="sttdung" value="<?php echo $sttdung; ?>" ></td>
			 		</tr>
			 		<tr>
			 			<td>Giờ Dừng</td>
			 			<td><input type="time" name="giodung" value="<?php echo $giodung; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Giờ Đi</td>
			 			<td><input type="time" name="giodi" value="<?php echo $giodi; ?>"></td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/gadung.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>