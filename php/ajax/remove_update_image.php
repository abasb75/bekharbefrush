<?php

session_start();

 if(!isset( $_SESSION['edit_post']) or !isset($_SESSION['edit_post_key'])) {
    echo 'er1'; 
    die;
     
 }
 if($_SESSION['edit_post']!='ENABLE'){
    echo 'er2';die;
     
 }

if(!isset($_GET['token'])){
    echo 'er4';die;
    
}
$token = $_GET['token'];

if(!isset($_GET['img'])){
    echo 'er5';die;
}


$img = $_GET['img'];

include_once '../script/my_db.php';
include_once '../script/user_default_array.php';
include_once '../script/get_user_info_login.php';


if($_USER['status'] != 'LOGIN'){
    echo 'er5';die;
    
}

if(preg_match('#^th#',$img)){
    $sql = "INSERT INTO `update_image`( `type`, `imageData`, `edit_key`) VALUES (2,'$img','$token')";
   if( mysqli_query($connect,$sql)){
       echo 'ok';die;
   }
}

$sql = "DELETE FROM `update_image` WHERE `id`='$img' AND `edit_key`='$token' LIMIT 1;";
if( mysqli_query($connect,$sql)){
    echo 'ok';die;
}