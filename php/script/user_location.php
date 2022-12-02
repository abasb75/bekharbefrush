<?php

if(isset($_COOKIE['location']) and isset($_COOKIE['location_name'])){
    $l =$_COOKIE['location'];
    $ln =$_COOKIE['location_name'];
    if($l=='i_0'){
        $_USER['location']='i_0';
        $_USER['location_name']='ایران';
        $_USER['location_slug']='s/ایران/';
    }elseif(preg_match('#^s_[0-9]+$#',$l)){
        $s = explode('_',$l);
        $s = $s[1];
        $sql = "SELECT * FROM `provinces` WHERE id=$s";
        $res1 = mysqli_query($connect,$sql);
        if($r1 = mysqli_fetch_assoc($res1)){
            $_USER['location']=$l;
            $_USER['location_name']=$ln;
            $_USER['location_slug']='s/'.$r1['slug'].'/';
        }else{
            $_USER['location']='i_0';
            $_USER['location_name']='ایران';
            $_USER['location_slug']='s/ایران/';
        }
    }elseif(preg_match('#^c_[0-9]+$#',$l)){
        $s = explode('_',$l);
        $s = $s[1];
        $sql = "SELECT * FROM `cities` WHERE id=$s";
        $res1 = mysqli_query($connect,$sql);
        if($r1 = mysqli_fetch_assoc($res1)){
            $_USER['location']=$l;
            $_USER['location_name']=$ln;
            $_USER['location_slug']='c/'.$r1['slug'].'/';
        }else{
            $_USER['location']='i_0';
            $_USER['location_name']='ایران';
            $_USER['location_slug']='s/ایران/';
        }
    }
}else{
    $_USER['location']='i_0';
    $_USER['location_name']='ایران';
    $_USER['location_slug']='s/ایران/';
    //setcookie('location','i_0', ['expires'=>time()+(8640000 * 30) ,'path'=>'/']);
    $cookie_name = "location";
    $cookie_value = "i_0";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
    
    
    //setcookie('location_name','ایران', ['expires'=>time()+(8640000 * 30) ,'path'=>'/']);
    $cookie_name = "location_name";
    $cookie_value = "ایران";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
    
}




