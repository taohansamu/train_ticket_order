<?php include("../template/header.php"); ?>

  <div class="w3-col m9">
        <div class="w3-card-4 " style="height: 535px">
    <form action="toatau.php" method="POST" class="w3-form">
         <h2 class="w3-text-teal" > Thêm Chuyến</h2>
    <div class="w3-group">  
    <input class="w3-input" type="text" style="width:95%" name="machuyen" required>
    <label class="w3-label">Mã Chuyến</label>
  </div>
  <div class="w3-group">  
    <input class="w3-input " type="number" style="width:95%" name="stttoa"required>
    <label class="w3-label">STT Toa</label>
  </div>
      <div class="w3-group">  
    <input class="w3-input" type="text" style="width:95%" name="maloaitoa" required>
    <label class="w3-label">Mã Loại Toa</label>
  </div>
  <div class="w3-group">  
    <input class="w3-input " type="number" style="width:95%" name="soluongghe"required>
    <label class="w3-label">Số Lượng Ghế</label>
  </div>
  <button class="w3-btn w3-teal w3-section" name="btn_search" type="submit" value="Tìm kiếm">Tìm kiếm</button>
  <button class="w3-btn w3-teal w3-section" name="btn_add" type="submit" value="Thêm">Thêm</button>
  </form>
    <!-- end .content -->
</div>
<br>
    <!-- CODE PHP-->
    <!-- KẾT NỐI TỚI DATABASE -->
    <?php 
    $flag=NULL;
     $conn=require_once("../lib/connection.php");
    if(!$conn)print "Không thể kết nối tới database";
     ?>
     <?php
     if(isset($_GET["id"]))
     {
      $id=$_GET["id"];
      if($id=="dl0")
      {
        echo '<script language="javascript">';
                echo 'alert("Xóa không thành công")';
                echo '</script>';
      }
      if($id=="dl1")
      {
        echo '<script language="javascript">';
                echo 'alert("Xóa thành công")';
                echo '</script>';
      }
      if($id=="ud0")
      {
        echo '<script language="javascript">';
                echo 'alert("Update thất bại")';
                echo '</script>';
      }
      if($id=="ud1")
      {
        echo '<script language="javascript">';
                echo 'alert("Update thành công")';
                echo '</script>';
      }
     }
     if(isset($_POST["btn_add"]))
      {
        $stttoa=$_POST["stttoa"];
        $maloaitoa=$_POST["maloaitoa"];
        $soluongghe=$_POST["soluongghe"];
        $machuyen=$_POST["machuyen"];
        if($stttoa=="" or $maloaitoa=="" or $soluongghe=="" or $machuyen=="")
          echo "KHÔNG ĐƯỢC BỎ TRỐNG TRƯỜNG NÀO !";
        else
          {
            
              $sql="SELECT * FROM toatau where machuyen='".$machuyen."' and stttoa='".$stttoa."'";
              $query=pg_query($conn,$sql);
              $num_row=pg_num_rows($query);
            
            if($num_row)
            {
                      echo '<script language="javascript">';
                echo 'alert("Đã tồn tại toa tàu này")';
                echo '</script>';
            }
            else
            {
              $matoa=str_replace(" ","",$machuyen."-".$stttoa);
              $sql="INSERT INTO toatau values('".$matoa."','".$stttoa."','".$maloaitoa."','".$soluongghe."','".$machuyen."')";
              $query=pg_query($conn,$sql);
              }
          }
        }

 ?>
</div>
 <!-- END CODE PHP -->

 

    <div class="container">
      <div class="row">
        <table class="w3-table w3-striped">
          <h2 class="w3-text-teal">Danh sách chuyến tàu</h2>
          <thead>
            <tr>
              <th>STT</th>
              <th>STT Toa</th>
              <th>Mã Loại Toa</th>
              <th>Số Lượng Ghế</th>
              <th>Mã Chuyến</th>
              <th>Thao Tác</th>
            </tr>
          </thead>
          <tbody>
            <br><br><br>
          <?php
            $stt = 1 ;
            $sql = "SELECT * FROM toatau order by machuyen";
            if(isset($_POST["btn_search"]))
            {
              $stttoa=$_POST["stttoa"];
              $maloaitoa=$_POST["maloaitoa"];
              $soluongghe=$_POST["soluongghe"];
              $machuyen=$_POST["machuyen"];
              if($stttoa=="" and $maloaitoa=="" and $soluongghe=="" and $machuyen=="" )
              echo "Hãy điền ít nhất 1 trường!";
              else
              {
              $string_stttoa=($stttoa=="")?"1=0":"stttoa='".$stttoa."'";
              $string_maloaitoa=($maloaitoa=="")?"1=0":"maloaitoa='".$maloaitoa."'";
              $string_soluongghe=($soluongghe=="")?"1=0":"soluongghe='".$soluongghe."'";
              $string_machuyen=($machuyen=="")?"1=0":"machuyen='".$machuyen."'";
              $sql="select * from toatau where ".$string_stttoa." or ".$string_maloaitoa." or ".$string_soluongghe." or ".$string_machuyen." ";
              }
            }
            // thực thi câu $sql với biến conn lấy từ file connection.php
            $query = pg_query($conn,$sql);
            while ($data = pg_fetch_array($query)) {
          ?>
            <tr>
              <th scope="row"><?php echo $stt++ ;?></th>
              <td><?php echo $data["stttoa"]; ?></td>
              <td><?php echo $data["maloaitoa"]; ?></td>
              <td><?php echo $data["soluongghe"]; ?></td>
              <td> <?php echo $data["machuyen"]; ?></td>
              <td><a href="../php/chinh-sua-toatau.php?id=<?php echo $data["matoa"]; ?>">Sửa</a> <a href="../php/xoa-toatau.php?id=<?php echo $data["matoa"]; ?>">Xóa</a></td>
            </tr>
          <?php
            }
          ?>
          </tbody>
        </table>
      </div>
 
    </div><!-- /.container -->
 
 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="htoataus://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>




<footer class="w3-container w3-padding-32 w3-theme w3-center w3-teal">
  <h4>Follow Us</h4>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Rss"><i class="fa fa-rss"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Facebook"><i class="fa fa-facebook"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Twitter"><i class="fa fa-twitter"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-google-plus"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Linkedin"><i class="fa fa-linkedin"></i></a>
  <p>&#169; XUKA TEAM</p>
</footer></body>
</html>
