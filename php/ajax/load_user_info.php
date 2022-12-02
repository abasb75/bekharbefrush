<?php

$_USER = ['id'=>0,'phone'=>'','name'=>'','status'=>'NOT_LOGIN','mail'=>''];

include '../script/my_db.php';

include '../script/setPassword.php';
include '../script/get_user_info_login.php';
include '../script/unic-code.php';
include '../script/jdf.php';


if($_USER['id'] == 0){
    die;
}

$id = $_USER['id'];

$nowFormat = date('Y-m-d H:i:s');
$sql2 = "UPDATE `user` SET `last_seen`='$nowFormat' WHERE `id`=$id;";
$r2 = mysqli_query($connect,$sql2);


if(!isset($_GET['p'])){
    die;
}
$post = $_GET['p'];
if(!preg_match('#^[a-zA-Z0-9]{8,64}$#',$post) and $post != '0'){
    die;
}

if(!isset($_GET['s'])){
    die;
}
$seller = $_GET['s'];
if(!preg_match('#^[0-9]{2,10}$#',$seller) and $seller != '0'){
    die;
}

if(!isset($_GET['b'])){
    die;
}
$buyyer = $_GET['b'];
if(!preg_match('#^[0-9]{2,10}$#',$buyyer)){
    die;
}

if($seller != $id and $buyyer != $id){
    die;
}


$sql = "SELECT * FROM `chat_list` WHERE chat_list.buyer=$buyyer AND chat_list.seller=$seller AND chat_list.post='$post';";
$result = mysqli_query($connect,$sql);
$array = array();
$last_time = '';

while($r = mysqli_fetch_assoc($result)){

    // time excute
    $date = $r['date'];
    $clock = explode(' ',$date);
    $clock = explode(':',$clock[1]);
    $clock = $clock[0].':'.$clock[1];

    $day = getDay($date);
    if($day != $last_time){
        $last_time = $day;
        array_push($array,['type'=>'newDay' , 'value'=>$day]);
    }
    $type = 'contact_message';
    if($r['sender'] == $id){
        $type = 'mymessage';
    }
    array_push($array,[
        'type'=>$type,
        'time'=>$clock,
        'data'=>$r
    ]);


}

$contact = $seller;
if($seller == $id){
    $contact = $buyyer;
}
$sql = "SELECT * FROM `user` WHERE id=$contact;";
$result = mysqli_query($connect,$sql);
if($r = mysqli_fetch_assoc($result)){
    $now = date('Y-m-d H:i:s');
    $date = $r['last_seen'] ;
    $timing = get_duration_time($now,$date);
    array_push($array,[
        'type'=>'info',
        'value'=>$timing
    ]);
}


echo json_encode($array);


function getDay($date){
    $time = strtotime($date);
    return jdate('l، d F Y',$time);
}



function get_duration_time($now,$date){
    $diff = abs(strtotime($now) - strtotime($date));
    if($diff > 604800){
        return  'مدتی زمان زیادی آنلاین نشده است';
    }elseif($diff > 86400){
        return 'آخرین بازدید : ' . floor($diff/(86400)).' روز پیش';
    }elseif($diff > 3600){
        return 'آخرین بازدید : ' . floor($diff/(3600)).' ساعت پیش';
    }elseif($diff > 60){
        return 'آخرین بازدید : ' . floor($diff/(60)).' دقیقه پیش';
    }elseif($diff > 5){
        return 'آخرین بازدید : لحظاتی قبل';
    }else{
        return 'آنلاین';
    }
}