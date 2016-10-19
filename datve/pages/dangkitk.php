<?php session_start(); ?>
<?php 
include("../template/header.php");
$conn=require_once("../lib/connection.php");
 ?>
<script>
	function xacnhanmatkhau (form) {
		var x=form.password.value;
		var y=form.repassword.value;
		if(x!=y) {alert("Mật khẩu nhập lại chưa chính xác");}
	}
</script>
<?php 
if(isset($_POST["submit"]))
{
	$hoten=$_POST["hoten"];setcookie("hoten",$hoten); $_COOKIE["hoten"]= $hoten;
	$diachi=$_POST["diachi"];setcookie("diachi",$diachi);$_COOKIE["diachi"]= $diachi;
	$cmnd=$_POST["cmnd"];setcookie("cmnd",$cmnd);$_COOKIE["cmnd"]= $cmnd;
	$email=$_POST["email"];setcookie("email",$email);$_COOKIE["email"]= $email;
	$sdt=$_POST["sdt"];setcookie("sdt",$sdt);$_COOKIE["sdt"]= $sdt;
	$password=$_POST["password"];setcookie("password",$password);$_COOKIE["password"]= $password;
	$repassword=$_POST["repassword"];setcookie("repassword",$repassword);$_COOKIE["password"]= $password;
	$loaikhach=$_POST["loaikhach"];setcookie("loaikhach",$loaikhach);$_COOKIE["loaikhach"]= $loaikhach;
	if($password!=$repassword){$thongbao="Đăng kí không thành công ! Mật khẩu nhập lại không đúng!";echo "<script> alert('".$thongbao."')</script>";}
	else
	{
		$sql="insert into khachhang values('".$hoten."','".$diachi."','".$email."','".$sdt."','".$loaikhach."','".$cmnd."','".$password."')";
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
 <form name="FORM" action="dangkitk.php" method="POST" role="form">
 	<br>
 	<legend>Hãy điền đầy đủ thông tin người dùng</legend>
 
 	<div class="form-group">
 		<table>
		<tr>
			<td>HỌ VÀ TÊN</td>
			<td><input type="text" name="hoten"  class="form-control" required="required" <?php if(isset($_COOKIE["hoten"])) echo "value='".$_COOKIE["hoten"]."'" ?>  >
			</td>
		</tr>
		<tr>
			<td>ĐỊA CHỈ</td>
			<td><input type="text" name="diachi"  class="form-control" required="required" <?php if(isset($_COOKIE["diachi"])) echo "value='".$_COOKIE["diachi"]."'" ?>>
			</td>
		</tr>
		<tr>
			<td>SỐ CMND</td>
			<td><input type="number" size="20" name="cmnd"  class="form-control" required="required" <?php if(isset($_COOKIE["cmnd"]))echo "value='".$_COOKIE["cmnd"]."'" ?>></td>
		</tr>
		<tr>
			<td>EMAIL</td>
			<td><input type="email" name="email"  class="form-control" required="required" <?php if(isset($_COOKIE["email"]))echo "value='".$_COOKIE["email"]."'" ?>></td>
		</tr>
		<tr>
			<td>SĐT</td>
			<td><input type="number" name="sdt"  class="form-control" required="required" <?php if(isset($_COOKIE["sdt"]))echo "value='".$_COOKIE["sdt"]."'"?>></td>
		</tr>
		<tr>
			<td>Mật Khẩu</td>
			<td><input type="password" name="password"  class="form-control" required="required" <?php if(isset($_COOKIE["password"]))echo "value='".$_COOKIE["password"]."'"?>></td>
		</tr>
		<tr>
			<td>Nhập Lại Mật Khẩu</td>
			<td><input type="password" name="repassword"  class="form-control" required="required"  ></td>
		</tr>
		<tr>
			<td>TH ĐẶC BIỆT</td>
			<td><select name="loaikhach"  class="form-control">
			<?php 
				$sql="select * from loaikhach";$query=pg_query($conn,$sql);while($row=pg_fetch_array($query)){
			 ?>
				<option value="<?php echo $row["maloaikhach"]; ?>" <?php if($_COOKIE["loaikhach"]==$row["maloaikhach"]) echo "selected";?>><?php echo $row["tenloaikhach"]; ?></option>
			<?php } ?>
			</select></td>
		</tr>
	</table>
 	</div>
 	<button type="submit" class="btn btn-primary" name="submit" >Đăng kí</button>
 </form>