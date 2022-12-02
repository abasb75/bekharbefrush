<?php
session_start();
include '../script/my_db.php';
include '../script/setPassword.php';



if(isset($_POST['ph'])){
    $phone = $_POST['ph'];
    if(checkPhone($phone)){
        $_SESSION['phone'] = $phone;
        $_SESSION['IS_LOGIN_CODE'] = 'no';
        add_phone('0'.$phone);
        die;
    }else{
        echo 'NTX1'; die;
    }
}else{
    echo 'NTX2'; die;
}


function checkPhone($phone){
    $len = strlen($phone);
    if(preg_match('#^9[01239][0-9]{8}$#',$phone)){ return true; } 
    else{return false;}
    /*if($len < 10){ return false; }
    if($phone[0]!='9' ){return false;}
    if($phone[1]!='0' && $phone[1] != '1' && $phone[1] != '2' && $phone[1] != '3' && $phone[1] != '9' ){return false;}
    return true;*/
}


function add_phone($phone){
    global $connect ;
    $ph = setPassword($phone);
    if(!$connect){ echo 'NTX'; return false; }
    $sql = "SELECT `id`, `phone`, `name`, `validation_code`, `time`, `mail` FROM `user` WHERE user.phone='$ph';";
    $result = mysqli_query($connect,$sql);
    if($r = mysqli_fetch_assoc($result)){
        $rand_num = rand(12748,98787) ;
        $insert_query = "UPDATE `user` SET `validation_code`='$rand_num',`time`= CURRENT_TIMESTAMP + INTERVAL 5 MINUTE  WHERE user.phone='$ph'; ";
        $result = mysqli_query($connect,$insert_query);
        if($result){
            echo 'CXE';
            $_SESSION['active_code'] = $rand_num;
            $_SESSION['active_limited'] = time() + 5 * 60;
            sendSMS('0'.$phone,$rand_num);
        }else{
            echo 'NTX';
        }
    }else{
        $rand_num = rand(12748,98787) ;
        $insert_query = "INSERT INTO `user`( `phone`, `name`, `validation_code`, `time`, `mail`) VALUES ('$ph','','$rand_num',CURRENT_TIMESTAMP + INTERVAL 5 MINUTE,'')";
        $result = mysqli_query($connect,$insert_query);
        if($result){
            $_SESSION['active_code'] = $rand_num;
            $_SESSION['active_limited'] = time() + 5 * 60;
            sendSMS('0'.$phone,$rand_num);
            echo 'CXE';
        }
        else{
            echo 'NTX';
        }
    }
}


function sendSMS($ph,$rand_num){
    $url = 'https://console.melipayamak.com/api/send/simple/b7fe1569621541c9a398beb110349798';
    $data = array('from' => '50004001827703', 'to' => $ph, 'text' => "کد تایید شما : $rand_num
    وب سایت بخربفروش");
    $data_string = json_encode($data);
    $ch = curl_init($url);                          
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                      
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    
    // Next line makes the request absolute insecure
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Use it when you have trouble installing local issuer certificate
    // See https://stackoverflow.com/a/31830614/1743997
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
      array('Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
      );
    $result = curl_exec($ch);
    curl_close($ch);
    
    
    
    
}

?>