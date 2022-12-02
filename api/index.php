<?php
$first = explode('?',$_SERVER['REQUEST_URI']);
$_SCRIPT = $first[0];
$_SCRIPT = str_replace('/BekharBefrush/','',$_SCRIPT);
$_SCRIPT = str_replace('/BekharBefrush','',$_SCRIPT);
$_SCRIPT = str_replace('/bekharbefrush/','',$_SCRIPT);
$_SCRIPT = str_replace('/bekharbefrush','',$_SCRIPT);
$_SCRIPT = str_replace('/BEKHARBEFRUSH/','',$_SCRIPT);
$_SCRIPT = str_replace('/BEKHARBEFRUSH','',$_SCRIPT);
if($_SCRIPT == ''){
    
}