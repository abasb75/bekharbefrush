<?php //UKEDYBSGTH=is_user_login?
//JBEHJBEUEIEUIO = USER NOT LOGIN
//94jdey7e2dutt8qw09230903 = USER IS LOGIN
//pednoieiijeiocenoi = Phone Number


include_once 'setPassword.php';
if(isset($_COOKIE['UKEDYBSGTH']) ){
    if($_COOKIE['UKEDYBSGTH'] == '94jdey7e2dutt8qw09230903'){
        if(isset($_COOKIE['pednoieiijeiocenoi']) and check_user(openPasswordCookie($_COOKIE['pednoieiijeiocenoi']))){
            $_USER = get_user_info(openPasswordCookie($_COOKIE['pednoieiijeiocenoi']));
        }else{
           //setcookie('UKEDYBSGTH','JBEHJBEUEIEUIO', ['expires'=>time()+(86400 * 30) ,'path'=>'/','httponly'=>TRUE]);
           $cookie_name = "UKEDYBSGTH";
     $cookie_value = 'JBEHJBEUEIEUIO';
        setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
        }
    }else{
        //setcookie('UKEDYBSGTH','JBEHJBEUEIEUIO', ['expires'=>time()+(86400 * 30) ,'path'=>'/','httponly'=>TRUE]);
        $cookie_name = "UKEDYBSGTH";
     $cookie_value = 'JBEHJBEUEIEUIO';
        setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
    }
    
}else{
    $cookie_name = "UKEDYBSGTH";
     $cookie_value = 'JBEHJBEUEIEUIO';
        setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
}

function check_user($user_phone){
    if($user_phone =='BAD_INPUT'){
        return false;
    }
    global $connect ;
    $sql = "SELECT * FROM `user` WHERE user.phone = '$user_phone';";
    if($connect){
        $result = mysqli_query($connect,$sql);
        if($r = mysqli_fetch_assoc($result)){
            return true;
        }
        return false;
    }
    return false;
}
function get_user_info($user_phone){
    global $connect;
    $sql = "SELECT * FROM `user` WHERE user.phone = '$user_phone';";
    $result = mysqli_query($connect,$sql);
    $r = mysqli_fetch_assoc($result);
    return ['id'=>$r['id'],'phone'=>openPassword($r['phone']),'name'=>$r['name'],'status'=>'LOGIN','mail'=>$r['mail'],'location_name'=>'','location'=>'','category'=>'c_0','category_name'=>'همه دسته ها','category_slug'=>''];
}

?>