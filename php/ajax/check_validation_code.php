<?php

session_start();
include '../script/my_db.php';

include '../script/setPassword.php';

if(!isset($_SESSION['active_code']) or !isset($_SESSION['active_limited']) or !isset($_SESSION['phone'])){
    echo 'NOT_VALID 1';
    die;
}
if(!isset($_POST['vl']) or !isset($_POST['ph'])){
    echo 'NOT_VALID 2';
    die;
}
if($_POST['vl'] != $_SESSION['active_code'] or $_SESSION['phone'] != $_POST['ph']){
    echo 'NOT_VALID 3';
    die;
}
if(!is_key_valid($_POST['vl'],$_POST['ph'])){
    echo 'NOT_VALID 4';
    die;
}
if($_SESSION['active_limited'] < time()){
    echo 'NOT_VALID 5';
    die;
}else{
    $_SESSION['is_login'] = 'LOGIN';
    $phone = setPassword('0'.$_SESSION['phone']);
    $sql = "SELECT * FROM `user` WHERE `phone`='$phone' ";
    $r = mysqli_query($connect , $sql);
    if($re = mysqli_fetch_assoc($r)){
        $uid = $re['id'];
        $sql = "INSERT INTO `chat_list` (`id`, `buyer`, `post`, `seller`, `message`, `seen`, `date`, `sender`) VALUES (NULL, '$uid', '0', '0', 'ورود شما با موفقیت انجام شد', '0', '2022-06-27 07:29:17.000000', '0');";
        $r = mysqli_query($connect , $sql);
    }
   

    $_SESSION['phone'] = setPasswordCookie(setPassword('0'.$_SESSION['phone']));
    ini_set("session.cookie_domain", ".bekharbefrush.ir");
    //setcookie('UKEDYBSGTH','94jdey7e2dutt8qw09230903', ['expires'=>time()+(86400 * 30) ,'path'=>'/','httponly'=>TRUE]);
    //setcookie('pednoieiijeiocenoi',$_SESSION['phone'], ['expires'=>time()+(86400 * 30) ,'path'=>'/', 'httponly'=>TRUE]);
    
    $cookie_name = "UKEDYBSGTH";
    $cookie_value = '94jdey7e2dutt8qw09230903';
    setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
    
    $cookie_name = "pednoieiijeiocenoi";
    $cookie_value = '94jdey7e2dutt8qw09230903';
    setcookie($cookie_name, $_SESSION['phone'], time() + (86400 * 365), "/"); // 86400 = 1 day
    
    
    $_SESSION['IS_LOGIN_CODE'] = 'yes';
    echo 'VALID';
}
//UKEDYBSGTH=is_user_login?
//JBEHJBEUEIEUIO = USER NOT LOGIN
//94jdey7e2dutt8qw09230903 = USER IS LOGIN
//pednoieiijeiocenoi = Phone Number





function is_key_valid($key,$phone){
    return (preg_match('#^[0-9]{5}$#',$key) and preg_match('#^9[01239][0-9]{8}$#',$phone));
}



?>