<?php 
session_start();

if(!isset($_POST['ca'])){
    echo 'er1';
    die;
}
if(!isset($_POST['lc'])){
    echo 'er2';die;
}
if(!isset($_POST['st'])){
    echo 'er3';die;
}
if(!isset($_POST['tp'])){
    echo 'er4';die;
}
if(!isset($_POST['tl'])){
    echo 'er5';die;
}
if(!isset($_POST['bd'])){
    echo 'er6';die;
}
if(!isset($_POST['p1'])){
    echo 'er7';die;
}
if(!isset($_POST['p2'])){
    echo 'er8';die;
}
if(!isset($_POST['p3'])){
    echo 'er9';echo 'er1';die;
}
if(!isset($_POST['nm'])){
    echo 'er10';die;
}
if(!isset($_POST['em'])){
    echo 'er11';die;
}
if(!isset($_POST['ln'])){
   echo 'er12'; die;
}
if(!isset($_POST['ad'])){
    echo 'er13';die;
}
if(!isset($_POST['idr'])){
   echo 'er14'; die;
}
if(!isset($_SESSION['img_key'])){
    echo 'er15';die;
}
if(!isset($_POST['vd'])){
    echo 'er15';die;
}
if(!isset($_POST['tk'])){
    echo 'er15';die;
}

$category = $_POST['ca'];
$token = $_POST['tk'];
$location = $_POST['lc'];
$status = $_POST['st'];
$type = $_POST['tp'];
$title = $_POST['tl'];
$body = $_POST['bd'];
$price1 = $_POST['p1'];
$price2 = $_POST['p2'];
$price3 = $_POST['p3'];
$name = $_POST['nm'];
$email = $_POST['em'];
$link = $_POST['ln'];
$address = $_POST['ad'];
$idr = $_POST['idr'];

$video = $_POST['vd'];

if(!preg_match('#^https:\/\/www\.aparat\.com\/v\/#',$video)){
    $video = '';
}
$video = str_replace('https://www.aparat.com/v/','',$video);
$video = explode('/',$video);
if(isset($video[0])){
    $video = $video[0];
}else{
    $video = '';
}


if($video != ''){
    
    $video_data = "https://www.aparat.com/etc/api/video/videohash/$video";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $video_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36");
    $output = curl_exec($ch);
    curl_close($ch);
    if($output != null){
        
        $la = json_decode($output,true);
        if(isset($la['video']) and isset($la['video']['frame'])){
            $video = $la['video']['frame'];
        }
    }
    
}


$_USER = ['id'=>0,'phone'=>'','name'=>'','status'=>'NOT_LOGIN','mail'=>''];

include '../script/my_db.php';

include '../script/setPassword.php';
include '../script/get_user_info_login.php';
include '../script/unic-code.php';


if($_USER['id'] == 0){
   echo 'er16'; die;
}





function checkId($id , $table){
    global $connect;
    $sql = "SELECT * FROM `$table` WHERE id=$id;";
    $result = mysqli_query($connect,$sql);
    if($r = mysqli_fetch_assoc($result)){
        return true;
    }
    return false;
    
}


/* check category */
$category = str_replace('c_','',$category);
if(!preg_match('#^[1-9][0-9]*$#',$category)){
    echo 'er16';
    die;
}
if(!checkId((int)$category ,'category')){
    echo 'er17';
    die;
}




/* check location */

$location = str_replace('c_','',$location);
if(!preg_match('#^[1-9][0-9]*$#',$location)){
    echo 'er18';
    die;
}
if(!checkId((int)$location ,'cities')){
    echo 'er19';
    die;
}

/* check post status*/


if(!($status == '1' or $status == '2' or $status == '3' or $status == '4')){
    echo 'er20';
    die;
}

/* check post type*/
if(!($type == '1' or $type == '2' or $type == '3' or $type == '4'or $type == '5' or $type == '6')){
    echo 'er21';
    die;
}

/* check title and body */

if(strlen($title)<25){
    echo 'er22';
    die;
}

if(strlen($body)<40){
    echo 'er23';
    die;
}


if($price1 == '' or $price1 == '0' or $price1 == '-1'){
    $price1 = 0;
}elseif(!preg_match('#^[1-9][0-9]*$#',$price1)){
    echo 'er24';
    die;
}
if($price2 == '' or $price2 == '0' or $price2 == '-1'){
    $price2 = 0;
}elseif(!preg_match('#^[1-9][0-9]*$#',$price2)){
    echo 'er25';
    die;
}
if($price3 == '' or $price3 == '0' or $price3 == '-1'){
    $price3 = 0;
}elseif(!preg_match('#^[1-9][0-9]*$#',$price3)){
    echo 'er26';
    die;
}

if($category== '0' and $type='4'){
    $price1 = $price2;
    $price2 = $price3;
}else{
    $price2 = 0;
}


if(strlen($name) > 32){
    echo 'er27';
    die;
}elseif($name!=''){
    $Sql ="UPDATE `user` SET `name`='$name' WHERE id=".$_USER['id'].";";
    $result = mysqli_query($connect,$Sql);
}

/* check email and set to user */
if($email != ''){
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         echo 'er28'; 
         die;
    }else{
         $Sql ="UPDATE `user` SET `mail`='$email' WHERE id=".$_USER['id'].";";
         $result = mysqli_query($connect,$Sql);
        
     }
    
}

/* heck link */


if($link != ''){
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)) {
        echo 'er29';
        die;
    }
}

if($address != '' and strlen($address) > 64){
    echo 'er30';
    die;
}

if(!preg_match('#^[0-9]+$#',$idr)){
    echo 'er31';
    die;
}


$statement = mysqli_prepare($connect,"INSERT INTO `post`( `title`, `category`, `city`,  `status`, `type`, `body`,video, `price_1`, `price_2`, `link`, `address`,userId) VALUES (?,$category,$location,$status,$type,?,?,'$price1','$price2',?,?,".$_USER['id'].");");

mysqli_stmt_bind_param($statement,'sssss',$title,$body,$video,$link,$address);


if($result = mysqli_stmt_execute($statement) ){
    
}else{
    echo 'er31';
    die;
    
}
$postId = mysqli_insert_id($connect);

$unic = getUnicCode($postId.'');
$nsql = "UPDATE `post` SET `uniccode`='$unic' WHERE id=$postId";
mysqli_query($connect,$nsql);


/* check idr */

if($idr == '1000'){
    echo 'OK';
    die;
}

$sql = "SELECT * FROM `post_image` WHERE post_key='".$_SESSION['img_key']."' AND tab_id='$token';";
$result = mysqli_query($connect ,$sql);



$firstIdr = -1;
$idr_image_data = '';
$counter = 0;
while($res = mysqli_fetch_assoc($result)){
    $counter++;
    base64_to_jpeg($res['data'],"img/th-$postId-$counter.jpeg");
    $info = getimagesize("img/th-$postId-$counter.jpeg");
    
    $w = $info[0];
    $h = $info[1];
    $nw = $w;
    $nh = $h;
    if($w > $h and $w > 900){
        $nw = 900;
        $nh = ($nw*$h)/$w;
        
    }elseif( $h > 700){
        $nh = 700;
        $nw = ($w*$nh)/$h;
    }
    $data_image = $res['data'];
    if($info[2] == IMAGETYPE_WEBP or  $info[2] == IMAGETYPE_JPEG or $info[2] == IMAGETYPE_GIF or $info[2] == IMAGETYPE_PNG){
        $image = new SimpleImage();
        $image->load("img/th-$postId-$counter.jpeg");
        $image->resize($nw, $nh);
        $image->save("../../assets/image/post/th-$postId-$counter.jpeg");

        $data_image = "assets/image/post/th-$postId-$counter.jpeg";
        
        mysqli_query($connect,$sql);
    }
    
    unlink("img/th-$postId-$counter.jpeg");

    $sq = "INSERT INTO `posts_image`( `postId`, `data`, `is_main`) VALUES ($postId,'".$data_image."',0);";
    $r = mysqli_query($connect,$sq);
        
    if($r){
        if($firstIdr == -1 or $res['idr'] == $idr){
            $imgId = mysqli_insert_id($connect);
            $firstIdr = $imgId;
            $sq1 = "UPDATE `post` SET `idr`=$imgId WHERE id=$postId;";
            mysqli_query($connect,$sq1);
            $idr_image_data = $res['data'];
        }
    }
    
}

if($idr_image_data != '' and $idr_image_data != null){
    base64_to_jpeg($idr_image_data,"img/th-$postId.jpeg");
    $info = getimagesize("img/th-$postId.jpeg");
    $w = $info[0];
    $h = $info[1];
    $nw = 0;
    $nh = 0;
    if($w>$h){
        $nh = 200;
        $nw = ($w*$nh)/$h;
    }else{
        $nw = 200;
        $nh = ($nw*$h)/$w;
    }
    if($info[2] == IMAGETYPE_WEBP or  $info[2] == IMAGETYPE_JPEG or $info[2] == IMAGETYPE_GIF or $info[2] == IMAGETYPE_PNG){
        $image = new SimpleImage();
        $image->load("img/th-$postId.jpeg");
        $image->resize($nw, $nh);
        $image->save("../../assets/image/posts/th-$postId.jpeg");

        $sumnail = "assets/image/posts/th-$postId.jpeg";
        $sql ="UPDATE `post` SET `sumbnial`='$sumnail' WHERE id=$postId";
        mysqli_query($connect,$sql);
    }
    
    unlink("img/th-$postId.jpeg");
    

}



function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 
}






echo 'OK';

 
/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/blog/resizing-images-with-php/
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
        $this->image = imagecreatefrompng($filename);
     }elseif( $this->image_type == IMAGETYPE_WEBP ) {
 
        $this->image = imagecreatefromwebp($filename);
     }else{
        $this->image = imagecreatefrombmp($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
        imagepng($this->image,$filename);
     }elseif( $image_type == IMAGETYPE_WEBP ) {
 
        imagewebp($this->image,$filename);
     }else{
          imagebmp($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
        imagepng($this->image);
     }elseif( $image_type == IMAGETYPE_WEBP ) {
 
        imagepng($this->image);
     }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
 
}
?>