<?php

function getUriScript($uriScript){
    $_SCRIPT = str_replace('/BekharBefrush/','',$uriScript);
    $_SCRIPT = str_replace('/BekharBefrush','',$_SCRIPT);
    $_SCRIPT = str_replace('/bekharbefrush/','',$_SCRIPT);
    $_SCRIPT = str_replace('/bekharbefrush','',$_SCRIPT);
    $_SCRIPT = str_replace('/BEKHARBEFRUSH/','',$_SCRIPT);
    $_SCRIPT = str_replace('/BEKHARBEFRUSH','',$_SCRIPT);
    $_SCRIPT = ltrim($_SCRIPT , '/' );
    return $_SCRIPT;
}