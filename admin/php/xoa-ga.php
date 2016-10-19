<?php 
$conn=require_once("../lib/connection.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="delete from gatau where maga='".$id."'";
	$query=pg_query($conn,$sql);
	if($query)header('Location:../pages/ga.php?id=dl1');
	else header('Location:../pages/ga.php?id=dl0');
}
 ?>