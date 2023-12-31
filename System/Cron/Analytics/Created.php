<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once(SYSTEM.'Cron/Analytics/Func.php');

$db=new General();
$GoogleSystem = $db->Query('Settings',['GtmAccess_token' => ['$ne' => null]], [], 'TEK');

$api_key = 'AIzaSyDvBnp_Y3wmbcLWgW6cJfPLfaqWESdqU3U';
$access_token = $GoogleSystem["GtmAccess_token"];
$AnalyticsX = new Analytics($api_key, $access_token);


$Companies = $db->Query('Companies',[], [], 'COK');


foreach ($Companies as $key => $value) {


    $CompanyCode=(string)$value["CompanyCode"];

    $Analytics = $db->Query('Analytics',['displayName' => $CompanyCode], [], 'TEK');

    if ($Analytics["_id"]=="") {
      $j=json_decode($AnalyticsX->Properties($CompanyCode));
      print_R($j);
      $url = "https://ads.akillipanda.com/System/Cron/Analytics/List.php";
      $response = file_get_contents($url);
    }else {
      echo "Yapılcak İşlem Yok";
    }

}
