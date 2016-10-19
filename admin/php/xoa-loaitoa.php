<?php 
$conn=require_once("../lib/connection.php");
	if(isset($_GET["id"]))
	{
	$id=$_GET["id"];
	$sql="DELETE FROM loaitoa WHERE maloaitoa='".$id."'";
	$query=pg_query($conn,$sql);
	if(!$query){
		header('Location:../pages/loaitoa.php?id=dl0');
	}
	else
	header('Location:../pages/loaitoa.php?id=dl1');
	}
 ?>