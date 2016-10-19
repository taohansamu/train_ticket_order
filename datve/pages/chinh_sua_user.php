<?php 
include("../template/header.php");
include '../lib/function.php';
$conn=require_once("../lib/connection.php");
 ?>
<?php session_start(); 
if(!isset($_SESSION["username"]))header("Location:timve2.php");
else
{
	$email=$_SESSION["email"];
	$username=$_SESSION["username"];
	$sql="select * from khachhang where email='".$email."'";
	$query=pg_query($conn,$sql);
	$row=pg_fetch_array($query);
	$diachi=$row["diachi"];
	$sdt=$row["sdt"];
	$maloaikhach=$row["maloaikhach"];
	$cmnd=$row["cmnd"];
	$password=$row["password"];
}
?>

<?php 
if(isset($_POST["submit"]))
{
	$hoten=$_POST["hoten"];setcookie("hoten",$hoten); $_COOKIE["hoten"]= $hoten;
	$diachi=$_POST["diachi"];setcookie("diachi",$diachi);$_COOKIE["diachi"]= $diachi;
	$email=$_POST["email"];setcookie("email",$email);$_COOKIE["email"]= $email;
	$sdt=$_POST["sdt"];setcookie("sdt",$sdt);$_COOKIE["sdt"]= $sdt;
	$newpassword=$_POST["newpassword"];setcookie("newpassword",$newpassword);$_COOKIE["newpassword"]= $newpassword;
	$renewpassword=$_POST["renewpassword"];setcookie("repassword",$repassword);$_COOKIE["password"]= $password;
	$loaikhach=$_POST["loaikhach"];setcookie("loaikhach",$loaikhach);$_COOKIE["loaikhach"]= $loaikhach;
	$oldpassword=$_POST["oldpassword"];setcookie("oldpassword",$oldpassword);$_COOKIE["oldpassword"]= $oldpassword;
	if($newpassword!=$renewpassword){$thongbao="Đăng kí không thành công ! Mật khẩu nhập lại không đúng!";echo "<script> alert('".$thongbao."')</script>";}
	else if($newpassword!=$oldpassword){$thongbao="Đăng kí không thành công ! Mật khẩu cũ không đúng!";echo "<script> alert('".$thongbao."')</script>";}
	else
	{	
		$sql="update khachhang set tenkhachhang='".$hoten."',diachi='".$diachi."',sdt='".$sdt."',email='".$email."',maloaikhach='".$maloaikhach."',password='".$newpassword."' where email='".$_SESSION["email"]."' ";
		$query=pg_query($conn,$sql);
		$tc="Đăng kí thành công ! :)))";
		$tb="Đăng kí không thành công,thông tin của bạn đã được đăng kí ! :(((";	
		if($query){
					$_SESSION["username"]=$hoten;
					$_SESSION["email"]=$email;
					$_SESSION["sdt"]=$sdt;
					$_SESSION["loaikhach"]=$loaikhach;
					$_SESSION["cmnd"]=$cmnd;
					if(isset($_GET["from"]))
						{
							$from=$_GET["from"];header($from.".php");
						}
					else header("Location:timve2.php");
					}
		else echo "<script> alert('".$tb."')</script>";
	}
}
 ?>
<!-- form dang ki -->
 <form name="FORM" action="chinh_sua_user.php" method="POST" role="form">
 	<br>
 	<legend>Hãy điền đầy đủ thông tin người dùng</legend>
 
 	<div class="form-group">
 		<table>
		<tr>
			<td>HỌ VÀ TÊN</td>
			<td><input type="text" name="hoten"  class="form-control" required="required" value="<?php echo $username; ?>"
			<?php if(isset($_COOKIE["hoten"])) echo "value='".$_COOKIE["hoten"]."'" ?>  >
			</td>
		</tr>
		<tr>
			<td>ĐỊA CHỈ</td>
			<td><input type="text" name="diachi"  class="form-control" required="required" value="<?php echo $diachi; ?>" >
			</td>
		</tr>
		<tr>
			<td>EMAIL</td>
			<td><input type="email" name="email"  class="form-control" required="required" value="<?php echo $email; ?>" ></td>
		</tr>
		<tr>
			<td>SĐT</td>
			<td><input type="number" name="sdt"  class="form-control" required="required" value=<?php echo $sdt; ?> ></td>
		</tr>
		<tr>
			<td>Mật Khẩu Mới </td>
			<td><input type="password" name="newpassword"  class="form-control"  required="required"></td>
		</tr>
		<tr>
			<td>Nhập Lại Mật Khẩu</td>
			<td><input type="password" name="renewpassword"  class="form-control" required="required"  ></td>
		</tr>
		<tr>
			<td>Nhập Lại cũ</td>
			<td><input type="password" name="oldpassword"  class="form-control" required="required"  ></td>
		</tr>
		<tr>
			<td>TH ĐẶC BIỆT</td>
			<td><select name="loaikhach"  class="form-control">
			<?php 
				$sql="select * from loaikhach";$query=pg_query($conn,$sql);while($row=pg_fetch_array($query)){
			 ?>
				<option value="<?php echo $row["maloaikhach"]; ?>" <?php if($maloaikhach==$row["maloaikhach"]) echo "selected";?>><?php echo get_name_loaikhach($conn,$row["maloaikhach"]); ?></option>
			<?php } ?>
			</select></td>
		</tr>
	</table>
 	</div>
 	<button type="submit" class="btn btn-primary" name="submit" >Đăng kí</button>
 </form>