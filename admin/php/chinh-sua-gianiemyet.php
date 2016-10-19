
<html>
<head>
	<meta charset="utf-8">
	<meta hgatau-equiv="X-UA-Compatible" content="IE=edge">
	<title>chỉnh sửa giá niêm yết</title>
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
					$maloaitoa_id=$_POST["maloaitoa_id"];
					$maloaitoa=$_POST["maloaitoa"];
					$machuyen=$_POST["machuyen"];
					$maga=$_POST["maga"];
					$giatien=$_POST["giatien"];
					if($maloaitoa==""||$machuyen==""||$maga==""||$giatien=="")echo "Không được để trống trường nào !";
					else
					{
						$sql="update gianiemyet set maloaitoa='".$maloaitoa."',machuyen='".$machuyen."',maga='".$maga."',giatien=".$giatien." where machuyen='".$machuyen_id."' and maga='".$maga_id."' and maloaitoa='".$maloaitoa_id."' ";
						$query=pg_query($conn,$sql);
						if($query)header('Location:../pages/gianiemyet.php?id=ud1');
						else header('Location:../pages/gianiemyet.php?id=ud0');
					}
				}
				$maloaitoa="";
				$machuyen="";
				$maga="";
				$giatien="";
				if(isset($_GET["machuyen"]) and isset($_GET["maga"]) and isset($_GET["maloaitoa"]))
				{
					$machuyen_id=$_GET["machuyen"];
					$maga_id=$_GET["maga"];
					$maloaitoa_id=$_GET["maloaitoa"];
					$sql="select * from gianiemyet where machuyen='".$machuyen_id."' and maga='".$maga_id."' and maloaitoa='".$maloaitoa_id."' ";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$maloaitoa=$data["maloaitoa"];
					$machuyen=$data["machuyen"];
					$maga=$data["maga"];
					$giatien=$data["giatien"];
				}
				
			 ?>
			 <form action="chinh-sua-gianiemyet.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin thành phố</caption>
			 		<input type="hidden" name="machuyen_id" value="<?php echo $machuyen_id; ?>">
			 		<input type="hidden" name="maga_id" value="<?php echo $maga_id; ?>">
			 		<input type="hidden" name="maloaitoa_id" value="<?php echo $maloaitoa_id; ?>">
					
			 		<tr>
			 			<td>Mã Chuyến</td>
			 			<td><input type="text" name="machuyen" value="<?php echo $machuyen; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Mã Loại Toa</td>
			 			<td><input type="text" name="maloaitoa" value="<?php echo $maloaitoa; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Mã Ga</td>
			 			<td><input type="text" name="maga" value="<?php echo $maga; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>Giá Tiền</td>
			 			<td><input type="number" name="giatien" step="1000" value="<?php echo $giatien; ?>"> (đơn vị: đồng)</td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/gianiemyet.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>