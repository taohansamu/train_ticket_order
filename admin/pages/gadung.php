<?php include("../template/header.php"); ?>

  <div class="w3-col m9">
        <div class="w3-card-4 " style="height: 535px">
    <form action="gadung.php" method="POST" class="w3-form">
         <h2 class="w3-text-teal" > Thêm Ga Dừng </h2>
    <div class="w3-group">  
    <input class="w3-input" type="text" style="width:95%" name="machuyen" >
    <label class="w3-label">Mã Chuyến</label>
  </div>

  <div class="w3-group">  
    <input class="w3-input " type="text" style="width:95%" name="maga">
    <label class="w3-label">Mã Ga</label>
  </div>
  <div class="w3-group">  
    <input class="w3-input " type="text" style="width:95%" name="sttdung">
    <label class="w3-label">STT Dừng</label>
  </div>
  <div class="w3-row">
    <div class="w3-group w3-half">  
    <input class="w3-input " type="time" style="width:95%" name="giodung">
    <label class="w3-label">Giờ dừng</label>
  </div>
    <div class="w3-group w3-half">  
    <input class="w3-input " type="time" style="width:95%" name="giodi">
    <label class="w3-label">Giờ đi</label>
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
        $maga=$_POST["maga"];
        $giodung=$_POST["giodung"];
        $giodi=$_POST["giodi"];
        $sttdung=$_POST["sttdung"];
        if($machuyen==""  or $maga=="" or $sttdung=="" or $giodung=="" or $giodi=="")
          echo "KHÔNG ĐƯỢC BỎ TRỐNG TRƯỜNG NÀO !";
        else
          {
            
              $sql="SELECT * FROM gadung where machuyen='".$machuyen."' and maga='".$maga."'";
              $query=pg_query($conn,$sql);
              $num_row=pg_num_rows($query);
            
            if($num_row)
            {
                      echo '<script language="javascript">';
                echo 'alert("Đã tồn tại ga dừng có mã ga này")';
                echo '</script>';
            }
            else
            {
              $sql="INSERT INTO gadung values('".$machuyen."','".$maga."','".$giodung."','".$giodi."',".$sttdung.")";
              echo $sql;
              $query=pg_query($conn,$sql);
              $sql="SELECT * FROM gadung where machuyen='".$machuyen."' and maga='".$maga."'";
              $query=pg_query($conn,$sql);
              $num_row=pg_num_rows($query);
              if($num_row)
                {        echo '<script language="javascript">';
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

    <!-- end .content --></div>

    <div class="container">
      <div class="row">
        <table class="w3-table w3-striped">
          <h2 class="w3-text-teal">Danh sách chuyến tàu</caption>
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã Chuyến</th>
              <th>Mã Ga</th>
              <th>STT Dừng</th>
              <th>Giờ Dừng</th>
              <th>Giờ Đi</th>
              <th>Thao Tác</th>
            </tr>
          </thead>
          <tbody>
            <br><br><br>
          <?php
            $stt = 1 ;
            $sql = "SELECT * FROM gadung order by machuyen,sttdung";
            if(isset($_POST["btn_search"]))
            {
              $machuyen=$_POST["machuyen"];
              $maga=$_POST["maga"];
              $giodung=$_POST["giodung"];
              $giodi=$_POST["giodi"];
              $sttdung=$_POST["sttdung"];
              if($machuyen=="" and $maga=="" and $giodung=="" and $giodi=="" and $sttdung=="")
              echo "Hãy điền ít nhất 1 trường!";
              else
              {
              $string_machuyen=($machuyen=="")?"1=0":"machuyen='".$machuyen."'";
              $string_maga=($maga=="")?"1=0":"maga='".$maga."'";
              $string_giodung=($giodung=="")?"1=0":"giodung='".$giodung."'";
              $string_giodi=($giodi=="")?"1=0":"giodi='".$giodi."'";
              $string_sttdung=($sttdung=="")?"1=0":"sttdung=".$sttdung."";
              $sql="select * from gadung where ".$string_machuyen." or ".$string_maga." or ".$string_giodung." or ".$string_giodi." or ".$string_sttdung." order by machuyen,sttdung asc ";
              }
            }
            // thực thi câu $sql với biến conn lấy từ file connection.php
            $query = pg_query($conn,$sql);
            while ($data = pg_fetch_array($query)) {
          ?>
            <tr>
              <th scope="row"><?php echo $stt++ ;?></th>
              <td><?php echo $data["machuyen"]; ?></td>
              <td><?php echo $data["maga"]; ?></td>
              <td><?php echo $data["sttdung"]; ?></td>
              <td> <?php echo $data["giodung"]; ?></td>
              <td><?php echo $data["giodi"]; ?></td>
              <td><a href="../php/chinh-sua-gadung.php?machuyen=<?php echo $data["machuyen"]; ?>&maga=<?php echo $data["maga"]; ?>">Sửa</a> 
                <a href="../php/xoa-gadung.php?machuyen=<?php echo $data["machuyen"]; ?>&maga=<?php echo $data["maga"]; ?>">Xóa</a></td>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
