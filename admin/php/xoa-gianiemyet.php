
<?php 
$conn=require_once("../lib/connection.php");
	if(isset($_GET["machuyen"]) and isset($_GET["maga"]) and isset($_GET["maloaitoa"]))
	{
	$machuyen=$_GET["machuyen"];
	$maga=$_GET["maga"];
	$maloaitoa=$_GET["maloaitoa"];
	$sql="DELETE FROM gianiemyet WHERE maloaitoa='".$maloaitoa."' and machuyen='".$machuyen."' and maga='".$maga."'";
	$query=pg_query($conn,$sql);
	echo $sql;
	if(!$query){
		header('Location:../pages/gianiemyet.php?id=dl0');
	}
	else
	header('Location:../pages/gianiemyet.php?id=dl1');
	}
 ?>