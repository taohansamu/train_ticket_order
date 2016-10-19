
<?php include("header.php"); 
$conn=require_once("../lib/connection.php");
?> 

<nav class="w3-sidenav w3-teal w3-margin-3" style="width: 25%">
<ul class="w3-ul">
	<li><h2>Giờ tàu</h2></li>
	<?php 
		$sql="select magadau,magacuoi from chuyentau group by magadau,magacuoi";
		$query=pg_query($conn,$sql);
		while($row=pg_fetch_array($query))
		{
			$magadau=$row["magadau"];
			$magacuoi=$row["magacuoi"];
			
	 ?>
	<a href="giotau.php?<?php echo "magadau=",$magadau,"&magacuoi=",$magacuoi; ?>">
	<?php echo get_name_ga($magadau,$conn),"-",get_name_ga($magacuoi,$conn); ?>
	</a>
	<?php } 
	?>

	<li><h2>Giá vé</h2></li>
	<?php 
		$sql="select magadau,magacuoi from chuyentau group by magadau,magacuoi";
		$query=pg_query($conn,$sql);
		
		while($row=pg_fetch_array($query))
		{
			$magadau=$row["magadau"];
			$magacuoi=$row["magacuoi"];
	 ?>
	<a href="giave.php?<?php echo "magadau=",$magadau,"&magacuoi=",$magacuoi; ?>">
	<?php echo get_name_ga($magadau,$conn),"-",get_name_ga($magacuoi,$conn); ?>
	</a>
	<?php } ?>
</ul>
</nav>
<?php 
function get_name_ga($id,$conn)
	{		
			$sql="select * from gatau where maga='".$id."';";
			$tmp=pg_query($conn,$sql);
			if(!$tmp)echo "co loi xay ra";
			$row=pg_fetch_array($tmp);
			return $row["tenga"];
	}
 ?>