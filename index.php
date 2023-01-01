<?php
session_start();




$useragent=$_SERVER['HTTP_USER_AGENT'];


//check user device type
include_once 'php/functions/checkIsMobile.php';
$is_mobile = false;
if( checkIsMobile() ){
    $is_mobile = true;
}

//get search query ?q=search
$q = '';
if(isset($_GET['q'])){
    $q = $_GET['q'];
}


//get current request and save it on $_SCRIPT
include_once 'php/functions/getUriScript.php';
$uri = explode('?',$_SERVER['REQUEST_URI']);
$_SCRIPT = getUriScript($uri[0]);


include_once 'php/script/setPassword.php';
include_once 'php/script/jdf.php';
include 'php/script/user_default_array.php';
include 'php/script/my_db.php';
include 'php/script/get_user_info_login.php';

//set default product id
$productId='';

//get user location
include 'php/script/user_location.php';

//get default page
$page_default = '0';


//show add new post by user page
if( strtolower($_SCRIPT) == 'new' || strtolower($_SCRIPT) == 'new/'){  
    include 'php/add.php';
}

//show Chat Page
elseif( strtolower($_SCRIPT) == 'chat' || strtolower($_SCRIPT) == 'chat/'){
    $postUnicCode = '-1';
    $user = '0';
    $defaultTitle = '';
    $defaultUserName = '';
    $defaultImage = '';
    include 'php/chat.php';
}

//show Support Page
elseif( strtolower($_SCRIPT) == 'support' || strtolower($_SCRIPT) == 'support/' ||  strtolower($_SCRIPT) == 'contact/' || strtolower($_SCRIPT) == 'contact'){
    $postUnicCode = '0';
    $user = '0';
    $defaultTitle = 'پشتیبانی';
    $defaultUserName = 'پشتیبانی';
    $defaultImage = '<img src="'.$_MAIN_URL.'assets/image/profile/admin.png" >';
    include 'php/chat.php';
}

//show chat form with user
elseif( preg_match('#^chat\/[a-zA-Z0-9]{8,64}\/?$#',$_SCRIPT)){
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
}

// log out from account
elseif( strtolower($_SCRIPT == 'logout') ){
    include 'php/script/logout.php';
    header("Location: $_MAIN_URL".$_SESSION['current']);
    die();
}

//show first page
elseif( $_SCRIPT == '' ){
    $href_location = null;
    include 'php/multi.php';
}

//show posts list with city
elseif( preg_match('#^c\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+(\/?|\/r\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/?)$#',urldecode($_SCRIPT))){
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
}

//show post list with state
elseif( preg_match('#^s\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+(\/?|\/r\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/?)$#',urldecode($_SCRIPT))){
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
}

//show product single page
elseif( preg_match('#^p\/[a-z|A-Z|0-9]{8,24}(\/?|\/[^\/]+)\/?$#',urldecode($_SCRIPT))){
    $e= str_replace('/BekharBefrush/','',$_SCRIPT);
    $e=explode('/',$e);
    $page_default = $e[1];
    include 'php/multi.php';
}

//add sample post from digikala.com
elseif( preg_match('#^new\/dg\/[0-9]{7}\/?$#',$_SCRIPT)){
    $e = str_replace('/BekharBefrush/','',$_SCRIPT);
    $e = explode('/',$e);
    $productId = $e[2];
    include 'php/script/add-dkp.php';
    echo 'done';
}


//show user paneel
elseif( strtolower( $_SCRIPT) == 'user' or strtolower( $_SCRIPT) == 'user/'  or strtolower( $_SCRIPT) == 'user/mypost'  or strtolower( $_SCRIPT) == 'user/mypost/'){
    $input = 'MY_POST';
    $unic_code = '0';
    include 'php/user.php';
}


//show user paneel bookmarks
elseif( strtolower( $_SCRIPT) == 'user/bookmark' or strtolower( $_SCRIPT) == 'user/bookmark/' ){
    $input = 'MY_BOOKMARK';
    $unic_code = '0';
    include 'php/user.php';
}

//show user paneel history
elseif( strtolower( $_SCRIPT) == 'user/history' or strtolower( $_SCRIPT) == 'user/history/' ){
    $input = 'MY_HISTORY';
    $unic_code = '0';
    include 'php/user.php';
}

//show use post list
elseif( preg_match('#^user\/mypost\/[a-z|A-Z|0-9]{8,24}\/?$#',$_SCRIPT)){
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
    
   
}

// laws page
elseif( strtolower($_SCRIPT) == 'laws' || strtolower($_SCRIPT) == 'laws/'){
    include 'php/laws.php';
}

//sitemaps pages
elseif( strtolower($_SCRIPT) == 'sitemap.xml'){
    include 'sitemap/sitemap.php';
}
elseif( strtolower($_SCRIPT) == 'sitemap.html'){
    include 'sitemap/html/sitemap.php';
}
elseif( strtolower($_SCRIPT) == 'sitemap/category.xml'){
    include 'sitemap/category.php';
}
elseif( strtolower($_SCRIPT) == 'sitemap/location.xml'){
    include 'sitemap/location.php';
}
elseif( strtolower($_SCRIPT) == 'sitemap/post.xml'){
    include 'sitemap/post.php';
}
elseif( preg_match('#^s\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/sitemap\.html$#',urldecode($_SCRIPT))){
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
}
elseif( preg_match('#^s\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/r\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/sitemap\.html$#',urldecode($_SCRIPT))){
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
}
elseif( preg_match('#^c\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/sitemap\.html$#',urldecode($_SCRIPT))){
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
}
elseif( preg_match('#^c\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/r\/[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ-]+\/sitemap\.html$#',urldecode($_SCRIPT))){
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
}

else{
    include 'php/404.php';die;
}
