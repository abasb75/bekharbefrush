<?php

include_once 'createPrice.php';
function createProductData($post,$city,$state,$category,$sender){
    global $connect,$userId,$_MAIN_URL;
    unset($sender['id']);
    unset($sender['validation_code']);
    unset($sender['time']);
    unset($post['category']);
    unset($post['city']);
    unset($post['state']);
    unset($post['sumbnial']);
    unset($post['userId']);
    
    $sender['phone'] = openPassword($sender['phone']);
    
    $price1 = 'ودیعه : توافقی';
    $price2 = 'اجاره : توافقی';
    if($category['id']=='1' and $post['type']=='4'){
        $price1 = 'ویدیعه : '.createPrice($post['price_1']);
        $price2 = 'اجاره : '.createPrice($post['price_2']);
    }else{
        $price1 = '';
        $price2 = 'قیمت : '.createPrice($post['price_1']);
    }
    $post['p1'] = $price1;
    $post['p2'] = $price2;
    
    if($post['type']=='1'){
        $type = 'فروشی';
    }elseif($post['type']=='2'){
        $type = 'فروش یا معاوضه';
    }elseif($post['type']=='3'){
        $type = 'معاوضه';
    }elseif($post['type']=='4'){
        $type = 'اجاره';
    }elseif($post['type']=='5'){
        $type = 'درخواستی';
    }elseif($post['type']=='6'){
        $type = 'خدمات';
    }else{
        $type = 'نامشخص';
    }
    
    
    $post['type'] = $type;
    
    if($post['status']=='1'){
        $status = 'نو';
    }elseif($post['status']=='2'){
        $status = 'در حد نو';
    }elseif($post['status']=='3'){
        $status = 'دست دوم';
    }elseif($post['status']=='4'){
        $status = 'نیازمند تعمییر';
    }else{
        $status = 'نامشخص';
    }
    
    $post['status'] = $status;
    
    
    $images = array();
    $post_id = $post['id'];
            $post_id = $post['id'];
            $sql ="SELECT * FROM `posts_image` WHERE postId=$post_id";
            $ret = mysqli_query($connect , $sql);
            while($r2 = mysqli_fetch_assoc($ret)){
                if(preg_match('#^assets#',$r2['data'])){
                    array_push($images,$_MAIN_URL.$r2['data']);
                }else{
                    array_push($images,$r2['data']);
                }
            }
    
    $date1 = $post['release_date'];
    $date2 = date('Y-m-d H:m:s');
    $diff = abs(strtotime($date2) - strtotime($date1));
    if($diff > 31536000){
        $t =  floor($diff/(31536000)).' سال پیش';
    }elseif($diff > 2592000){
        $t = floor($diff/(2592000)).' ماه پیش';
    }elseif($diff > 604800){
        $t = floor($diff/(604800)).' هفته پیش';
    }elseif($diff > 86400){
        $t = floor($diff/(86400)).' روز پیش';
    }elseif($diff > 3600){
        $t = floor($diff/(3600)).' ساعت پیش';
    }elseif($diff > 60){
        $t = floor($diff/(60)).' دقیقه پیش';
    }else{
        $t = 'لحضاتی قبل';
    }
    
    
    $post['timed'] = jdate('l، d F Y ساعت H:i',strtotime($post['release_date']));;
    $post['release_date'] = $t;
    
    $is_mark = '0';
    if($userId != 0 and $userId != '0'){
        $queryq = "SELECT * FROM `favs` WHERE `post_id`=$post_id AND `user_id`=$userId";
        $er = mysqli_query($connect,$queryq);
        if($ru = mysqli_fetch_assoc($er)){
            $is_mark = '1';
        }
    }
    if(isset($_SESSION['edit_post_key'])){
        return ['post'=>$post,'location'=>$city,'state'=>$state,'category'=>$category,'sender'=>$sender,'images'=>$images,'mark'=>$is_mark,'token'=>md5($_SESSION['edit_post_key'])];
    }else{
        return ['post'=>$post,'location'=>$city,'state'=>$state,'category'=>$category,'sender'=>$sender,'images'=>$images,'mark'=>$is_mark];
    }
    
}