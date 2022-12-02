<?php
session_start();
if(!isset( $_SESSION['edit_post']) or !isset($_SESSION['edit_post_key'])) {
   echo 'er1';die;
}
if($_SESSION['edit_post']!='ENABLE'){
    echo 'er2';die;
  
}
if( !isset($_GET['t']) || !isset($_GET['p']) ){
    echo 'er3';die;
}
$post = $_GET['p'];
if(!preg_match('#^[0-9a-zA-Z]{4,64}$#',$post)){
    echo 'er4';die;
}



include_once '../script/user_default_array.php';
include_once '../script/my_db.php';

include_once '../script/setPassword.php';
include_once '../script/get_user_info_login.php';

if($_USER['status'] != 'LOGIN'){
    echo 'er5';die;
}

$sql = "DELETE FROM `post` WHERE `uniccode`='$post'";
$r = mysqli_query($connect,$sql);
if($r){
    echo 'OK';
}


