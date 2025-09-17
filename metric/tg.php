<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt')){
    $arDateTmp = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/metric/tmp.txt');
    $arDate = json_decode($arDateTmp,true);
}
$countPeople = count($arDate);
$countCartAdd = 0;
$countCartCheckOne = 0;
$countCartCheckTwo = 0;
$countSale = 0;
foreach ($arDate as $item){
    if($item['add-cart'] == 'Y'){
        $countCartAdd++;
    }
    if($item['page-cart'] == 'Y'){
        $countCartCheckOne++;
    }
    if($item['check'] == 'Y'){
        $countCartCheckTwo++;
    }
    if($item['sale'] == 'Y'){
        $countSale++;
    }
}

$tg_user = '-4193612069';
$bot_token = '6842210129:AAGiP1_EM6MGgFAvesUffgQReUV_PgOCOTs';
$text = "
Дата: <b>".date('d.m.Y H:i:s')."</b>\n
<b>".$countPeople."</b> - пришли на сайт.\n
<b>".$countCartAdd."</b> - положили в корзину\n
<b>".$countCartCheckOne."</b> - дошли до чек аута\n
<b>".$countCartCheckTwo."</b> - нажали на чек аут\n
<b>".$countSale."</b> - сделали заказ\n";


$params = array(
    'chat_id' => $tg_user,
    'text' => $text,
    'parse_mode' => 'HTML',
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $bot_token . '/sendMessage');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
$result = curl_exec($curl);
curl_close($curl);
