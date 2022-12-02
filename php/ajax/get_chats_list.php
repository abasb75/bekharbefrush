<?php


$_USER = ['id'=>0,'phone'=>'','name'=>'','status'=>'NOT_LOGIN','mail'=>''];

include '../script/my_db.php';

include '../script/setPassword.php';
include '../script/get_user_info_login.php';
include '../script/unic-code.php';

if($_USER['id'] == 0){
   echo 'er1'; die;
}



$id = $_USER['id'];

$nowFormat = date('Y-m-d H:i:s');
$sql2 = "UPDATE `user` SET `last_seen`='$nowFormat' WHERE `id`=$id;";
$r2 = mysqli_query($connect,$sql2);


$sql = "SELECT c.buyer as buyerId,c.seller as sellerId,c.sender as senderId ,c.post as postId, c.seen as seen, c.date as date, c.message as message, c.id as cid, u.name as nam, p.sumbnial as img , p.title as title FROM `chat_list` as c , user as u , post as p WHERE (u.id = c.seller or u.id = c.buyer) and u.id != $id and (c.post = p.uniccode) AND c.id IN ( SELECT MAX(c.id) FROM chat_list as c WHERE (c.seller = $id or c.buyer=$id) GROUP BY c.seller , c.buyer,c.post ) ORDER BY c.id DESC;";
$result = mysqli_query($connect , $sql);

$arr = array();
while($r = mysqli_fetch_assoc($result)){
    $name = $r['nam'];
    if($name == ''){
        $name = 'کاربر';
    }
    $img = $r['img'];
    $message = $r['message'];
    $seller = $r['sellerId'];
    $buyer = $r['buyerId'];
    $post = $r['postId'];
    $sender = $r['senderId'];
    $title = $r['title'];
    $myads = '0';
    if($id==$seller){
        $myads='1';
    }
    $unread = $r['seen'];
    if($sender == $id){
        $unread = '1';
    }

    $now = date('Y-m-d H:i:s');
    $date = $r['date'] ;
    $timing = get_duration_time($now,$date);
    array_push($arr,[
        'name'=>$name,
        'image'=>$img,
        'last_message' => $message,
        'seller'=>$seller,
        'buyer'=>$buyer,
        'post'=>$post,
        'title'=>$title,
        'ismypost'=>$myads,
        'unread'=>$unread,
        'date'=>$timing
    ]);
}




echo json_encode($arr);


function get_duration_time($now,$date){
    $diff = abs(strtotime($now) - strtotime($date));
    if($diff > 31536000){
        return floor($diff/(31536000)).' سال پیش';
    }elseif($diff > 2592000){
        return floor($diff/(2592000)).' ماه پیش';
    }elseif($diff > 604800){
        return floor($diff/(604800)).' هفته پیش';
    }elseif($diff > 86400){
        return floor($diff/(86400)).' روز پیش';
    }elseif($diff > 3600){
        return floor($diff/(3600)).' ساعت پیش';
    }elseif($diff > 60){
        return floor($diff/(60)).' دقیقه پیش';
    }else{
        return 'لحضاتی قبل';
    }
}