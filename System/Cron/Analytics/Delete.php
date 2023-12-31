<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once(SYSTEM.'Cron/Analytics/Func.php');

$db=new General();
$GoogleSystem = $db->Query('Settings',['GtmAccess_token' => ['$ne' => null]], [], 'TEK');

$api_key = 'AIzaSyDvBnp_Y3wmbcLWgW6cJfPLfaqWESdqU3U';
$access_token = $GoogleSystem["GtmAccess_token"];
$AnalyticsX = new Analytics($api_key, $access_token);



$Analytics = $db->Query('Analytics',[], [], 'COK');

foreach ($Analytics as $key => $value) {

  echo $Analytics["property"];


      echo  $AnalyticsX->PropertiesDelete($Analytics["property"]);
    //  $j=json_decode($AnalyticsX->Properties($CompanyCode));
      //$url = "https://ads.akillipanda.com/System/Cron/Analytics/List.php";
      //$response = file_get_contents($url);


}
