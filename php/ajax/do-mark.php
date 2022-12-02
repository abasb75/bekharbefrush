<?php


if(!isset($_GET['pid'])){die;}
$pid = $_GET['pid'];

if(!preg_match('#^[0-9a-zA-Z]{4,16}$#',$pid)){
    die; 
}

include '../script/my_db.php';




include '../script/user_default_array.php';
include '../script/get_user_info_login.php';

if($_USER['id'] == '0' and $_USER['id'] == 0){ die; }
$user_id = $_USER['id'];

$query = "SELECT * FROM `post` WHERE `uniccode`='$pid'";
$result = mysqli_query($connect, $query);
if($r = mysqli_fetch_assoc($result)){
    $post_id = $r['id'];
    $query = "SELECT * FROM `favs` WHERE `user_id`=$user_id AND `post_id`=$post_id";
    $result = mysqli_query($connect,$query);
    if($r = mysqli_fetch_assoc($result)){
        echo 'OK';
    }else{
        $query = "INSERT INTO `favs`( `user_id`, `post_id`) VALUES ('$user_id','$post_id')";
        $result = mysqli_query($connect,$query);
        echo 'OK';
    }
}else{
    die;
}
