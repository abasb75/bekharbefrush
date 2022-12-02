<?php
session_start();




$useragent=$_SERVER['HTTP_USER_AGENT'];
$is_mobile = false;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
    $is_mobile = true;
}
$q = '';
if(isset($_GET['q'])){
    $q = $_GET['q'];
}
include 'php/script/setPassword.php';
include 'php/script/jdf.php';
if(!isset($_SESSION['current'])){
    $_SESSION['current'] = '';
}
$first = explode('?',$_SERVER['REQUEST_URI']);
$_SCRIPT = $first[0];
$_SCRIPT = str_replace('/BekharBefrush/','',$_SCRIPT);
$_SCRIPT = str_replace('/BekharBefrush','',$_SCRIPT);
$_SCRIPT = str_replace('/bekharbefrush/','',$_SCRIPT);
$_SCRIPT = str_replace('/bekharbefrush','',$_SCRIPT);
$_SCRIPT = str_replace('/BEKHARBEFRUSH/','',$_SCRIPT);
$_SCRIPT = str_replace('/BEKHARBEFRUSH','',$_SCRIPT);
include 'php/script/user_default_array.php';
include 'php/script/my_db.php';
include 'php/script/get_user_info_login.php';
$productId='';
$_SCRIPT = ltrim($_SCRIPT , '/' );
include 'php/script/user_location.php';
$page_default = '0';
if( strtolower($_SCRIPT) == 'new' || strtolower($_SCRIPT) == 'new/'){
    //$_SESSION['current'] = 'new';
    include 'php/add.php';
}elseif(strtolower($_SCRIPT) == 'mobiler' || strtolower($_SCRIPT) == 'mobiler/'){
    include 'getmobile.php';
}elseif( strtolower($_SCRIPT) == 'chat' || strtolower($_SCRIPT) == 'chat/'){
    //$_SESSION['current'] = 'new';
    $postUnicCode = '-1';
    $user = '0';
    $defaultTitle = '';
    $defaultUserName = '';
    $defaultImage = '';
    include 'php/chat.php';
}elseif( strtolower($_SCRIPT) == 'support' || strtolower($_SCRIPT) == 'support/' ||  strtolower($_SCRIPT) == 'contact/' || strtolower($_SCRIPT) == 'contact'){
    $postUnicCode = '0';
    $user = '0';
    $defaultTitle = 'پشتیبانی';
    $defaultUserName = 'پشتیبانی';
    $defaultImage = '<img src="'.$_MAIN_URL.'assets/image/profile/admin.png" >';
    include 'php/chat.php';
}elseif( preg_match('#^chat\/[a-zA-Z0-9]{8,64}\/?$#',$_SCRIPT)){
    $e= str_replace('/BekharBefrush/','',$_SCRIPT);
    $e=explode('/',$e);
    $unic_code = $e[1];
    $sql = "SELECT * FROM `post` WHERE post.uniccode='$unic_code';";
    $result = mysqli_query($connect,$sql);
    if($r = mysqli_fetch_assoc($result)){
        if($_USER['id'] == $r['userId']){
            include 'php/404.php';die;
        }
        $defaultTitle = $r['title'];
        
        $defaultUserName  = '';
        $id = $r['userId'];
        $sqli = "SELECT name from user WHERE id = $id;";
        $resi = mysqli_query($connect,$sqli);
        if($ri = mysqli_fetch_assoc($resi)){
            $defaultUserName = $ri['name'];
        }
        if($defaultUserName == ''){
            $defaultUserName = 'کاربر';
        }
        $defaultImage = '<i class="icon-camera-off"></i>';
        if($r['sumbnial'] != ''){
            $sum = $r['sumbnial'];
            $defaultImage = '<img src="'.$_MAIN_URL.$sum.'">';
        }
        $postUnicCode = $unic_code;
        $user = $r['userId'];
        include 'php/chat.php';
    }else{
        include 'php/404.php';die;
    }
}elseif( strtolower($_SCRIPT == 'logout') ){
    include 'php/script/logout.php';
    header("Location: $_MAIN_URL".$_SESSION['current']);
    die();
}elseif( $_SCRIPT == '' ){
    $href_location = null;
    include 'php/multi.php';
}elseif( preg_match('#^c\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+(\/?|\/r\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/?)$#',urldecode($_SCRIPT))){
    $href_location = null;
    $u = str_replace('/BekharBefrush/','',urldecode($_SCRIPT));
    $u = explode('/',$u);
    $city_slug = $u[1];
    $sqlq = "SELECT * FROM `cities` WHERE slug = '$city_slug';";
    $result = mysqli_query( $connect , $sqlq );
    if($r2 = mysqli_fetch_assoc($result)){
        $_USER['location']='c_' . $r2['id'];
        $_USER['location_name']='شهر '.$r2['name'];
        $_USER['location_slug'] = 'c/'. $r2['slug'].'/';
        
        if(!isset($u[3]) or $u[3] == ''){
            $_USER['category'] = 'c_0';
            
        }else{
            $category_slug = $u[3];
            
            $sq = "SELECT * FROM `category` WHERE `title`='$category_slug';";
            $result = mysqli_query( $connect , $sq );
            if($r2 = mysqli_fetch_assoc($result)){
                $_USER['category'] = 'c_'.$r2['id'];
                $_USER['category_name'] = $r2['name'];
                $_USER['category_slug'] = 'r/'.$r2['title'].'/';
            }else{
                
                include 'php/404.php';die;
            }
        }
        include 'php/multi.php';
    }else{
        include 'php/404.php';die;
    }
}elseif( preg_match('#^s\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+(\/?|\/r\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/?)$#',urldecode($_SCRIPT))){
    $href_location = null;
    $u = str_replace('/BekharBefrush/','',urldecode($_SCRIPT));
    $u = explode('/',$u);
    $city_slug = $u[1];
    $city_slug = str_replace('استان-','',$city_slug);
    $sqlq = "SELECT * FROM `provinces` WHERE slug = '$city_slug';";
    $result = mysqli_query( $connect , $sqlq );
    if($r2 = mysqli_fetch_assoc($result)){
        
        $_USER['location']='s_' . $r2['id'];
        $_USER['location_name']='استان '.$r2['name'];
        $_USER['location_slug'] = 's/'. $r2['slug'].'/';
        
        if(!isset($u[3]) or $u[3] == ''){
            $_USER['category'] = 'c_0';
            
        }else{
            $category_slug = $u[3];
            
            $sq = "SELECT * FROM `category` WHERE `title`='$category_slug';";
            $result = mysqli_query( $connect , $sq );
            if($r2 = mysqli_fetch_assoc($result)){
                $_USER['category'] = 'c_'.$r2['id'];
                $_USER['category_name'] = $r2['name'];
                $_USER['category_slug'] = 'r/'.$r2['title'].'/';
            }else{
                
                include 'php/404.php';die;
            }
        }
        
        
        include 'php/multi.php';
    }elseif($city_slug == 'ایران'){
        $_USER['location']='i_0' ;
        $_USER['location_name']='ایران';
        $_USER['location_slug'] = 's/ایران/';
        
        
        if(!isset($u[3]) or $u[3] == ''){
            $_USER['category'] = 'c_0';
            
        }else{
            $category_slug = $u[3];
            
            $sq = "SELECT * FROM `category` WHERE `title`='$category_slug';";
            $result = mysqli_query( $connect , $sq );
            if($r2 = mysqli_fetch_assoc($result)){
                $_USER['category'] = 'c_'.$r2['id'];
                $_USER['category_name'] = $r2['name'];
                $_USER['category_slug'] = 'r/'.$r2['title'].'/';
            }else{
                
                include 'php/404.php';die;
            }
        }
        
        
        include 'php/multi.php';
    }else{
        include 'php/404.php';die;
    }
}elseif( preg_match('#^p\/[a-z|A-Z|0-9]{8,24}(\/?|\/[^\/]+)\/?$#',urldecode($_SCRIPT))){
    $e= str_replace('/BekharBefrush/','',$_SCRIPT);
    $e=explode('/',$e);
    $page_default = $e[1];
    include 'php/multi.php';
}elseif( preg_match('#^new\/dg\/[0-9]{7}\/?$#',$_SCRIPT)){
    $e = str_replace('/BekharBefrush/','',$_SCRIPT);
    $e = explode('/',$e);
    $productId = $e[2];
    
    
    include 'php/script/add-dkp.php';
    echo 'done';
}elseif( strtolower( $_SCRIPT) == 'user' or strtolower( $_SCRIPT) == 'user/'  or strtolower( $_SCRIPT) == 'user/mypost'  or strtolower( $_SCRIPT) == 'user/mypost/'){
    $input = 'MY_POST';
    $unic_code = '0';
    include 'php/user.php';
}elseif( strtolower( $_SCRIPT) == 'user/bookmark' or strtolower( $_SCRIPT) == 'user/bookmark/' ){
    $input = 'MY_BOOKMARK';
    $unic_code = '0';
    include 'php/user.php';
}elseif( strtolower( $_SCRIPT) == 'user/history' or strtolower( $_SCRIPT) == 'user/history/' ){
    $input = 'MY_HISTORY';
    $unic_code = '0';
    include 'php/user.php';
}elseif( preg_match('#^user\/mypost\/[a-z|A-Z|0-9]{8,24}\/?$#',$_SCRIPT)){
    $e= str_replace('user/mypost/','',$_SCRIPT);
    $e=explode('/',$e);
    $unic_code = $e[0];
    $userId = $_USER['id'];
    $sql = "SELECT * FROM `post` WHERE post.uniccode='$unic_code' AND userId=$userId;";
    $result = mysqli_query($connect,$sql);
    if($r = mysqli_fetch_assoc($result)){
        $input = 'SINGLE_POST';
        include 'php/user.php';
    }else{
        include 'php/404.php';die;
    }
    
   
}elseif( strtolower($_SCRIPT) == 'laws' || strtolower($_SCRIPT) == 'laws/'){
    include 'php/laws.php';
}elseif( strtolower($_SCRIPT) == 'sitemap.xml'){
    include 'sitemap/sitemap.php';
}elseif( strtolower($_SCRIPT) == 'sitemap.html'){
    include 'sitemap/html/sitemap.php';
}elseif( strtolower($_SCRIPT) == 'sitemap/category.xml'){
    include 'sitemap/category.php';
}elseif( strtolower($_SCRIPT) == 'sitemap/location.xml'){
    include 'sitemap/location.php';
}elseif( strtolower($_SCRIPT) == 'sitemap/post.xml'){
    include 'sitemap/post.php';
}elseif( preg_match('#^s\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/sitemap\.html$#',urldecode($_SCRIPT))){
    $href_location = null;
    $u = str_replace('/BekharBefrush/','',urldecode($_SCRIPT));
    $u = explode('/',$u);
    $city_slug = $u[1];
    $sqlq = "SELECT * FROM `provinces` WHERE slug = '$city_slug';";
    $result = mysqli_query( $connect , $sqlq );
    if($r2 = mysqli_fetch_assoc($result)){
        if(!isset($u[3]) or $u[3] == ''){
            
        }else{
            $category_slug = $u[3];
            
            $sq = "SELECT * FROM `category` WHERE `title`='$category_slug';";
            $result = mysqli_query( $connect , $sq );
            if($r2 = mysqli_fetch_assoc($result)){
                
            }else{
                
                include 'php/404.php';die;
            }
        }
        
        
        include 'sitemap/html/sitemap-city.php';
    }
}elseif( preg_match('#^s\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/r\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/sitemap\.html$#',urldecode($_SCRIPT))){
    $href_location = null;
    $u = str_replace('/BekharBefrush/','',urldecode($_SCRIPT));
    $u = explode('/',$u);
    $city_slug = $u[1];
    $stat = 'state';
    $sqlq = "SELECT * FROM `provinces` WHERE slug = '$city_slug';";
    $result = mysqli_query( $connect , $sqlq );
    if($r2 = mysqli_fetch_assoc($result)){
        if(!isset($u[3]) or $u[3] == ''){
            include 'php/404.php';die;
        }elseif($u[3] == 'همه'){
            $category_slug='';
            include 'sitemap/html/sitemap-list.php';
        }else{
            $category_slug = $u[3];
            $sq = "SELECT * FROM `category` WHERE `title`='$category_slug';";
            $result = mysqli_query( $connect , $sq );
            if($r3 = mysqli_fetch_assoc($result)){
                include 'sitemap/html/sitemap-list.php';
            }else{
                include 'php/404.php';die;
            }
        }
    }else if($city_slug == 'ایران'){
        if(!isset($u[3]) or $u[3] == ''){
            include 'php/404.php';die;
        }elseif($u[3] == 'همه'){
            $category_slug='';
            include 'sitemap/html/sitemap-list.php';
        }else{
            $category_slug = $u[3];
            $sq = "SELECT * FROM `category` WHERE `title`='$category_slug';";
            $result = mysqli_query( $connect , $sq );
            if($r3 = mysqli_fetch_assoc($result)){
                include 'sitemap/html/sitemap-list.php';
            }else{
                include 'php/404.php';die;
            }
        }
    }else{
        include 'php/404.php';die;
    }
}elseif( preg_match('#^c\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/sitemap\.html$#',urldecode($_SCRIPT))){
    $href_location = null;
    $u = str_replace('/BekharBefrush/','',urldecode($_SCRIPT));
    $u = explode('/',$u);
    $city_slug = $u[1];
    $sqlq = "SELECT * FROM `cities` WHERE slug = '$city_slug';";
    $result = mysqli_query( $connect , $sqlq );
    if($r2 = mysqli_fetch_assoc($result)){
        if(!isset($u[3]) or $u[3] == ''){
            $_USER['category'] = 'c_0';
            
        }else{
            $category_slug = $u[3];
            
            $sq = "SELECT * FROM `category` WHERE `title`='$category_slug';";
            $result = mysqli_query( $connect , $sq );
            if($r2 = mysqli_fetch_assoc($result)){
                
            }else{
                
                include 'php/404.php';die;
            }
        }
        
        
        include 'sitemap/html/sitemap-category.php';
    }
}elseif( preg_match('#^c\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/r\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/sitemap\.html$#',urldecode($_SCRIPT))){
    $href_location = null;
    $u = str_replace('/BekharBefrush/','',urldecode($_SCRIPT));
    $u = explode('/',$u);
    $city_slug = $u[1];
    $stat = 'city';
    $sqlq = "SELECT * FROM `cities` WHERE slug = '$city_slug';";
    $result = mysqli_query( $connect , $sqlq );
    if($r2 = mysqli_fetch_assoc($result)){
        if(!isset($u[3]) or $u[3] == ''){
            include 'php/404.php';die;
        }elseif($u[3] == 'همه'){
            $category_slug='';
            include 'sitemap/html/sitemap-list.php';
        }else{
            $category_slug = $u[3];
            $sq = "SELECT * FROM `category` WHERE `title`='$category_slug';";
            $result = mysqli_query( $connect , $sq );
            if($r3 = mysqli_fetch_assoc($result)){
                include 'sitemap/html/sitemap-list.php';
            }else{
                include 'php/404.php';die;
            }
        }
    }else{
        include 'php/404.php';die;
    }
}elseif( 3 == 4){
    //preg_match('#^\/BekharBefrush\/p\/[a-z|A-Z|0-9]{4,8}(\/?|\/[^\/]+)\/?$#',$_SCRIPT)
    $e= str_replace('/BekharBefrush/','',$_SCRIPT);
    $e=explode('/',$e);
    $unic_code = $e[1];
    $sql = "SELECT * FROM `post` WHERE post.uniccode='$unic_code';";
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
                        include 'php/desktop-single.php';
                    }else{
                        include 'php/404.php';die;
                    }
                }else{
                    include 'php/404.php';die;
                }
            }else{
                include 'php/404.php';die;
            }
        }else{
            include 'php/404.php';die;
        }
        
        //
    }else{
        include 'php/404.php';die;
    }
}else{
    include 'php/404.php';die;
    //include 'api/load_files.php';
    
    
   //include 'php/ajax/upload_video.php';


    //$s = preg_replace('#[^a-zA-Zآابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ\s]{1}#','',$s);
    
    
  //  include 'api/load_product.php';
    
    $d = 'Wqu43PIdWqu4FprSrS9DiAppToperS9D3PIdrS9DiApp';
    include_once 'php/script/setPassword.php';
    echo openPassword($d);
    
    
    die;
 
    include 'php/script/unic-code.php';
    function digikalaProduct($PID) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.digikala.com/v1/product/$PID/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36");
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    for($productId=6000000;$productId<6999999;$productId++){
       
       
        echo $productId;
        $json = digikalaProduct($productId);

        $pr = json_decode($json,true);
        
        if($pr['status']=='200'){
            
            if(isset($pr['data']['product']['title_fa'])){
                $title = $pr['data']['product']['title_fa'];
                $link = 'https://www.digikala.com/product/dkp-'.$pr['data']['product']['id'];
            $body = '';
            if(isset($pr['data']['product']['review']['description'])){$body = $pr['data']['product']['review']['description']; }
            $images = $pr['data']['product']['images'];
            $main_image = $images['main']['url'][0];
            $images = $images['list'];
            

            $status = '1';
            $type = '1';
            $location = rand(1,1119).'';
            $category = rand(1,12).'';
            $user = '1';
            $address = 'فروشگاه اینترنتی دیجیکالا';
            $price = '0';

            if($pr['data']['product']['status']!='out_of_stock'){
                
                $price = $pr['data']['product']['default_variant']['price']['selling_price'].'x';
                $price = str_replace('0x','',$price);
                
                
                $statement = mysqli_prepare($connect,"INSERT INTO `post`( `title`, `category`, `city`,  `status`, `type`, `body`, `price_1`, `price_2`, `link`, `address`,userId,sumbnial) VALUES (?,$category,$location,$status,$type,?,'$price','0',?,?,1,'$main_image');");

                mysqli_stmt_bind_param($statement,'ssss',$title,$body,$link,$address);



                if($result = mysqli_stmt_execute($statement) ){

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

                echo $main_image;
            ;


                $firstIdr = -1;
                for($i=0;$i<sizeof($images);$i++){
                    if($i>8){break;}
                    $sq = "INSERT INTO `posts_image`( `postId`, `data`, `is_main`) VALUES ($postId,'".$images[$i]['url'][0]."',0);";
                    $r = mysqli_query($connect,$sq);
                }
                
            }
            
            
                
                
                
                
                
                
            }

            
        }
        }
        


    
    
    

    




    
}
