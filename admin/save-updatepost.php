<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $file_name = $_POST['old-image'];
}else{
    $error = array();
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = end(explode('.',$file_name));
    $extension = array('jpeg','jpg','png');

    if(in_array($file_ext,$extension) === false){
        $error[]="this extension file are not allowed please chosse jpg or png image";
    }
    if($file_size >2097152){
        $error[] = "file size must be 2mb or lower than 2 mb";
    }
    if(empty($error)==true){
        move_uploaded_file($file_tmp,"uploade".$file_name);
    }else{
        print_r($error);
        die();
    }
}
    $sql ="UPDATE post SET title = '{$_POST["post_title"]}',description = '{$_POST["postdesc"]}',category = {$_POST["category"]},
    post_img = '{$file_name}' WHERE post_id =  {$_POST["post_id"]}";
    $result = mysqli_query($connection,$sql);
    if($result){
        header("Location:$hostname/admin/post.php");
    }else{
        echo "query failed";
    }
?>