<?php
include '../script/my_db.php';
$_MAIN_URL = 'http://localhost/BekharBefrush/';


$page = '1';
if(isset($_GET['page']) and preg_match('#[0-9]+$#',$_GET['page'])){
    $page = $_GET['page'];
}
$offset = 24 * ((int)$page - 1);

$sqlList = "SELECT * FROM `post` ORDER by id DESC LIMIT $offset,24;";
include '../views/product_list.php';
