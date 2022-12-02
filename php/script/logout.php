<?php 

if(isset($_SESSION['is_login'])){
    $_SESSION['is_login'] = 'LOGOUT';
}
if(isset($_SESSION['is_login'])){
    $_SESSION['phone'] = '0';
}

if(isset($_COOKIE['UKEDYBSGTH'])){
   // setcookie('UKEDYBSGTH','JBEHJBEUEIEUIO', ['expires'=>time()-1 ,'path'=>'/','httponly'=>TRUE]);
    $cookie_name = "UKEDYBSGTH";
     $cookie_value = 'JBEHJBEUEIEUIO';
        setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day

}
if(isset($_COOKIE['pednoieiijeiocenoi'])){
    setcookie('pednoieiijeiocenoi','0ew890uyhncIOJIEJ09RIJ90RJRC0J09RJRE09ER09UE09WWEJE09JEWE90Wuhnuch9re8quj98rjc98jr98jr98c', ['expires'=>time()-1 ,'path'=>'/', 'httponly'=>TRUE]);
    $cookie_name = "pednoieiijeiocenoi";
     $cookie_value = '0ew890uyhncIOJIEJ09RIJ90RJRC0J09RJRE09ER09UE09WWEJE09JEWE90Wuhnuch9re8quj98rjc98jr98jr98c';
        setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
}




?>