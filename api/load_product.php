<?php
session_start();

include '../php/script/my_db.php';

include_once '../php/script/setPassword.php';
include_once '../php/script/jdf.php';

//get user is login? if true get his data
include_once '../php/script/user_default_array.php';
include_once '../php/script/get_user_info_login.php';
$userId = $_USER['id'];


$array = ['status'=>404,'data'=>''];
if(!isset($_GET['id'])){
    echo json_encode($array);
    exit;
}

// check is for edit?
if(isset($_GET['c']) and $_GET['c']=='igi' ){
    $_SESSION['edit_post']='ENABLE';
    $_SESSION['edit_post_key'] = $userId . '_' . time();
}


// post id must be number
$post_id = $_GET['id'];
if(!preg_match('#^[0-9|a-z|A-Z]{4,16}$#',$post_id)){
    echo json_encode($array);
    exit;
}



// get post data from database
include_once 'functions/createProductData.php';

$sql = "SELECT * FROM `post` WHERE post.uniccode='$post_id';";
$result = mysqli_query($connect,$sql);
if($r = mysqli_fetch_assoc($result)){
    $post_city_id=$r['city'];
    $post_category_id=$r['category'];
    $sender_id = $r['userId'];
    $csql = "SELECT * FROM cities WHERE id=$post_city_id;";
    $rc = mysqli_query($connect,$csql);
    if($city_array = mysqli_fetch_assoc($rc)){
        $city_state_id = $city_array['province_id'];
        $ssql = "SELECT * FROM provinces WHERE id=$city_state_id;";
        $rs = mysqli_query($connect,$ssql);
        if($state_array = mysqli_fetch_assoc($rs)){
            $sql = "SELECT * FROM `category` WHERE id=$post_category_id";
            $ru = mysqli_query($connect,$sql);
            if($category_array = mysqli_fetch_assoc($ru)){
                $sql = "SELECT * FROM `user` WHERE id=$sender_id";
                $ru = mysqli_query($connect,$sql);
                if($sender_array = mysqli_fetch_assoc($ru)){
                    $sqe1 = "";
                    $data = create_product_data($r,$city_array,$state_array,$category_array,$sender_array);
                    $array['data'] = $data;
                    $array['status'] = '200';
                    echo json_encode($array);
                }else{
                    echo json_encode($array);
                    exit;
                }
            }else{
                echo json_encode($array);
                exit;
            }
        }else{
            echo json_encode($array);
            exit;
        }
    }else{
        echo json_encode($array);
        exit;
    }
}else{
    echo json_encode($array);
    exit;
}



