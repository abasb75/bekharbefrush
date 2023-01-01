<?php

include_once 'functions/processPostData.php';

$result = mysqli_query($connect,$sqlList);
$posts = ['status'=>404,'post'=>array()];
while($r = mysqli_fetch_assoc($result)){
    $posts['status']= 200;
    $postData = processPostData($post);
    array_push($posts['post'],$postData);
}

echo (json_encode($posts));