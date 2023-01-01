<?php

//get user history list of post id by term like : 1_8_9_15
if(!isset($_GET['items'])){
    die;
}

$items = $_GET['items'];
$items = explode('_',$items);

//create query from array of history ids
$items_query = '( ';
foreach($items as $item){
    if(preg_match('#^[a-zA-Z0-9]{4,64}$#',$item)){
        $items_query = $items_query . "'".$item ."',";
    }
}
$items_query = $items_query . ")";
$items_query = str_replace(",)" , ")" , $items_query);

// if array of history ids is empty
if($items_query == "( )"){
    die;
}


include '../php/script/my_db.php';

//check user is login?
include_once '../php/script/user_default_array.php';
include_once '../php/script/get_user_info_login.php';


include_once 'functions/processPostData.php';

//get history list from database
$sqlList = "SELECT * FROM `post` WHERE uniccode IN $items_query;";

include 'showPost.php';

?>