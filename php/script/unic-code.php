<?php

$keyUnic=[
    '0'=>['j','q','r','4','s','O'],
    '1'=>['3','k','d','t','0','T'],
    '2'=>['K','p','D','F','J','S'],
    '3'=>['c','2','i','a','I','R'],
    '4'=>['o','L','9','b','G','Q'],
    '5'=>['z','8','E','B','g','W'],
    '6'=>['A','y','7','C','M','P'],
    '7'=>['f','1','u','5','m','V'],
    '8'=>['n','w','N','v','H','X'],
    '9'=>['x','e','6','h','l','U']
];

function getUnicCode($id){
    $str ='';
    for($i=0;$i<strlen($id);$i++){
        $str = $str . getRandomKey($id[$i]);
    }
    return $str;
}
function getRandomKey($ch){
    global $keyUnic;
    return $keyUnic[$ch][rand(0,5)].$keyUnic[$ch][rand(0,5)];
}
