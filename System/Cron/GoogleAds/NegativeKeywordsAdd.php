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
$CompanyCode=$db->Company('CompanyCode');


$GoogleNegativeWords = $db->Query('GoogleNegativeWords', ['CompanyCode' => (int)$CompanyCode,'GoogleStatus' => 0 ], [], 'COK');
$Params = [];

foreach ($GoogleNegativeWords as $key => $value) {

  $Params[] = [

        "create" => [
          "adGroup" => "customers/$GoogleId/adGroups/{$_POST["CampaignId"]}",
          "negative" => true,
          "status" => "ENABLED",
          "keyword" => [
            "text" => $value["Keywords"],
            "matchType" => "BROAD"
          ]
        ]


  ];

  $db->UpdateByObjectId("GoogleNegativeWords",(string)$value["_id"],array('GoogleStatus' => 1 ));

}

$Paramss= ["operations" => $Params];


$Gonder=$GoogleAds->GoogleAdsPost($GoogleId,Google_ID,Google_DEVELOPER_TOKEN,$GoogleSystem['AccessToken'],$Paramss,'adGroupCriteria:mutate');
$Result=json_decode($Gonder,1);
if ($Result["results"]) {
  $resultx = array(
    'success' => true,
    'message' => 'Negatif Anahtar Kelime Başarılı Bir Şekilde Oluşturuldu.',
  );
}else {
  $resultx = array(
    'success' => false,
    'message' => 'Negatif Anahtar Kelime Oluşturulamadı. ('.$Result["error"]["message"].')',
  );
}
echo json_encode($resultx);




 ?>
