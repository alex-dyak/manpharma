<?php

// Version
define('VERSION', '3.0.3.2');

// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}

// Install
if (!defined('DIR_APPLICATION')) {
	header('Location: install/index.php');
	exit;
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

start('catalog');


function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && empty($ip)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if(empty($ip)){
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return explode(',',$ip)[0];
}

function setFile($ip)
{
    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt')){
        $arDateTmp = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt');
        $arDate = json_decode($arDateTmp,true);
        $arDate[$ip]['date'] = date('d.m.Y');
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt',json_encode($arDate));
    }

}
function setFileCart($ip)
{
    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt')){
        $arDateTmp = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt');
        $arDate = json_decode($arDateTmp,true);
        if(!empty($arDate[$ip])){
            $arDate[$ip]['page-cart'] = 'Y';
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt',json_encode($arDate));
        }
    }

}
function setFileCheckout($ip)
{
    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt')){
        $arDateTmp = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt');
        $arDate = json_decode($arDateTmp,true);
        if(!empty($arDate[$ip])){
            $arDate[$ip]['sale'] = 'Y';
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt',json_encode($arDate));
        }
    }

}
if(strpos($_SERVER['REQUEST_URI'], '/checkout/') !== false){
    setFileCart(getUserIP());
}if(strpos($_SERVER['REQUEST_URI'], '/hooray/') !== false || strpos($_SERVER['REQUEST_URI'], '/hurra/') !== false){
    setFileCheckout(getUserIP());
}else{
    setFile(getUserIP());
}
