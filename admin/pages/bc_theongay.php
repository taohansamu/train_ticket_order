<?php include("../template/header.php"); ?>
<form action="bc_theongay.php" method="POST" role="form">
  <div class="form-group">
    <label for="">Từ Ngày</label>
    <input type="date" class="form-control" name="tungay" placeholder="vd:12/08/2015" value=<?php echo date("Y-m-d");  ?>  required>
    <label for="">Đến Ngày</label>
    <input type="date" class="form-control" name="denngay" placeholder="12/08/2015" value=<?php echo date("Y-m-d");  ?> required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Báo Cáo</button>
</form>
<?php 
$conn=require_once("../lib/connection.php");
if(isset($_POST["submit"]))
{
	   $tungay=$_POST["tungay"];
        $denngay=$_POST["denngay"];
        echo "<h4>THỐNG KÊ VÉ ĐẶT TỪ NGÀY ".$tungay." ĐẾN NGÀY ".$denngay."</h4>";
        thongketheongay($conn,$tungay,$denngay);
}
 ?>
   <?php 
    function thongketheongay($conn,$tungay,$denngay)
    {

        $sql="select count(vetau) as sove from vetau where ngaydi<='".$denngay."' and ngaydi>='".$tungay."'";
        $query=pg_query($conn,$sql);
        $row=pg_fetch_array($query);
        $tongsove=$row["sove"];
        echo "<b><li>Tổng số vé đặt:</b>",$tongsove,"</li>";
        $sql="select sum(giave) as sotien from vetau where ngaydi<='".$denngay."' and ngaydi>='".$tungay."'";
        $query=pg_query($conn,$sql);
        $row=pg_fetch_array($query);
        $tongsotien=$row["sotien"];
        echo "<b><li>Tổng số tiền:</b>",number_format($tongsotien)," đồng","</li>";
        echo "<b><li>Chuyến nhiều vé đặt nhất:</b>",chuyenmaxve($conn,$tungay,$denngay),"</li>" ;
        echo "<b><li>Chuyến ít vé đặt nhất:</b>",chuyenminve($conn,$tungay,$denngay),"</li>";
    }  
    function sovetoa($conn,$matoa,$tungay,$denngay)
    {
    	$sql="select count(mave) sove from vetau where matoa='".$matoa."' and ngaydi<='".$denngay."' and ngaydi>='".$tungay."' ";
    	$query=pg_query($conn,$sql);
    	$row=pg_fetch_array($query);
    	return $row["sove"];
    }
    function sovechuyen($conn,$machuyen,$tungay,$denngay)
    {
    	$sql="select matoa from toatau where machuyen='".$machuyen."'";
    	$query=pg_query($conn,$sql);
    	$sum=0;
    	while($row=pg_fetch_array($query))
    	{
    		$matoa=$row["matoa"];
    		$sum+=sovetoa($conn,$matoa,$tungay,$denngay);
    	}
    	return $sum;
    }
    function chuyenmaxve($conn,$tungay,$denngay)
    {
    	$sql="select machuyen from chuyentau";
    	$query=pg_query($conn,$sql);
    	$row=pg_fetch_array($query);
    	$chuyenmax=$row["machuyen"];
    	while ($row=pg_fetch_array($query))
    	 {
    		$tmp=$row["machuyen"];
    		if(sovechuyen($conn,$tmp,$tungay,$denngay)>sovechuyen($conn,$chuyenmax,$tungay,$denngay))$chuyenmax=$tmp;
    	}
    	return $chuyenmax;
    }
    function chuyenminve($conn,$tungay,$denngay)
    {
        $sql="select machuyen from chuyentau";
        $query=pg_query($conn,$sql);
        $row=pg_fetch_array($query);
        $chuyenmin=$row["machuyen"];
        while ($row=pg_fetch_array($query))
         {
            $tmp=$row["machuyen"];
            if(sovechuyen($conn,$tmp,$tungay,$denngay)<sovechuyen($conn,$chuyenmin,$tungay,$denngay))$chuyenmin=$tmp;
        }
        return $chuyenmin;
    }
   ?>