<?php
session_start();

include '../php/script/my_db.php';

include_once '../php/script/setPassword.php';
include_once '../php/script/jdf.php';

include_once '../php/script/user_default_array.php';
include_once '../php/script/get_user_info_login.php';


$userId = $_USER['id'];

$array = ['status'=>404,'data'=>''];
if(!isset($_GET['id'])){
    
    echo json_encode($array);
    exit;
}
if(isset($_GET['c']) and $_GET['c']=='igi' ){
    $_SESSION['edit_post']='ENABLE';
    $_SESSION['edit_post_key'] = $userId . '_' . time();
}
$post_id = $_GET['id'];
if(!preg_match('#^[0-9|a-z|A-Z]{4,16}$#',$post_id)){
    echo json_encode($array);
    
    exit;
}

function create_price($pr){ if($pr=='0' or $pr == ''){ return 'توافقی'; } $new_pr = ''; $counter = 1; for($i=strlen($pr)-1;$i>=0;$i--){ if($counter==3 and $i!=0){ $new_pr = ','.$pr[$i].$new_pr; $counter = 1; continue; }else{ $new_pr = $pr[$i].$new_pr; $counter++; } } $new_pr = $new_pr .' تومان'; return $new_pr; }





$sql = "SELECT * FROM `post` WHERE post.uniccode='$post_id';";
$result = mysqli_query($connect,$sql);
if($r = mysqli_fetch_assoc($result)){
    $post_city_id=$r['city'];
    $post_category_id=$r['category'];
    $sender_id = $r['userId'];
    $csql = "SELECT * FROM cities WHERE id=$post_city_id;";
    $rc = mysqli_query($connect,$csql);
    if($city_array = mysqli_fetch_assoc($rc)){
        $city_state_id = $city_array['province_id'];
        $ssql = "SELECT * FROM provinces WHERE id=$city_state_id;";
        $rs = mysqli_query($connect,$ssql);
        if($state_array = mysqli_fetch_assoc($rs)){
            $sql = "SELECT * FROM `category` WHERE id=$post_category_id";
            $ru = mysqli_query($connect,$sql);
            if($category_array = mysqli_fetch_assoc($ru)){
                $sql = "SELECT * FROM `user` WHERE id=$sender_id";
                $ru = mysqli_query($connect,$sql);
                if($sender_array = mysqli_fetch_assoc($ru)){
                    $sqe1 = "";
                    $data = create_product_data($r,$city_array,$state_array,$category_array,$sender_array);
                    $array['data'] = $data;
                    $array['status'] = '200';
                    echo json_encode($array);
                }else{
                    echo json_encode($array);
                    exit;
                }
            }else{
                echo json_encode($array);
                exit;
            }
        }else{
            echo json_encode($array);
            exit;
        }
    }else{
        echo json_encode($array);
        exit;
    }
}else{
    echo json_encode($array);
    exit;
}

function create_product_data($post,$city,$state,$category,$sender){
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
        $price1 = 'ویدیعه : '.create_price($post['price_1']);
        $price2 = 'اجاره : '.create_price($post['price_2']);
    }else{
        $price1 = '';
        $price2 = 'قیمت : '.create_price($post['price_1']);
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
