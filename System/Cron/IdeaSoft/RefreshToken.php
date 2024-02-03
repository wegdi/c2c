<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();


$IdeaSoft = $db->Query('IdeaSoft',["_id" => $db->ObjectId('65a784f66b188048239f446c')], [], 'TEK');


//2 Aylık Token Al
$RefresToken = array(
  'grant_type' => 'refresh_token',
  'client_id' => '1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8',
  'client_secret' => '3lhhwkqmlc6cow88wgwwkwcc8k00gwsw8k8osg00084ossc4wo',
  'refresh_token' => $IdeaSoft["refresh_token"]
);

// Parametreleri URL'ye çevir
$queryStringx = http_build_query($RefresToken);

// Hedef URL'yi belirle
$targetUrlx = 'https://www.katfarlaryedekparca.com/oauth/v2/token?' . $queryStringx;

// Diğer sayfadaki JSON verilerini çek
$responseJsonx = file_get_contents($targetUrlx);

// JSON verilerini diziye çevir
$responseArrayx = json_decode($responseJsonx, true);

print_r($responseArrayx);
$UpdateData = array(
  'refresh_token' => $responseArrayx["refresh_token"],
  'access_token' => $responseArrayx["access_token"],

);

echo $db->UpdateByObjectId("IdeaSoft",'65a784f66b188048239f446c',$UpdateData);
