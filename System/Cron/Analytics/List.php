<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once(SYSTEM.'Cron/Analytics/Func.php');

$db=new General();
$GoogleSystem = $db->Query('Settings',['GtmAccess_token' => ['$ne' => null]], [], 'TEK');

$api_key = 'AIzaSyDvBnp_Y3wmbcLWgW6cJfPLfaqWESdqU3U';
$access_token = $GoogleSystem["GtmAccess_token"];
$gtmAPI = new Analytics($api_key, $access_token);
$response = json_decode($gtmAPI->Accounts(),true);


foreach ($response["accountSummaries"][8]["propertySummaries"] as $key => $value) {

 $property=$value["property"];
  $Analytics = $db->Query('Analytics',['property' => $property], [], 'TEK');
  if ($Analytics["_id"]=="") {
    $db->Add("Analytics", $value);
  }else {
    $db->UpdateByObjectId("Analytics",(string)$Analytics["_id"], $value);
  }

}
