<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once(SYSTEM.'Cron/GTM/Func.php');

$db=new General();
$GoogleSystem = $db->Query('Settings',['GtmAccess_token' => ['$ne' => null]], [], 'TEK');

$api_key = 'AIzaSyDvBnp_Y3wmbcLWgW6cJfPLfaqWESdqU3U';
$access_token = $GoogleSystem["GtmAccess_token"];
$gtmAPI = new GoogleTagManagerAPI($api_key, $access_token);
$response = json_decode($gtmAPI->ContainersList(),true);

foreach ($response["container"] as $key => $value) {
  print_R($value);
  $containerId=$value["containerId"];

  $Container = $db->Query('GtmContainer',['containerId' => $containerId], [], 'TEK');

  if ($Container["_id"]=="") {
    $db->Add("GtmContainer", $value);

  }else {
    $db->UpdateByObjectId("GtmContainer",(string)$Container["_id"], $value);

  }

}
 ?>
