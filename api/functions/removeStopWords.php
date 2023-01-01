<?php 

function removeStopWords($words){
    $a = explode(' ',$words);
    
    $b = array();
    
    for ($i=0;$i<sizeof($a);$i++){
        $a[$i] = preg_replace('#[^a-zA-Zآابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ\s]{1}#','',$a[$i]);
        if(mb_strlen($a[$i])<=1){
            continue;
        }
        array_push($b , $a[$i]);
    }
    return $b;
}
