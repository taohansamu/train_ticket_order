
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
					$stttoa=$_POST["stttoa"];
					$maloaitoa=$_POST["maloaitoa"];
					$soluongghe=$_POST["soluongghe"];
					if($machuyen==""||$stttoa==""||$maloaitoa==""||$soluongghe=="")echo "Không được để trống trường nào !";
					else
					{
						$matoa=str_replace(" ","",$machuyen."-".$stttoa);
						$sql="update toatau set matoa='".$matoa."',machuyen='".$machuyen."',stttoa=".$stttoa.",maloaitoa='".$maloaitoa."',soluongghe='".$soluongghe."' where matoa='".$id."';";
						$query=pg_query($conn,$sql);
						//echo $sql;
						// if($query)echo "thanh cong cmnr !";
						// else echo "that bai la me thanh cong !";
						if($query)header('Location:../pages/toatau.php?id=ud1');
						else header('Location:../pages/toatau.php?id=ud0');
					}
				}
				$machuyen="";
				$stttoa="";
				$maloaitoa="";
				$soluongghe="";
				if(isset($_GET["id"]))
				{
					$id=$_GET["id"];
					$sql="select * from toatau where matoa='".$id."'";
					$query=pg_query($conn,$sql);
					$data=pg_fetch_array($query);
					$machuyen=$data["machuyen"];
					$stttoa=$data["stttoa"];
					$maloaitoa=$data["maloaitoa"];
					$soluongghe=$data["soluongghe"];
				}
				
			 ?>
			 <form action="chinh-sua-toatau.php" method="POST">
			 	<table class="table">
			 		<caption>Chỉnh sửa thông tin thành phố</caption>
			 		<input type="hidden" name="id" value="<?php echo $id; ?>">
			 		<tr>
			 			<td>Mã Chuyến</td>
			 			<td><input type="text" name="machuyen" value="<?php echo $machuyen; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>STT TOA</td>
			 			<td><input type="number" name="stttoa" value="<?php echo $stttoa; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>MÃ LOẠI TOA</td>
			 			<td><input type="text" name="maloaitoa" value="<?php echo $maloaitoa; ?>"></td>
			 		</tr>
			 		<tr>
			 			<td>SỐ LƯỢNG GHẾ</td>
			 			<td><input type="number" name="soluongghe" value="<?php echo $soluongghe; ?>"></td>
			 		</tr>
			 		<tr><td colspan="2"><input type="submit" name="btn_submit" value="Cập Nhật"><a href="../pages/toatau.php"><input type="button" value="Trở Lại"></a></td></tr>
			 	</table>
			 </form>
		</div>
	</div>
</body>
</html>