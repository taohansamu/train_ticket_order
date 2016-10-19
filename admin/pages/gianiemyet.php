<?php include("../template/header.php"); ?>
  <div class="w3-col m9">
        <div class="w3-card-4 " style="height: 535px">
    <form action="gianiemyet.php" method="POST" class="w3-form">
         <h2 class="w3-text-teal" > Thêm Giá </h2>
    <div class="w3-group">  
    <input class="w3-input" type="text" style="width:95%"name="machuyen" >
    <label class="w3-label">Mã Chuyến</label>
  </div>
  <div class="w3-group">  
    <input class="w3-input " type="text"style="width:95%" name="maloaitoa">
    <label class="w3-label">Mã Loại Toa </label>
  </div>
  <div class="w3-group">  
    <input class="w3-input " type="text" style="width:95%"name="maga">
    <label class="w3-label">Mã Ga</label>
  </div>
    <div class="w3-group">  
    <input class="w3-input" type="number"style="width:95%" name="giatien" step="1000" >
    <label class="w3-label">Giá Tiền</label>
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
       $maloaitoa=$_POST["maloaitoa"];
        $giatien=$_POST["giatien"];
        $machuyen=$_POST["machuyen"];
        $maga=$_POST["maga"];
        if($maloaitoa==""  or $giatien=="" or $machuyen=="" or $maga=="" )
          echo "KHÔNG ĐƯỢC BỎ TRỐNG TRƯỜNG NÀO !";
        else
          {
            
              $sql="SELECT * FROM gianiemyet where maga='".$maga."' and machuyen='".$machuyen."' and maloaitoa='".$maloaitoa."'";
              $query=pg_query($conn,$sql);
              $num_row=pg_num_rows($query);
            
            if($num_row)
            {
                      echo '<script language="javascript">';
                echo 'alert("Đã tồn tại mã chuyến này")';
                echo '</script>';
            }
            else
            {
              $sql="INSERT INTO gianiemyet values('".$machuyen."','".$maloaitoa."','".$maga."',".$giatien.")";
              $query=pg_query($conn,$sql);
              $sql="SELECT * FROM gianiemyet where maga='".$maga."' and machuyen='".$machuyen."' and maloaitoa='".$maloaitoa."'";
              $query=pg_query($conn,$sql);
              $num_row=pg_num_rows($query);
              if($num_row)
                {
                          echo '<script language="javascript">';
                echo 'alert("thêm thành công")';
                echo '</script>';
                $flag="added";
                }
                else
                {
                          echo '<script language="javascript">';
                echo 'alert("thêm không thành công")';
                echo '</script>';
                }
              }
          }
        }

 ?>
 </div>
 <!-- END CODE PHP -->

    <div class="container">
      <div class="row">
        <table class="w3-table w3-striped">
          <h2 style="color:teal"  >Thêm Giá</h2>
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã Chuyến</th>
              <th>Mã Loại Toa</th>
              <th>Mã Ga</th>
              <th>Giá Tiền</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

             <br><br><br>
    
          <?php
            $stt = 1 ;
            $sql = "SELECT * FROM gianiemyet order by machuyen";
            if(isset($_POST["btn_search"]))
            {
              $maga=$_POST["maga"];
              $giatien=$_POST["giatien"];
              $machuyen=$_POST["machuyen"];
              $maloaitoa=$_POST["maloaitoa"];
              if($maga=="" and $giatien=="" and $machuyen=="" and $maloaitoa=="")
              echo "Hãy điền ít nhất 1 trường!";
              else
              {
              $string_maga=($maga=="")?"1=1":"maga='".$maga."'";
              $string_giatien=($giatien=="")?"1=1":"giatien='".$giatien."'";
              $string_machuyen=($machuyen=="")?"1=1":"machuyen='".$machuyen."'";
              $string_maloaitoa=($maloaitoa=="")?"1=1":"maloaitoa='".$maloaitoa."'";
              $sql="select * from gianiemyet where ".$string_maga."  and ".$string_giatien." and ".$string_machuyen." and ".$string_maloaitoa." ";
              $query=pg_query($conn,$sql);
              if(!pg_num_rows($query))
              {
                $string_maga=($maga=="")?"1=0":"maga='".$maga."'";
                $string_giatien=($giatien=="")?"1=0":"giatien='".$giatien."'";
                $string_machuyen=($machuyen=="")?"1=0":"machuyen='".$machuyen."'";
                $string_maloaitoa=($maloaitoa=="")?"1=0":"maloaitoa='".$maloaitoa."'";
                $sql="select * from gianiemyet where ".$string_maga."  or ".$string_giatien." or ".$string_machuyen." or ".$string_maloaitoa." ";}
              }
            }
            // thực thi câu $sql với biến conn lấy từ file connection.php
            $query = pg_query($conn,$sql);
            while ($data = pg_fetch_array($query)) {
          ?>
            <tr>
              <th scope="row"><?php echo $stt++ ;?></th>
              <td><?php echo $data["machuyen"]; ?></td>
              <td><?php echo $data["maloaitoa"]; ?></td>
              <td><?php echo $data["maga"]; ?></td>
              <td><?php echo $data["giatien"]; ?></td>
              <?php $sent="machuyen=".$data["machuyen"]."&"."maga=".$data["maga"]."&"."maloaitoa=".$data["maloaitoa"];?>
              <td><a href="../php/chinh-sua-gianiemyet.php?<?php echo $sent; ?>">Sửa</a> <a href="../php/xoa-gianiemyet.php?<?php echo $sent; ?>">Xóa</a></td>
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
