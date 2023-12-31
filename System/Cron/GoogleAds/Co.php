

<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once('Func.php');
require_once(SYSTEM.'General/General.php');
$db=new General();
$GoogleAds=new GoogleAds();
date_default_timezone_set('Europe/Istanbul');
$Date=date('Y-m-d');
//$Date=date('2023-10-31');
$Query = '{
    "pageSize": 100,
    "query": "SELECT conversion_action.id FROM conversion_action"

}';


$GoogleSystem = $db->Query('Settings',['AccessToken' => ['$ne' => null]], [], 'TEK');
$Companies = $db->Query('Companies',['GoogleId' => ['$ne' => null]], [], 'COK');

foreach ($Companies as $key => $AccountValue) {
  $CompaniesID=$AccountValue["_id"];

  $AccountId=$AccountValue["GoogleId"];
  $CompaniesCode=$AccountValue["CompanyCode"];
  $Commission=$AccountValue["Commission"];
  $SuankiButce=$AccountValue["google_ads_butce"];



  $GoogelSonuclar=$GoogleAds->googleistek(Google_DEVELOPER_TOKEN,Google_ID,$GoogleSystem['AccessToken'],$AccountId,$Query);

  foreach ($GoogelSonuclar["results"] as $key => $value) {

  $Params = array('conversionActionresourceName' => $value["conversionAction"]["resourceName"] );
  $db->UpdateByObjectId("Companies",(string)$CompaniesID, $Params);




  }



}

//
?>
