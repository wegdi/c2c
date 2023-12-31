<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once('Func.php');
require_once(SYSTEM.'General/General.php');
$db=new General();
$GoogleAds=new GoogleAds();
date_default_timezone_set('Europe/London');

$Date=date('Y-m-d');
//$Date=date('2023-10-31');
$Query = '{
    "pageSize": 100,
    "query": "
    SELECT conversion_action.type, conversion_action.value_settings.always_use_default_value, conversion_action.value_settings.default_currency_code, conversion_action.value_settings.default_value, conversion_action.view_through_lookback_window_days, conversion_action.third_party_app_analytics_settings.provider_name, conversion_action.third_party_app_analytics_settings.event_name, conversion_action.status, conversion_action.resource_name, conversion_action.primary_for_goal, conversion_action.phone_call_duration_seconds, conversion_action.owner_customer, conversion_action.origin, conversion_action.name, conversion_action.mobile_app_vendor, conversion_action.include_in_conversions_metric, conversion_action.id, conversion_action.counting_type, conversion_action.click_through_lookback_window_days, conversion_action.category, conversion_action.attribution_model_settings.data_driven_model_status, conversion_action.attribution_model_settings.attribution_model, conversion_action.app_id, metrics.all_conversions, metrics.all_conversions_value FROM conversion_action
    WHERE segments.date BETWEEN \'' . $Date . '\' AND \'' . $Date . '\'"
}';


$GoogleSystem = $db->Query('Settings',['AccessToken' => ['$ne' => null]], [], 'TEK');
$Companies = $db->Query('Companies',['GoogleId' => ['$ne' => null]], [], 'COK');

foreach ($Companies as $key => $AccountValue) {
  $AccountId=$AccountValue["GoogleId"];
  $CompaniesCode=$AccountValue["CompanyCode"];
  $Commission=$AccountValue["Commission"];
  $SuankiButce=$AccountValue["google_ads_butce"];



  $GoogelSonuclar=$GoogleAds->googleistek(Google_DEVELOPER_TOKEN,Google_ID,$GoogleSystem['AccessToken'],$AccountId,$Query);

  foreach ($GoogelSonuclar["results"] as $key => $value) {

      $Params = array(
        'ConversionName' => $value["conversionAction"]["name"],
        'AllConversions' => $value["metrics"]["allConversions"],
        'ConversionId' => (int)$value["conversionAction"]["id"],
        'CompaniesCode' => $CompaniesCode,
        'Date' => strtotime($Date)
      );

       $GoogleConversion = $db->Query('GoogleConversion',['Date' => strtotime($Date),'ConversionId' => (int)$value["conversionAction"]["id"]], [], 'TEK');


       if ($GoogleConversion["_id"]=="") {
         $db->Add("GoogleConversion", $Params);

       }else {
         $db->UpdateByObjectId("GoogleConversion",(string)$GoogleConversion["_id"], $Params);

       }


  }



}

//
?>
