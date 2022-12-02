<?php



include 'unic-code.php';
include 'my_db.php';



function digikalaProduct($PID) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.digikala.com/v1/product/$PID/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36");
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
    
$json = digikalaProduct($productId);

$pr = json_decode($json,true);
if($pr['status']!='200'){
    echo 'not found';
    die;
}
$title = $pr['data']['product']['title_fa'];
$link = 'https://www.digikala.com/product/dkp-'.$pr['data']['product']['id'];
$body = '';
if(isset($pr['data']['product']['review']['description'])){$body = $pr['data']['product']['review']['description']; }
$images = $pr['data']['product']['images'];
$main_image = $images['main']['url'][0];
$images = $images['list'];


$status = '1';
$type = '1';
$location = '300';
$category = '1';
$user = '1';
$address = 'فروشگاه اینترنتی دیجیکالا';
$price = '0';

if($pr['data']['product']['status']=='out_of_stock'){
    $status = '5';
}else{
    $price = $pr['data']['product']['default_variant']['price']['selling_price'].'x';
    $price = str_replace('0x','',$price);
}

$statement = mysqli_prepare($connect,"INSERT INTO `post`( `title`, `category`, `city`,  `status`, `type`, `body`, `price_1`, `price_2`, `link`, `address`,userId) VALUES (?,$category,$location,$status,$type,?,'$price','0',?,?,1);");

mysqli_stmt_bind_param($statement,'ssss',$title,$body,$link,$address);


if($result = mysqli_stmt_execute($statement) ){
    
}else{
    echo 'er31';
    die;
    
}
$postId = mysqli_insert_id($connect);

$unic = getUnicCode($postId.'');
$nsql = "UPDATE `post` SET `uniccode`='$unic' WHERE id=$postId";
mysqli_query($connect,$nsql);


$sq = "INSERT INTO `posts_image`( `postId`, `data`, `is_main`) VALUES ($postId,'$main_image',0);";
$r = mysqli_query($connect,$sq);
$imgId = mysqli_insert_id($connect);
            
$sq1 = "UPDATE `post` SET `idr`=$imgId WHERE id=$postId;";
mysqli_query($connect,$sq1);


$firstIdr = -1;
for($i=0;$i<sizeof($images);$i++){
    if($i>8){break;}
    $sq = "INSERT INTO `posts_image`( `postId`, `data`, `is_main`) VALUES ($postId,'".$images[$i]['url'][0]."',0);";
    $r = mysqli_query($connect,$sq);
}



?>