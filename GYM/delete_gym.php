<?php

require 'conn.php';
$id = $_GET['id'];
$stmt =   $conn->prepare("delete from gym where id  = ? ");


$stmt->bind_param( "i" , $id);
$result = $stmt->execute();

if($result){
 
       echo "<script>
       alert('GYM Branch Deleted');
       window.location = 'admin.php';
   </script>";

}

