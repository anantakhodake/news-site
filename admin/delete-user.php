<?php
include "config.php";
$user_id =$_GET['id'];
$sql = "delete from user where user_id = {$user_id}";
if(mysqli_query($connection,$sql)){
    header("Location: {$hostname}/admin/users.php");
}else{
    echo"<p style='color:red; text-align:center;'>cant delete record of user</p>";
} 
mysqli_close($connection);
?>