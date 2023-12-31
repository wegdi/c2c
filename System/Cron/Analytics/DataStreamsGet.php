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

  $so=json_decode($AnalyticsX->dataStreamsGet($value["property"]),1);
  $Companies = $db->Query('Companies',['CompanyCode' => (int)$value["displayName"]], [], 'TEK');
  if (empty($so) and $Companies["Domain"]!="") {
      $json=$AnalyticsX->dataStreamsPost($value["property"],$value["displayName"],'https://'.$Companies["Domain"]);
      $Params = array('DataStreams' =>  json_decode($json,1));
      $db->UpdateByObjectId("Analytics",(string)$value["_id"], $Params);

  }
}
