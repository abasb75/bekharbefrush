<?php


if(!isset($_GET['pid'])){die;}
$pid = $_GET['pid'];

if(!preg_match('#^[0-9a-zA-Z]{4,16}$#',$pid)){
    die; 
}

if(!isset($_GET['bd'])){die;}
$bd = $_GET['bd'];



include '../script/my_db.php';




include '../script/user_default_array.php';
include '../script/get_user_info_login.php';

$user_id = $_USER['id'];

$query = "SELECT * FROM `post` WHERE `uniccode`='$pid'";
$result = mysqli_query($connect, $query);
if($r = mysqli_fetch_assoc($result)){
    $statement = mysqli_prepare($connect,"INSERT INTO `report`(`text`, `post`, `user_id`) VALUES (?,'$pid',$user_id)");

    mysqli_stmt_bind_param($statement,'s',$bd);
    if($result = mysqli_stmt_execute($statement) ){
        echo 'OK';
    }else{
        die;
    }
}else{
    die;
}
