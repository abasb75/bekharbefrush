<?php

function createPrice($pr){ 
    if($pr=='0' or $pr == ''){ 
        return 'توافقی';
    } 
    $new_pr = ''; 
    $counter = 1; 
    for($i=strlen($pr)-1;$i>=0;$i--){ 
        if($counter==3 and $i!=0){ 
            $new_pr = ','.$pr[$i].$new_pr; $counter = 1; 
            continue; }else{ $new_pr = $pr[$i].$new_pr; $counter++; 
        }
    } 
    $new_pr = $new_pr .' تومان'; 
    return $new_pr; 
}
