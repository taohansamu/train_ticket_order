
  <p>Danh sách ghế trong toa số <?php echo get_info_toa($conn,$matoa,"stttoa"); ?> của chuyến tàu <?php echo get_info_toa($conn,$matoa,"machuyen"); ?></p>
  <table class="table table-hover" border="1">

    <tbody>
      <?php $sttghedau=get_info_toa($conn,$matoa,"sttghedau");$sttghecuoi=get_info_toa($conn,$matoa,"sttghecuoi");
      $magadi=$_SESSION["magadi"];$magaden=$_SESSION["magaden"];$ngaydi=$_SESSION["tgdi"];
      if($chieu=="ve"){$magadi=$_SESSION["magaden"];$magaden=$_SESSION["magadi"];$ngaydi=$_SESSION["tgve"];}
      for($i=$sttghedau;$i<=$sttghecuoi;$i++)
      {
       ?>
      <tr>
        <td><?php echo "GHẾ ",$i,"<br>";if(tinhtrangghe($conn,$matoa,$magadi,$magaden,$i,$ngaydi))echo "Đã được đặt"; else{?>
          <a href="datve.php?id=<?php echo $i,"&chieu=",$chieu; ?>">Đặt Vé</a></td><?php  }if($i==$sttghecuoi)break;?>
        <td><?php echo "GHẾ ",++$i,"<br>"; if(tinhtrangghe($conn,$matoa,$magadi,$magaden,$i,$ngaydi))echo "Đã được đặt"; else{?>
          <a href="datve.php?id=<?php echo $i,"&chieu=",$chieu; ?>">Đặt Vé</a></td><?php  }if($i==$sttghecuoi)break;?>
          <td>|<br>|</td>
          <td>|<br>|</td>
          <td><?php echo "GHẾ ",++$i,"<br>"; if(tinhtrangghe($conn,$matoa,$magadi,$magaden,$i,$ngaydi))echo "Đã được đặt"; else{?>
          <a href="datve.php?id=<?php echo $i,"&chieu=",$chieu; ?>">Đặt Vé</a></td><?php  }if($i==$sttghecuoi)break;?>
          <td><?php echo "GHẾ ",++$i,"<br>"; if(tinhtrangghe($conn,$matoa,$magadi,$magaden,$i,$ngaydi))echo "Đã được đặt"; else{?>
          <a href="datve.php?id=<?php echo $i,"&chieu=",$chieu; ?>">Đặt Vé</a></td><?php  }if($i==$sttghecuoi)break;?>
      </tr>
      <?php } ?>
    </tbody>
  </table>

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
    function tinhtrangghe($conn,$matoa,$magadi,$magaden,$soghe,$ngaydi)
    {
      $sql="select count(mave) as tmp from vetau where matoa='".$matoa."' and magadi='".$magadi."' and magaden='".$magaden."' and soghe=".$soghe." and ngaydi='".$ngaydi."'";
      $query=pg_query($conn,$sql);
      $row=pg_fetch_array($query);
      return $row["tmp"];
    }
   ?>