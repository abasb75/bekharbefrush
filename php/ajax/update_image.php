<?php
 session_start();

 if(!isset( $_SESSION['edit_post']) or !isset($_SESSION['edit_post_key'])) {

    die;
     
 }
 if($_SESSION['edit_post']!='ENABLE'){
   die;
     
 }
 if(!isset($_FILES['image'])){
  die;
    
}
if(!isset($_POST['token'])){
   die;
    
}

$token = $_POST['token'];
include_once '../script/my_db.php';
include_once '../script/user_default_array.php';
include_once '../script/get_user_info_login.php';


if($_USER['status'] != 'LOGIN'){
die;
    
}


$path = $_FILES['image']['tmp_name'];
$type = $_FILES['image']['type'];

$data = file_get_contents($path);
$base64 = 'data:' . $type . ';base64,' . base64_encode($data);
$sql = "INSERT INTO `update_image`(  `type`, `imageData`, `edit_key`) VALUES (1,'$base64','$token')";

if(mysqli_query($connect,$sql)){
    echo mysqli_insert_id($connect);
}else{
   
}