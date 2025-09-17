<?php
echo'<pre>';
print_r($_POST);
echo'</pre>';
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
function setFileAddCart($ip)
{
    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt')){
        $arDateTmp = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt');
        $arDate = json_decode($arDateTmp,true);
        $arDate[$ip]['add-cart'] = 'Y';
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt',json_encode($arDate));
    }

}
function setFileCheck($ip)
{
    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt')){
        $arDateTmp = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt');
        $arDate = json_decode($arDateTmp,true);
        $arDate[$ip]['check'] = 'Y';
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt',json_encode($arDate));
    }

}
if($_POST['key'] == 'add-cart'){
    setFileAddCart(getUserIP());
}
if($_POST['key'] == 'check'){
    setFileCheck(getUserIP());
}