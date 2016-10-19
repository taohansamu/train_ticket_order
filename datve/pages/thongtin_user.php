<?php include("../template/header.php");
include("../lib/function.php"); 
$conn=require_once("../lib/connection.php");

?>
<?php session_start();
if(!isset($_SESSION["username"]))header("timve2.php");
 ?>
 <?php 
$email=$_SESSION["email"];
$username=$_SESSION["username"];
$sql="select * from khachhang where email='".$email."'";
$query=pg_query($conn,$sql);
$row=pg_fetch_array($query);
$diachi=$row["diachi"];
$sdt=$row["sdt"];
$maloaikhach=$row["maloaikhach"];
$cmnd=$row["cmnd"];
  ?>
 <h3>Thông Tin Cơ Bản</h3>
 <table>
 	<tr>
 		<u><td>Họ Tên </td></u>
 		<td><?php echo $username; ?></td>
 	</tr>
 	<tr>
 		<u><td>Địa Chỉ</td></u>
 		<td><?php echo $diachi; ?></td>
 	</tr>
 	<tr>
 		<u><td>SĐT</td></u>
 		<td><?php echo $sdt; ?></td>
 	</tr>
 	<tr>
 		<td>Email</td>
 		<td><?php echo $email; ?></td>
 	</tr>
 	<tr>
 		<td>Hạng Ưu Tiên</td>
 		<td><?php echo get_name_loaikhach($conn,$maloaikhach) ?></td>
 	</tr>
 	<tr>
 		<td>
 			<u><a href="chinh_sua_user.php">Chỉnh sửa thông tin</a></u><br>
			<u><a href="giove.php">Giỏ Vé</a></u>
 		</td>
 	</tr>
 </table>

