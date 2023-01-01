<?php

$keys = ['0' =>'Wqu4','1' =>'FprS','2' =>'VAGu','3' =>'umWI','4' =>'Tope','5' =>'JsMV','6' =>'4RW9','7' =>'iApp','8' =>'rS9D','9' =>'3PId','a' =>'CYxn','b' =>'mlm1','c' =>'3mlE','d' =>'c9LC','e' =>'Kmw2','f' =>'El2U','g' =>'Mz13','h' =>'DAek','i' =>'uezb','j' =>'bwZv','k' =>'mXds','l' =>'Zzzf','m' =>'etxZ','n' =>'3ZYU','o' =>'aE53','p' =>'MQLK','q' =>'vzLz','r' =>'c6NR','s' =>'t6Ii','t' =>'d49l','u' =>'Mhzo','v' =>'42IA','w' =>'hhB3','x' =>'bI8f','y' =>'bcH8','z' =>'JGmt','A' =>'rNVw','B' =>'0ZLZ','C' =>'sQlF','D' =>'WbYc','E' =>'7pCs','F' =>'SxBz','G' =>'Sb6r','H' =>'RvFM','I' =>'pOzl','J' =>'6dMu','K' =>'jgYS','L' =>'ofi0','M' =>'rCH1','N' =>'nrXL','O' =>'NRNj','P' =>'dxoo','Q' =>'iiA2','R' =>'kCJU','S' =>'brbN','T' =>'yBW4','U' =>'8anP','V' =>'mn67','W' =>'Hp05','X' =>'geTh','Y' =>'l9uv','Z' =>'UcpK', '@'=>'kA73','.'=>'ddrw','_'=>'3e53'];


function setPassword($input){
    
    global $keys;
    $len = strlen($input);
    $str='';
    for($i=0; $i<$len; $i++){
        $str = $str . $keys[ $input[$i] ];
    }
    return $str;
}

function openPassword($input){
    global $keys;
    $len = strlen($input);
    $str='';
    for($i=0; $i<$len; $i=$i+4){
        if($i+4 <= $len){
            $ch = array_search($input[$i].$input[$i+1].$input[$i+2].$input[$i+3] , $keys);
            if($ch != ''){
                $str = $str . $ch;
            }else{
                return 'BAD_INPUT';
            }
        }else{
            return 'BAD_INPUT';
        }
        
        
    }
    return $str;
}




//for cookie
$user_keys = ['0' =>'K2Xa','1' =>'gNv5','2' =>'a1zc','3' =>'s6IP','4' =>'q6Rl','5' =>'4YRq','6' =>'KYth','7' =>'5ltm','8' =>'1NAX','9' =>'yMQd','a' =>'JLht','b' =>'EUQQ','c' =>'ihYK','d' =>'d8tw','e' =>'u3Uq','f' =>'K1gS','g' =>'CWiP','h' =>'1n5w','i' =>'xO1x','j' =>'6vFM','k' =>'ruRd','l' =>'ILVE','m' =>'A7m0','n' =>'SBWB','o' =>'G93S','p' =>'51US','q' =>'GmE0','r' =>'tv8q','s' =>'WLGb','t' =>'zxVA','u' =>'YTWG','v' =>'1iuQ','w' =>'c6YA','x' =>'MhEW','y' =>'UaRa','z' =>'7oz0','A' =>'ACis','B' =>'0O08','C' =>'kPA8','D' =>'XJRY','E' =>'JOlq','F' =>'9dl2','G' =>'zMPo','H' =>'o3Xi','I' =>'aXdf','J' =>'QfPy','K' =>'3iM8','L' =>'4XYT','M' =>'LuDG','N' =>'R2t2','O' =>'WHCo','P' =>'LU9R','Q' =>'joF3','R' =>'0jTX','S' =>'eMES','T' =>'tiX8','U' =>'rkSt','V' =>'kUAh','W' =>'LE7Q','X' =>'Psrc','Y' =>'X6bb','Z' =>'tDMR','@' =>'aDzP','_' =>'5jxt','.' =>'gVfh'];


function setPasswordCookie($input){
    global $user_keys;
    $len = strlen($input);
    $str='';
    for($i=0; $i<$len; $i++){
        $str = $str . $user_keys[ $input[$i] ];
    }
    return $str;
}

function openPasswordCookie($input){
    global $user_keys;
    $len = strlen($input);
    $str='';
    for($i=0; $i<$len; $i=$i+4){
        if($i+4 <= $len){
            $ch = array_search($input[$i].$input[$i+1].$input[$i+2].$input[$i+3] , $user_keys);
            if($ch != ''){
                $str = $str . $ch;
            }else{
                return 'BAD_INPUT';
            }
        }else{
            
            return 'BAD_INPUT';
        }
        
        
    }
    return $str;
}







?>