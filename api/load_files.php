<?php

include '../php/script/my_db.php';
include_once 'functions/removeStopWords.php';


//get page number default : 1
$page = '1';
if(isset($_GET['page']) and preg_match('#[0-9]+$#',$_GET['page'])){
    $page = $_GET['page'];
}

//get max of id that user sent for server
$max_id = '999999999999';
if(isset($_GET['i']) and preg_match('#[0-9]+$#',$_GET['i'])){
    $max_id = $_GET['i'];
}

//get search query ?q=search-term
$q = '';
$searchQuery = '';
if( isset($_GET['q']) and $_GET['q'] != ''){
    $q = removeStopWords($_GET['q']);
    
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

//get location for filter of post list
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


// set category for filter
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



//get data from database
$offset = 24 * ((int)$page - 1);
$sqlList = "SELECT * FROM `post` WHERE id < $max_id $location_query $categoryQuery $searchQuery ORDER by id DESC LIMIT 24";

include 'showPost.php';



?>