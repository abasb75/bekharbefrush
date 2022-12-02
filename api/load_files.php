<?php

include '../php/script/my_db.php';


$page = '1';
if(isset($_GET['page']) and preg_match('#[0-9]+$#',$_GET['page'])){
    $page = $_GET['page'];
}

$max_id = '999999999999';
if(isset($_GET['i']) and preg_match('#[0-9]+$#',$_GET['i'])){
    $max_id = $_GET['i'];
}

$q = '';
$searchQuery = '';
if( isset($_GET['q']) and $_GET['q'] != ''){
    $q = remove_stop_words($_GET['q']);
    
    
    $searchQuery = 'AND (';
    for($i=0; $i < sizeof($q); $i++){
        $qe = $q[$i];
        if(mb_strlen($qe,'UTF-8')>1){
            $searchQuery = $searchQuery . " title LIKE '%$qe%' OR";
        }
        
    }
    $searchQuery = $searchQuery .')';
    $searchQuery = str_replace('OR)',')',$searchQuery);
    if($searchQuery == 'AND ()'){
        $searchQuery = '';
    }
    
}


$location = 'i_0';
$location_query = '';
if( isset($_GET['l']) ){
    $location = str_replace('_','',$_GET['l']);
    if(preg_match('#^s[0-9]+$#',$location)){
        $s = str_replace('s','',$location);
        $sql = "SELECT * FROM `provinces` WHERE id=$s";
        $res1 = mysqli_query($connect,$sql);
        if($r1 = mysqli_fetch_assoc($res1)){
            $sid = $r1['id'];
            $sql ="SELECT id FROM `cities` WHERE `province_id`=$sid;";
            $res2 = mysqli_query($connect,$sql);
            $location_query ="AND `city` IN (";
            $d = false;
            while($r2 = mysqli_fetch_assoc($res2)){
                if($d == true){
                    $location_query = $location_query . ' ,';
                }
                $location_query = $location_query . $r2['id'];
                $d = true;
            }
            $location_query = $location_query.') ';
            if($d==false){
                $location_query = '';
            }else{
                $_USER['location']=$_GET['l'];
                $_USER['location_name']='استان '.$r1['name'];
                setcookie('location',$_GET['l'], ['expires'=>time()+(8640000 * 30) ,'path'=>'/']);
                setcookie('location_name', 'استان '.$r1['name'] , ['expires'=>time()+(8640000 * 30) ,'path'=>'/']);
            }
        }
    }elseif(preg_match('#^c[0-9]+$#',$location)){
        $s = str_replace('c','',$location);
        $sql = "SELECT * FROM `cities` WHERE id=$s";
        $res1 = mysqli_query($connect,$sql);
        if($r1 = mysqli_fetch_assoc($res1)){
            $location_query ="AND `city` = ".$r1['id'];
            $_USER['location']=$_GET['l'];
            $_USER['location_name']='شهر '.$r1['name'];
            setcookie('location',$_GET['l'], ['expires'=>time()+(8640000 * 30) ,'path'=>'/']);
            setcookie('location_name', 'شهر '.$r1['name'] , ['expires'=>time()+(8640000 * 30) ,'path'=>'/']);
        }
        
    }else{
        setcookie('location','i_0', ['expires'=>time()+(8640000 * 30) ,'path'=>'/']);
        setcookie('location_name', 'ایران' , ['expires'=>time()+(8640000 * 30) ,'path'=>'/']);
    }
}


$category = '';
$categoryQuery = '';
if( isset($_GET['c']) and $_GET['c'] != 'c_0'){
    $category = str_replace('c_','',$_GET['c']);
    if(preg_match('#^[1-9]{1}[0-9]{0,3}$#',$category)){
        $sql4 = "SELECT * FROM `category` WHERE id=$category";
        $ru = mysqli_query($connect,$sql4);
        if($category_array = mysqli_fetch_assoc($ru)){
            $categoryQuery = "AND category = $category ";
        }
    }
}




$offset = 24 * ((int)$page - 1);
$sqlList = "SELECT * FROM `post` WHERE id < $max_id $location_query $categoryQuery $searchQuery ORDER by id DESC LIMIT 24";
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