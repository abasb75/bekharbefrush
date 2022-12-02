<?php

$user_name = 'abaslog';
$password = sha1(MD5('abasbagheri1375'));
$token = "cbe6003634ae38672ea6b8428cdcd6b5";

$login = "https://www.aparat.com/etc/api/login/luser/$user_name/lpass/$password";

$upload_form = "https://www.aparat.com/etc/api/upload​form/luser/$user_name/ltoken/$token";

$form_id = "733250";
$frm_id ="32600";

$action = "https://www.aparat.com/etc/api/uploadpost/luser/abaslog/username/abaslog/ltoken/cbe6003634ae38672ea6b8428cdcd6b5/uploadid/1092740/atrty/1655268933/avrvy/733250/key/b666e02d4bcfccdcb35960f58787d266586272e4/";



$v = [
    'frm-id'=>$frm_id,
    'data[title]'=>'فیلم آموزش html',
    'data[category]'=>'12',
    'data[tags]'=>'html',
    'video'=>file_get_contents('C:\xampp\htdocs\BekharBefrush\php\ajax\v1.mp4')

];


$video_data = "https://www.aparat.com/etc/api/video/videohash/WRBzo";


function login_aparat($link,$arry = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $link);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36");

    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}


$json = login_aparat($video_data);
$la = json_decode($json,true);
echo '<pre>';
var_dump($la['video']['frame']);
echo '<pre>';
$token = "cbe6003634ae38672ea6b8428cdcd6b5";
echo $token;

