<?php include("../template/header.php"); ?>

  <div class="w3-col m9">
  <div class="content">

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
   ?>
    <table class="table">
      <tr>
        <td>Tên Đăng nhập:</td>
        <td><u><?php echo $username=$_SESSION['username'] ;?></u></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><u><?php 
          $conn=require_once("../lib/connection.php");
          $sql="SELECT * FROM admin WHERE login='".$username."'";
          $query=pg_query($conn,$sql);
          $data=pg_fetch_array($query);
          $email=$data["email"]; 
          echo $email,$user;
           ?></u>
       </td>
      </tr>
    </table>
    <!-- end .content --></div>
  </div>
<br>
 <a href="../php/chinh-sua-admin.php"><button type="button" class="w3-btn w3-teal"> Chỉnh sửa thông tin </button></a>


</body>
</html>
