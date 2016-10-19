<?php include("../template/giotau_giave_template.php"); ?>

<div style="margin-left: 26%">
<h3><br> Chuyến Tàu SE1 Hà Nội-Sài Gòn </h3>
<table class="w3-table w3-striped">
			<tr>
				<th>Tên Ga</th>
				<th>Giờ Đến</th>
				<th>Giờ Đi</th>
			</tr>
		<?php
		$flag=0;
		$machuyen="SE1";
		$sql1="select * from gadung where machuyen='".$machuyen."' order by sttdung";
		$query=pg_query($conn,$sql1);
		while($row1=pg_fetch_array($query))
		{
			$magadung=$row1["maga"];
			$giodung=$row1["giodung"];
			$giodi=$row1["giodi"];
		 ?>
		 <tr>
		 	<td><?php echo get_name_ga($magadung,$conn); ?></td>
		 	<td><?php echo $giodung ; ?></td>
		 	<td><?php echo $giodi; ?></td>
		 </tr>
		 <?php
		 	if($magadung==$magaden)break;
			}
		 ?>

</table>
</div>

</body>
</html>