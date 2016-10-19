<?php 
include("../template/header.php");
$conn=require_once("../lib/connection.php");
 ?>
<?php 
if(!isset($_SESSION["username"]))
{
	echo "<br>I'm sory ! Bạn cần đăng kí tài khoản để có thể đặt được vé !<br>Hãy vào đây để đăng kí tài khoản :";
	echo "<b><a href="."dangkitk.php"." >Đăng Kí</a></b>";
}
else
{
	//  mave,matoa,magadi,magaden,soghe,giave,ngayban,emailkh,ngaydi
	if(isset($_GET["id"]) and isset($_GET["chieu"]))
	{
		$matoa=$_SESSION["matoa"];
		$chieu=$_GET["chieu"];
		$magadi=$_SESSION["magadi"];
		$magaden=$_SESSION["magaden"];
		$soghe=$_GET["id"];
		$emailkh=$_SESSION["email"];
		$ngaydi=$_SESSION["tgdi"];
		$ngayve=$_SESSION["tgve"];
		$maloaikhach=$_SESSION["loaikhach"];
		if($chieu=="di")
		{
			$tmp=$matoa."@".$magadi."@".$magaden."@".$ngaydi."@".$soghe;$mave=str_replace(" ","",$tmp);
			$giave=gia_ve($conn,$matoa,$magadi,$magaden,$maloaikhach);
			$sql="insert into vetau values('".$mave."','".$matoa."','".$magadi."','".$magaden."','".$soghe."',current_date,'".$emailkh."','".$ngaydi."','".$giave."')";
			$query=pg_query($conn,$sql);
			echo $sql;
			if($query){echo "<script>alert('"."Đã đặt vé"."')</script>";header("Location:giove.php?datve=1");}
			else echo "<script>alert('"."Hệ thống tạm thời bị lỗi,xin hãy thực hiện lại !"."')</script>";
		}
		if($chieu=="ve")
		{
			$tmp=$matoa."@".$magaden."@".$magadi."@".$ngayve."@".$soghe;$mave=str_replace(" ","",$tmp);
			$giave=gia_ve($conn,$matoa,$magaden,$magadi,$maloaikhach);
			$sql="insert into vetau values('".$mave."','".$matoa."','".$magaden."','".$magadi."','".$soghe."',current_date,'".$emailkh."','".$ngayve."','".$giave."')";
			$query=pg_query($conn,$sql);
			echo $sql;
			if($query){echo "<script>alert('"."Đã đặt vé"."')</script>";header("Location:giove.php?datve=1");}
			else echo "<script>alert('"."Hệ thống tạm thời bị lỗi,xin hãy thực hiện lại !"."')</script>";
		}
	}
}
 ?>
 <?php
function gia_ve($conn,$matoa,$magadi,$magaden,$maloaikhach)
{
	$sql="select * from toatau where matoa='".$matoa."'";$query=pg_query($conn,$sql);$row=pg_fetch_array($query);
	$machuyen=$row["machuyen"];$maloaitoa=$row["maloaitoa"];
	$sql="select heso from loaitoa where maloaitoa='".$maloaitoa."'";
	$query=pg_query($conn,$sql);
	$row=pg_fetch_array($query);
	$heso=$row["heso"];
	$sql="select giatien from gianiemyet where machuyen='".$machuyen."' and maga='".$magadi."'";
	$query=pg_query($conn,$sql);
	$row=pg_fetch_array($query);
	$gia_gadi=$row["giatien"];
	$sql="select giatien from gianiemyet where machuyen='".$machuyen."' and maga='".$magaden."'";
	$query=pg_query($conn,$sql);
	$row=pg_fetch_array($query);
	$gia_gaden=$row["giatien"];
	$giachuan=$heso*($gia_gaden-$gia_gadi);
	$sql="select phantramgiamgia from loaikhach where maloaikhach='".$maloaikhach."'";
	$query=pg_query($conn,$sql);$row=pg_fetch_array($query);
	$phantram=100-$row["phantramgiamgia"];
	$kq=($phantram*$giachuan)/100;
	return $kq;
}
 ?>