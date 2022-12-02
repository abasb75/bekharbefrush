<?php
session_start();
if(!isset($_SESSION['img_key'])){
    die;
}
if(!isset($_FILES['file'])){
    die;
}
if(!isset($_POST['idr'])){
    die;
}
if(!isset($_POST['token'])){
    die;
}

if($_FILES['file']['error'] != 0){
    die;
}

if($_FILES['file']['size'] > 4000 * 1024){
    die;
}

$path = $_FILES['file']['tmp_name'];
$type = $_FILES['file']['type'];

$data = file_get_contents($path);
$base64 = 'data:' . $type . ';base64,' . base64_encode($data);




$imgKey = $_SESSION['img_key'].'';
$idr = (int)$_POST['idr'];
$token = $_POST['token'];
include '../script/my_db.php';
if(!$connect){die;}
$query = "";

$statement = mysqli_prepare($connect,"INSERT INTO `post_image`( `data`, `post_key`, `idr` , tab_id) VALUES ('$base64',?,?,?)");

mysqli_stmt_bind_param($statement,'sis',$imgKey,$idr,$token);

//$status = mysqli_stmt_execute($statement);

if($result = mysqli_stmt_execute($statement) ){
    echo 'OK';
}else{
    echo '<img src="'.$base64.'" >';
    
}





?>