<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once('Func.php');
require_once(SYSTEM.'General/General.php');

$db=new General();
$GoogleAds=new GoogleAds();
date_default_timezone_set('Europe/London');
$Date=date('Y-m-d');

$GoogleSystem = $db->Query('Settings',['AccessToken' => ['$ne' => null]], [], 'TEK');
$GoogleId=$db->Company('GoogleId');


$Params = [
  "operations" => [
    [
      "create" => [
        "adGroup" => "customers/$GoogleId/adGroups/{$_POST["CampaignId"]}",
        "negative" => false,
        "status" => "ENABLED",
        "keyword" => [
          "text" => $_POST["Keyword"],
          "matchType" => $_POST["KeywordType"]
        ]
      ]
    ]
  ]
];





$Gonder=$GoogleAds->GoogleAdsPost($GoogleId,Google_ID,Google_DEVELOPER_TOKEN,$GoogleSystem['AccessToken'],$Params,'adGroupCriteria:mutate');
$Result=json_decode($Gonder,1);
if ($Result["results"]) {
  $resultx = array(
    'success' => true,
    'message' => 'Anahtar Kelime Başarılı Bir Şekilde Oluşturuldu.',
  );
}else {
  $resultx = array(
    'success' => false,
    'message' => 'Anahtar Kelime Oluşturulamadı. ('.$Result["error"]["message"].')',
  );
}
echo json_encode($resultx);



 ?>
