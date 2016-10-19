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