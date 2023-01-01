<?php

include_once 'createPrice.php';
include_once 'getDurationTime.php';

function processPostData($r){
    $id = $r['id'];
    $title = $r['title'];
    $price1 = 'ودیعه : توافقی';
    $price2 = 'اجاره : توافقی';
    if($r['category']=='1' and $r['type']=='4'){
        $price1 = 'ویدیعه : '.createPrice($r['price_1']);
        $price2 = 'اجاره : '.createPrice($r['price_2']);
    }else{
        $price1 = '';
        $price2 = 'قیمت : '.createPrice($r['price_1']);
    }
    $timing = getDurationTime($r['release_date']);
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
    
    $url = $_MAIN_URL .'p/'. $r['uniccode'].'/'.str_replace(' ','-',$title);
    $code = $r['uniccode'];
    return [
        'i'=>$id,
        'title'=>$title,
        'p1'=>$price1,
        'p2'=>$price2,
        'time'=>$timing,
        'location'=>$city,
        'url'=>$url,
        'code'=>$code,
        'sumbnail'=>$sumbnail
    ];
}