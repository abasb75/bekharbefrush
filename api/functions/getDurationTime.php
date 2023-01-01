<?php

function getDurationTime($time){
    $diff = abs(time() - strtotime($time));
    if($diff > 31536000){
        return floor($diff/(31536000)).' سال پیش';
    }elseif($diff > 2592000){
        return floor($diff/(2592000)).' ماه پیش';
    }elseif($diff > 604800){
        return floor($diff/(604800)).' هفته پیش';
    }elseif($diff > 86400){
        return floor($diff/(86400)).' روز پیش';
    }elseif($diff > 3600){
        return floor($diff/(3600)).' ساعت پیش';
    }elseif($diff > 60){
        return floor($diff/(60)).' دقیقه پیش';
    }else{
        return 'لحضاتی قبل';
    }
}