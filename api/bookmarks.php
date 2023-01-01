<?php

include '../php/script/my_db.php';

//get user information
include_once '../php/script/user_default_array.php';
include_once '../php/script/get_user_info_login.php';

// get user id from 
$userId = $_USER['id'];
if($userId == '0'){
    die;
}

include_once 'functions/processPostData.php';

//get user bookmark list from database

$sqlList = "SELECT * FROM post WHERE post.userId != $userId AND post.id 
IN (SELECT post_id FROM favs WHERE user_id=$userId ORDER BY id DESC);";

include 'showPost.php';

?>