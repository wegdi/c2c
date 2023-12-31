<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once('Func.php');
require_once(SYSTEM.'General/General.php');
$db=new General();
$GoogleAds=new GoogleAds();
date_default_timezone_set('Europe/Istanbul');
$Date=date('Y-m-d');
$GoogleSystem = $db->Query('Settings',['AccessToken' => ['$ne' => null]], [], 'TEK');
$GoogleId=$db->Company('GoogleId');




$Params = array(
    "operations" => array(
        array(
            "create" => array(
                "status" => "ENABLED",
                "name" => $_POST["ConversionName"],
                "valueSettings" => array(
                    "defaultCurrencyCode" => "TRY",
                    "defaultValue" => 1
                ),
                "type" => "WEBPAGE",
                "category" => $_POST["Category"]
            )
        )
    )
);

// Oluşturulan diziyi kullanma


$Gonder=$GoogleAds->GoogleAdsPost($GoogleId,Google_ID,Google_DEVELOPER_TOKEN,$GoogleSystem['AccessToken'],$Params,'conversionActions:mutate');
$Result=json_decode($Gonder,1);
if ($Result["results"]) {
  $resultx = array(
    'success' => true,
    'message' => 'Dönüşüm Başarılı Bir Şekilde Oluşturuldu.',
  );
}else {
  $resultx = array(
    'success' => false,
    'message' => 'Dönüşüm Oluşturulamadı. ('.$Result["error"]["message"].')',
  );
}
echo json_encode($resultx);



 ?>
