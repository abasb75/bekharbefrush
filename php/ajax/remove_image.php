<?php
session_start();

if(!isset($_SESSION['img_key'])){
    echo '1';
    die;
}
if(!isset($_POST['idr'])){
    echo '2';
    die;
}

include '../script/my_db.php';
if(!$connect){die;}


$idr = $_POST['idr'];
$img_Key = $_SESSION['img_key'];
$query = "DELETE FROM `post_image` WHERE `post_image`.`idr`=$idr AND `post_image`.`post_key`='$img_Key';";
$status = mysqli_query($connect,$query);
if($status ){
    echo 'OK';
}else{
    echo '3';
    
}
?>