<?php session_start(); ?>
<?php 
include("../template/header.php");
$conn=require_once("../lib/connection.php");
if(!isset($_SESSION["username"]))header("Location:timve2.php");
$email=$_SESSION["email"];
$sql="select count(mave) as sv from vetau where emailkh='".$email."'";
$query=pg_query($conn,$sql);$row=pg_fetch_array($query);
$sove=$row["sv"];
echo "<br><h4>Quý khách đã đặt ".$sove." vé</h4><br>";
$sql="select * from vetau where emailkh='".$email."'";
$query1=pg_query($conn,$sql);
$stt=1;
 ?>
 <table>
 	<tr>
 	<?php while($row=pg_fetch_array($query1)){ 
 		$magadi=$row["magadi"];
 		$magaden=$row["magaden"];
 		$ngaydi=$row["ngaydi"];
 		$matoa=$row["matoa"];
    $giave=$row["giave"];
 		$machuyen=get_info_toa($conn,$matoa,"machuyen");
 		$sql="select giodi from gadung where machuyen='".$machuyen."' and maga='".$magadi."'";$query=pg_query($conn,$sql);
 		$tmp=pg_fetch_array($query);$giodi=$tmp["giodi"];
 		$sql="select giodung from gadung where machuyen='".$machuyen."' and maga='".$magaden."'";$query=pg_query($conn,$sql);
 		$tmp=pg_fetch_array($query);$giodung=$tmp["giodung"];
 		?>
 		<td>
 			Vé <?php echo $stt++; ?>
 			<br>
 			Ga Đi:<?php echo get_name_ga($magadi,$conn),"<br>"; ?>
 			Ga Đến:<?php echo get_name_ga($magaden,$conn),"<br>"; ?>
 			Ngày Đi:<?php echo $ngaydi,"<br>"; ?>
 			Giờ Khởi Hành: <?php echo $giodi,"<br>"; ?>
 			Giờ Đến: <?php echo $giodung,"<br>"; ?>
      Giá Vé: <?php echo $giave,"<br>"; ?>
 		</td>
 		<?php } ?>
 	</tr>
 </table>
<?php function get_name_ga($id,$conn)
  {
      $sql="select * from gatau where maga='".$id."';";
      $tmp=pg_query($conn,$sql);
      if(!$tmp)echo "co loi xay ra";
      $row=pg_fetch_array($tmp);
      return $row["tenga"];
  } ?>

   <?php 
  function get_info_toa($conn,$matoa,$str)
    {
      $sql="select * from toatau where matoa='".$matoa."' ";
      $query=pg_query($conn,$sql);
      $row=pg_fetch_array($query);
      $stttoa=$row["stttoa"];
      $maloaitoa=$row["maloaitoa"];
      $soluongghe=$row["soluongghe"];
      $machuyen=$row["machuyen"];
      $sql="select sum(soluongghe) as tmp from toatau where machuyen='".$row["machuyen"]."' and stttoa<".$stttoa."";
      $query=pg_query($conn,$sql);
      $row=pg_fetch_array($query);
      if($stttoa==1)$sttghedau=1;
      else $sttghedau=$row["tmp"]+1;
      $sttghecuoi=$sttghedau+$soluongghe-1;
      if($str=="stttoa")return $stttoa;
      if($str=="maloaitoa")return $maloaitoa;
      if($str=="soluongghe")return $soluongghe;
      if($str=="machuyen")return $machuyen;
      if($str=="sttghedau") return $sttghedau;
      if($str=="sttghecuoi") return $sttghecuoi;
    }
   ?>