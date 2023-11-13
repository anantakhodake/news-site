<?php
include "config.php";
$category_id =$_GET['id'];
$sql1 ="delete from category where category_id='{$category_id}'";
if(mysqli_query($connection,$sql1)){
    header("Location:$hostname/admin/category.php");
}else{
    echo "cant delete the category";
}
mysqli_close($connection);
?>