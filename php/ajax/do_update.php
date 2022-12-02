<?php
session_start();

if(!isset( $_SESSION['edit_post']) or !isset($_SESSION['edit_post_key'])) {

   die;
    
}
if($_SESSION['edit_post']!='ENABLE'){
  die;
    
}



if(!isset($_POST['tl'])){
    echo 'er1'; die;
}


if(!isset($_POST['bd'])){
    echo 'er2'; die;
}

if(!isset($_POST['id'])){
    echo '200'; die;
}

if(!isset($_POST['vd'])){
    echo 'er3'; die;
}

if(!isset($_POST['p1'])){
    echo 'er4'; die;
}

if(!isset($_POST['p2'])){
    echo 'er4'; die;
}

if(!isset($_POST['tk'])){
    echo 'er5'; die;
}

if(!preg_match('#^[0-9]{3,11}$#',$_POST['id'])){
    echo 'er50'.$_POST['id']; die;
}

$title = $_POST['tl'];
$body = $_POST['bd'];
$price1 = $_POST['p1'];
$price2 = $_POST['p2'];
$video = $_POST['vd'];
$token = $_POST['tk'];

if(!preg_match('#^[0-9]{0,12}#',$price1)){
    echo 'er51'; die;
}

if(!preg_match('#^[0-9]{0,12}#',$price2)){
    echo 'er51'; die;
}




if($video != '' ){
    
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

include_once '../script/user_default_array.php';
include_once '../script/my_db.php';

include_once '../script/setPassword.php';
include_once '../script/get_user_info_login.php';

if($_USER['status'] != 'LOGIN'){
    echo 'er6'; die;
}


$usertId = $_USER['id'];
$postId = $_POST['id'];

$sql = "SELECT * FROM `post` WHERE userId=$usertId AND id=$postId";
$res = mysqli_query($connect,$sql);
if(!($r = mysqli_fetch_assoc($res))){
    echo 'er7'; die;
}


if($r['category']=='1' and $r['type']=='4'){
    $p = $price1;
    $price1 = $price2;
    $price2 = $p;
}

$statement = mysqli_prepare($connect,"UPDATE `post` SET `title`=?,`body`=?,`price_1`=?,`price_2`=?,`video`=? WHERE id=$postId ;");

mysqli_stmt_bind_param($statement,'sssss',$title,$body,$price2,$price1,$video);


if($result = mysqli_stmt_execute($statement) ){
    
}else{
    echo 'er31';
    die;
    
}

$sql = "SELECT * FROM `update_image` WHERE `edit_key`='$token'";
$res = mysqli_query($connect,$sql);
while($r = mysqli_fetch_assoc($res)){
    if($r['type']=='2' or $r['type']==2){
        $src = 'assets/image/post/'.$r['imageData'];
        $sql = "DELETE FROM `posts_image` WHERE `data`='$src';";
        mysqli_query($connect,$sql);
        $src = '../../assets/image/post/'.$r['imageData'];
        unset($src);
    }elseif($r['type']=='1' or $r['type']==1){
        $rid = $r['id'];
        base64_to_jpeg($r['imageData'],"img/th-$postId-$rid.jpeg");
        $info = getimagesize("img/th-$postId-$rid.jpeg");
        
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
        $data_image = $r['imageData'];
        if($info[2] == IMAGETYPE_WEBP or  $info[2] == IMAGETYPE_JPEG or $info[2] == IMAGETYPE_GIF or $info[2] == IMAGETYPE_PNG){
            $image = new SimpleImage();
            $image->load("img/th-$postId-$rid.jpeg");
            $image->resize($nw, $nh);
            $image->save("../../assets/image/post/th-$postId-$rid.jpeg");

            $data_image = "assets/image/post/th-$postId-$rid.jpeg";
            
          //  mysqli_query($connect,$sql);
        }
    
        unlink("img/th-$postId-$rid.jpeg");

        $sq = "INSERT INTO `posts_image`( `postId`, `data`, `is_main`) VALUES ($postId,'".$data_image."',0);";
        $r = mysqli_query($connect,$sq);
    }
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