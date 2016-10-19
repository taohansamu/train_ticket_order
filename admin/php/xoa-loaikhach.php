<?php 
$conn=require_once("../lib/connection.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="delete from loaikhach where maloaikhach='".$id."'";
	$query=pg_query($conn,$sql);
	if($query)	header('Location:../pages/loaikhach.php?id=dl1');
	else	header('Location:../pages/loaikhach.php?id=dl0');
}
 ?>