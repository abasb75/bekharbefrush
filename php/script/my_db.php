<?php
date_default_timezone_set("Asia/Tehran");
//$_MAIN_URL = 'http://192.168.43.238/BekharBefrush/';
$_MAIN_URL = 'https://bekharbefrush.ir/';

$SQL_HOST = 'localhost';
$SQL_USER = 'root';
$SQL_PASS = '';
$SQL_DNNAME = 'bekharbefrush';


$connect = mysqli_connect($SQL_HOST,$SQL_USER,$SQL_PASS,$SQL_DNNAME);
mysqli_query($connect,"SET CHARACTER SET utf8");
if(!$connect){
    die;
}