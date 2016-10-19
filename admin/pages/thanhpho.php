<?php include("../template/header.php"); ?>

  <div class="w3-col m9">
        <div class="w3-card-4 " style="height: 535px">
    <form action="thanhpho.php" method="POST" class="w3-form">
         <h2 class="w3-text-teal" > Thêm Thành Phố </h2>
    <div class="w3-group">  
    <input class="w3-input" type="text" style="width:95%" name="matp" required>
    <label class="w3-label">Mã Thành Phố</label>
  </div>
  <div class="w3-group">  
    <input class="w3-input " type="text" style="width:95%" name="tentp"required>
    <label class="w3-label">Tên Thành Phố</label>
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
        $matp=$_POST["matp"];
        $tentp=$_POST["tentp"];
        if($matp=="" or $tentp=="")
          echo "KHÔNG ĐƯỢC BỎ TRỐNG TRƯỜNG NÀO !";
        else
          {
            
              $sql="SELECT * FROM ttp where matp='".$matp."'";
              $query=pg_query($conn,$sql);
              $num_row=pg_num_rows($query);
            
            if($num_row)
            {
              echo '<script language="javascript">';
                echo 'alert("Đã tồn tại thành phố này")';
                echo '</script>';
            }
            else
            {
              $sql="INSERT INTO ttp values('".$matp."','".$tentp."')";
              $query=pg_query($conn,$sql);
              $sql="SELECT * FROM ttp where matp='".$matp."'";
              $query=pg_query($conn,$sql);
              $num_row=pg_num_rows($query);
              if($num_row)
                {echo '<script language="javascript">';
                echo 'alert("Nhập thành công")';
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
          <h2 style="color:teal"  >Danh sách thành phố</h2>
          <thead>
            <tr>
              <th>STT</th>
              <th>MÃ TP</th>
              <th>TÊN TP</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

             <br><br><br>
    
          <?php
            $stt = 1 ;
            $sql = "SELECT * FROM ttp";
            if(isset($_POST["btn_search"]))
            {
              $matp=$_POST["matp"];
              $tentp=$_POST["tentp"];
              $string_matp=($matp=="")?"1=0":"matp='".$matp."'";
              $string_tentp=($tentp=="")?"1=0":"tentp='".$tentp."'";
              $sql="select * from ttp where ".$string_matp." or ".$string_tentp." order by matp";
            }
            // thực thi câu $sql với biến conn lấy từ file connection.php
            $query = pg_query($conn,$sql);
            while ($data = pg_fetch_array($query)) {
          ?>
            <tr>
              <th scope="row"><?php echo $stt++ ?></th>
              <td><?php echo $data["matp"]; ?></td>
              <td><?php echo $data["tentp"]; ?></td>
              <td><a href="../php/chinh-sua-tp.php?id=<?php echo $data["matp"]; ?>">Sửa</a> <a href="../php/xoa-tp.php?id=<?php echo $data["matp"]; ?>">Xóa</a></td>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
