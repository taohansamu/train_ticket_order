<?php 
$conn=require_once("../lib/connection.php");
	if(isset($_GET["id"]))
	{
	$id=$_GET["id"];
	$sql="DELETE FROM khachhang WHERE email='".$id."'";
	$query=pg_query($conn,$sql);
	if(!$query){
		header('Location:../pages/khachhang.php?id=dl0');
	}
	else
	header('Location:../pages/khachhang.php?id=dl1');
	}
 ?>