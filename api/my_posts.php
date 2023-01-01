<?php

include '../php/script/my_db.php';
include '../php/script/setPassword.php';
include '../php/script/jdf.php';

// get user is login? and get his data
include '../php/script/user_default_array.php';
include '../php/script/get_user_info_login.php';
$userId = $_USER['id'];


// get user post list from database
$sqlList = "SELECT * FROM `post` WHERE userId=$userId ORDER by id DESC";


include 'showPost.php';



?>