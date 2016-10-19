<?php
$conn=pg_connect("host=localhost port=5432 dbname=train2 user=postgres password=hedspi");
if(!$conn) print "không thể kết nối tới database";
return $conn;
//else print "Ket noi den database thanh cong";
?>