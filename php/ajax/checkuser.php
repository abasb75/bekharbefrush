<?php
session_start();


if(isset($_SESSION['IS_LOGIN_CODE']) and $_SESSION['IS_LOGIN_CODE'] == 'no'){
    echo 'VOID';die;
}
include '../script/my_db.php';

$_USER = ['id'=>0,'phone'=>'','name'=>'','status'=>'NOT_LOGIN','mail'=>''];

include '../script/setPassword.php';
include '../script/get_user_info_login.php';

if($_USER['status'] != 'LOGIN'){
    echo 'VOID';
}else{
    echo 'NO';
}


?>