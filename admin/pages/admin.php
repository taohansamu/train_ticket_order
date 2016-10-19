<?php
session_start();
?>
<html>
<head>
  <title>Trang đăng nhập</title>
  <meta charset="utf-8">
</head>
<body>
  <?php 
    $conn=require_once("lib/connection.php");

    //$conn=pg_connect("host=localhost port=5432 dbname=quanlitau user=postgres password=dinhtao995");
    if(!$conn)print "Không thể kết nối tới database";
    if(isset($_POST["btn_submit"]))
    { 
      $username=$_POST["username"];
      $password=$_POST["password"];
      if($username=="" or $password=="")
      {
        print "Bạn không được bỏ trống trường nào !";
      }
      else
        {
          
          $sql="select * from admin where login='".$username."' and password='".$password."'";
          echo $sql;
          $query=pg_query($conn,$sql);
          $num_row=pg_num_rows($query);

          if($num_row==0)print "<br>Tên đăng nhập hoặc mật khẩu không đúng !";
          else
            {
              $_SESSION['username']=$username;
              header('Location:index.php');
            }
        }
    }
   ?>
  <form method="POST" action="login.php">
  <fieldset>
      <legend>Xác nhận lại mật khẩu</legend>
        <table>
          <tr>
            <td>Username</td>
            <td><input type="text" name="username" size="30"></td>
          </tr>
          <tr>
            <td colspan="2">
            </td>
          </tr>
          <tr>
            <td colspan="2">
            </td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input type="password" name="password" size="30"></td>
          </tr>
          <tr>
            <td colspan="2" align="center"> <input name="btn_submit" type="submit" value="Đăng nhập"></td>
          </tr>
        </table>
  </fieldset>
  </form>
</body>
</html>