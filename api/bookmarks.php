<?php

include '../php/script/my_db.php';

include_once '../php/script/user_default_array.php';
include_once '../php/script/get_user_info_login.php';


$userId = $_USER['id'];

if($userId == '0'){
    die;
}







$sqlList = "SELECT * FROM post WHERE post.userId != $userId AND post.id IN (SELECT post_id FROM favs WHERE user_id=$userId ORDER BY id DESC);";
//echo $sqlList;
//die;
function create_price($pr){ if($pr=='0' or $pr == ''){ return 'توافقی'; } $new_pr = ''; $counter = 1; for($i=strlen($pr)-1;$i>=0;$i--){ if($counter==3 and $i!=0){ $new_pr = ','.$pr[$i].$new_pr; $counter = 1; continue; }else{ $new_pr = $pr[$i].$new_pr; $counter++; } } $new_pr = $new_pr .' تومان'; return $new_pr; }


function get_duration_time($time){
    $diff = abs(time() - strtotime($time));
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


$result = mysqli_query($connect,$sqlList);
$json = ['status'=>404,'post'=>array()];
while($r = mysqli_fetch_assoc($result)){
    $json['status']= 200;
    $id = $r['id'];
    $title = $r['title'];
    $price1 = 'ودیعه : توافقی';
    $price2 = 'اجاره : توافقی';
    if($r['category']=='1' and $r['type']=='4'){
        $price1 = 'ویدیعه : '.create_price($r['price_1']);
        $price2 = 'اجاره : '.create_price($r['price_2']);
    }else{
        $price1 = '';
        $price2 = 'قیمت : '.create_price($r['price_1']);
    }
    $timing = get_duration_time($r['release_date']);
    $city = 'تهران';
    $post_city_id = $r['city'];
    $sumbnail = $r['sumbnial'];
    if($sumbnail != '' && preg_match('#^asset#',$sumbnail)){
        $sumbnail = $_MAIN_URL.$sumbnail;
    }

    $csql = "SELECT * FROM cities WHERE id=$post_city_id;";
    $rc = mysqli_query($connect,$csql);
    if($city_array = mysqli_fetch_assoc($rc)){
        $city = $city_array['name'];
    }
    /*
    $idata = '0';
    if($r['idr'] != '0'){
        $main_idr = $r['idr'];
        $sqle = "SELECT * FROM `posts_image` WHERE id=$main_idr;";
        $ret = mysqli_query($connect , $sqle);
        if($rq = mysqli_fetch_assoc($ret)){
            $idata = $rq['data'];
        }
    } */
    $url = $_MAIN_URL .'p/'. $r['uniccode'].'/'.str_replace(' ','-',$title);
    $code = $r['uniccode'];
    $arr = ['i'=>$id,'title'=>$title,'p1'=>$price1,'p2'=>$price2,'time'=>$timing,'location'=>$city,'url'=>$url,'code'=>$code,'sumbnail'=>$sumbnail];
    array_push($json['post'],$arr);
}

echo (json_encode($json));

function remove_stop_words($words){
    $a = explode(' ',$words);
    
    $b = array();
    
    for ($i=0;$i<sizeof($a);$i++){
        $a[$i] = preg_replace('#[^a-zA-Zآابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ\s]{1}#','',$a[$i]);
        if(mb_strlen($a[$i])<=1){
            continue;
        }
        array_push($b , $a[$i]);
    }
    return $b;
}



?>