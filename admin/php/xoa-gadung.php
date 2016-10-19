<?php 
$conn=require_once('../lib/connection.php');
if(isset($_GET["machuyen"]) and isset($_GET["maga"]))
{
	$machuyen_id=$_GET["machuyen"];
	$maga_id=$_GET["maga"];
	$sql="delete from gadung where machuyen='".$machuyen_id."' and maga='".$maga_id."'";
	$query=pg_query($conn,$sql);
	if($query)header('Location:../pages/gadung.php?id=dl1');
	if(!$query)header('Location:../pages/gadung.php?id=dl0');
}
 ?>