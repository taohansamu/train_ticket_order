<?php include("../template/header.php"); ?>
  <div class="w3-col m9">
        <div class="w3-card-4 " style="height: 535px">
    <form action="chuyentau.php" method="POST" class="w3-form">
         <h2 class="w3-text-teal" > Thêm Chuyến Tàu </h2>
    <div class="w3-group">  
    <input class="w3-input" type="text" style="width:95%" name="machuyen" >
    <label class="w3-label">Mã Chuyến</label>
  </div>
  <div class="w3-row">
  <div class="w3-group w3-half">  
    <input class="w3-input " type="text" style="width:90%" name="tenchuyen">
    <label class="w3-label">Tên Chuyến</label>
  </div>
    <div class="w3-group w3-half">  
    <input class="w3-input " type="number" style="width:90%" name="sotoa">
    <label class="w3-label">Số Toa</label>
  </div>
</div>
  <div class="w3-row">
    <div class="w3-group w3-half">  
    <input class="w3-input " type="text" style="width:90%" name="magadau">
    <label class="w3-label">Mã Ga Đầu</label>
  </div>
    <div class="w3-group w3-half">  
    <input class="w3-input " type="text" style="width:90%" name="magacuoi">
    <label class="w3-label">Mã Ga Cuối</label>
  </div>
</div>
  <div class="w3-row">
    <div class="w3-group w3-half">  
    <input class="w3-input " type="time" style="width:90%" name="giokhoihanh">
    <label class="w3-label">Giờ Khởi Hành</label>
  </div>
    <div class="w3-group w3-half">  
    <input class="w3-input " type="time" style="width:90%" name="gioketthuc">
    <label class="w3-label">Giờ Kết Thúc</label>
  </div>
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
        $machuyen=$_POST["machuyen"];
        $tenchuyen=$_POST["tenchuyen"];
        $sotoa=$_POST["sotoa"];
        $magadau=$_POST["magadau"];
        $magacuoi=$_POST["magacuoi"];
        $giokhoihanh=$_POST["giokhoihanh"];
        $gioketthuc=$_POST["gioketthuc"];
        if($machuyen=="" or $tenchuyen=="" or $sotoa=="" or $magadau=="" or $magacuoi=="" or $giokhoihanh=="" or $gioketthuc=="")
          echo "KHÔNG ĐƯỢC BỎ TRỐNG TRƯỜNG NÀO !";
        else
          {
            
              $sql="SELECT * FROM chuyentau where machuyen='".$machuyen."'";
              $query=pg_query($conn,$sql);
              $num_row=pg_num_rows($query);
            
            if($num_row)
            {
                      echo '<script language="javascript">';
                echo 'alert("Đã tồn tại chuyến tàu có mã chuyến này")';
                echo '</script>';
            }
            else
            {
              $sql="INSERT INTO chuyentau values('".$machuyen."','".$tenchuyen."','".$magadau."','".$magacuoi."','".$giokhoihanh."','".$gioketthuc."',".$sotoa.")";
              $query=pg_query($conn,$sql);
              $sql="SELECT * FROM chuyentau where machuyen='".$machuyen."'";
              $query=pg_query($conn,$sql);
              $num_row=pg_num_rows($query);
              if($num_row)
                {
                          echo '<script language="javascript">';
                echo 'alert("Thêm thành công")';
                echo '</script>';
                $flag="added";
                };
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
              <th>Mã Chuyến</th>
              <th>Tên Chuyến</th>
              <th>Số Toa</th>
              <th>Mã Ga Đầu</th>
              <th>Mã Ga Cuối</th>
              <th>Giờ Khởi Hành</th>
              <th>Giờ Kết Thúc</th>
              <th>Thao Tác</th>
            </tr>
          </thead>
          <tbody>

          <br><br><br>
          <?php
            $stt = 1 ;
            $sql = "SELECT * FROM chuyentau order by machuyen";
            if(isset($_POST["btn_search"]))
            {
              $machuyen=$_POST["machuyen"];
              $tenchuyen=$_POST["tenchuyen"];
              $sotoa=$_POST["sotoa"];
              $magadau=$_POST["magadau"];
              $magacuoi=$_POST["magacuoi"];
              $giokhoihanh=$_POST["giokhoihanh"];
              $gioketthuc=$_POST["gioketthuc"];
              if($machuyen=="" and $tenchuyen=="" and $sotoa=="" and $magadau=="" and $magacuoi=="" and $giokhoihanh=="" and $gioketthuc=="")
              echo "Hãy điền ít nhất 1 trường!";
              else
              {
              $string_machuyen=($machuyen=="")?"1=0":"machuyen='".$machuyen."'";
              $string_tenchuyen=($tenchuyen=="")?"1=0":"tenchuyen='".$tenchuyen."'";
              $string_sotoa=($sotoa=="")?"1=0":"sotoa='".$sotoa."'";
              $string_magadau=($magadau=="")?"1=0":"magadau='".$magadau."'";
              $string_magacuoi=($magacuoi=="")?"1=0":"magacuoi='".$magacuoi."'";
              $string_giokhoihanh=($giokhoihanh=="")?"1=0":"giokhoihanh='".$giokhoihanh."'";
              $string_gioketthuc=($gioketthuc=="")?"1=0":"gioketthuc='".$gioketthuc."'";
              $sql="select * from chuyentau where ".$string_machuyen." or ".$string_tenchuyen." or ".$string_sotoa." or ".$string_magadau." or ".$string_magacuoi." or ".$string_giokhoihanh." or ".$string_gioketthuc." ";
              }
            }
            // thực thi câu $sql với biến conn lấy từ file connection.php
            $query = pg_query($conn,$sql);
            while ($data = pg_fetch_array($query)) {
          ?>
            <tr>
              <th scope="row"><?php echo $stt++ ;?></th>
              <td><?php echo $data["machuyen"]; ?></td>
              <td><?php echo $data["tenchuyen"]; ?></td>
              <td><?php echo $data["sotoa"]; ?></td>
              <td><?php echo $data["magadau"]; ?></td>
              <td><?php echo $data["magacuoi"]; ?></td>
              <td> <?php echo $data["giokhoihanh"]; ?></td>
              <td><?php echo $data["gioketthuc"]; ?></td>
              <td><a href="../php/chinh-sua-chuyentau.php?id=<?php echo $data["machuyen"]; ?>">Sửa</a> <a href="../php/xoa-chuyentau.php?id=<?php echo $data["machuyen"]; ?>">Xóa</a></td>
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
    <script src="hchuyentaus://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>




<footer class="w3-container w3-padding-32 w3-theme w3-center w3-teal">
  <h4>Follow Us</h4>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Rss"><i class="fa fa-rss"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Facebook"><i class="fa fa-facebook"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Twitter"><i class="fa fa-twitter"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-google-plus"></i></a>
  <a class="w3-btn-floating w3-teal" href="javascript:void(0)" title="Linkedin"><i class="fa fa-linkedin"></i></a>
  <p>&#169; XUKA TEAM</p>
</footer>
</body>
</html>
