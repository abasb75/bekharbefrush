<?php


$_USER = ['id'=>0,'phone'=>'','name'=>'','status'=>'NOT_LOGIN','mail'=>''];

include '../script/my_db.php';

include '../script/setPassword.php';
include '../script/get_user_info_login.php';
include '../script/unic-code.php';

if($_USER['id'] == 0){
   die;
}

if(!isset($_POST['m'])){
    die;
}

if(!isset($_POST['u'])){
    die;
}

if(!isset($_POST['p'])){
    die;
}

$sender = $_USER['id'];
$getter = $_POST['u'];
$message = $_POST['m'];
$post = $_POST['p'];
$seller = '0';
$buyyer = '0';
if(!preg_match('#^[a-zA-Z0-9]{8,64}$#',$post) and $post != '0'){
    die;
}

if($post == '0' and $seller == '0'){
    $nowFormat = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `chat_list`( `sender`,`buyer`, `post`, `seller`, `message`, `seen`, `date`) VALUES ($sender,$sender,'$post','0',?,'0','$nowFormat');";



    $statement = mysqli_prepare($connect,$sql);

    mysqli_stmt_bind_param($statement,'s',$message);


    if($result = mysqli_stmt_execute($statement) ){
        echo 'OK';
    }else{
        die;
        
    }
}

$sql = "SELECT * FROM `post` WHERE post.uniccode = '$post';";

$result = mysqli_query($connect,$sql);

if($r = mysqli_fetch_assoc($result)){
    if($r['userId'] == $sender){
        $seller = $sender;
        $buyyer = $getter;
    }elseif($r['userId'] == $getter){
        $seller = $getter;
        $buyyer = $sender;
    }else{
        die;
    }
}else{
    die;
}

if($seller == '0' or $buyyer == '0'){
    die;
}
$nowFormat = date('Y-m-d H:i:s');
$sql = "INSERT INTO `chat_list`( `sender`,`buyer`, `post`, `seller`, `message`, `seen`, `date`) VALUES ($sender,$buyyer,'$post',$seller,?,'0','$nowFormat');";



$statement = mysqli_prepare($connect,$sql);

mysqli_stmt_bind_param($statement,'s',$message);


if($result = mysqli_stmt_execute($statement) ){
    echo 'OK';
}else{
    die;
    
}