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
$Response = array('countryId','country','city','browser','pageTitle','platform','mobileDeviceModel','pageReferrer');
foreach ($Analytics as $key => $value) {

  foreach ($Response as $valueName) {
    // code...

    $Raport360=json_decode($AnalyticsX->Raport360($value["property"],$valueName),1);
    foreach ($Raport360["rows"] as $key => $valuesx) {

      $datax = array(
        'Name' => $valuesx["dimensionValues"][0]["value"],
        'Total' => $valuesx["metricValues"][0]["value"],
        'CompanyCode' => $value["displayName"],
        'Type' => $valueName,
        'DateType' => '1Year',
      );

      $data = array(
        'Name' => $valuesx["dimensionValues"][0]["value"],
        'Total' => $valuesx["metricValues"][0]["value"],
        'CompanyCode' => $value["displayName"],
        'Type' => $valueName,
        'DateType' => '1Year',
        'Uniq' =>   md5(json_encode($datax))
      );

      $AnalyticsRaport = $db->Query('AnalyticsRaport',["Uniq" => md5(json_encode($datax))], [], 'TEK');

      if ($AnalyticsRaport["_id"]=="") {
        $db->Add("AnalyticsRaport", $data);
      }else {
        $db->UpdateByObjectId("AnalyticsRaport",(string)$AnalyticsRaport["_id"], $data);
      }

    }
  }

}
