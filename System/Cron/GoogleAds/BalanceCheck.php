<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once('Func.php');
require_once(SYSTEM.'General/General.php');
$db=new General();
$GoogleAds=new GoogleAds();
date_default_timezone_set('Europe/Istanbul');
$Date=date('Y-m-d');


$Companies = $db->Query('Companies',['GoogleId' => ['$ne' => null]], [], 'COK');

foreach ($Companies as $key => $AccountValue) {

  $GoogleCampaign = $db->Query('GoogleCampaign',['CompaniesCode' => (int)$AccountValue["CompanyCode"]], [], 'COK');

  $total=0;
  foreach ($GoogleCampaign as $keyc) {
    $Amaount=$total+=$keyc["Remaining_Budget"];

  }



  ///Burası Ödemeler
  $Order = $db->Query('Order',['CompanyCode' => (int)$AccountValue["CompanyCode"],'Status' => 1,'Condition' => 'google'], [], 'COK');

  $odemetop=0;
  foreach ($Order as $odemc) {
    if ($odemc["Date"] > strtotime('2023-07-10')) {
      $oran=35;
    }else {
      $oran=33;
    }
  $son=$odemetop+=$db->KdvHesapla($odemc["PaymentAmount"],$oran);
  }
  $bit=$son-$Amaount;
  echo $AccountValue["CompanyName"]; echo ' '.number_format($bit, 2, ',', '.');
  $data = array('Balance' => (double)$bit );
  $db->UpdateByObjectId("Companies",(string)$AccountValue["_id"], $data);

  //$AccountValue["CompanyName"].'_'.$bit;
  echo "<br>";


}
