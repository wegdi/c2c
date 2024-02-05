<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();


$IdeaSoft = $db->Query('IdeaSoft',["_id" => $db->ObjectId('65a784f66b188048239f446c')], [], 'TEK');


//2 Aylık Token Al
$RefresToken = array(
  'grant_type' => 'refresh_token',
  'client_id' => '3pebeuh6xb40swk0c08ckkow0g0ogcc40k4ggkw8so8owgowk4',
  'client_secret' => '40cezisrdy68cwoso8k40c4kcso040o8sso80ggkggs4gkk84c',
  'refresh_token' => $IdeaSoft["refresh_token"]
);

// Parametreleri URL'ye çevir
$queryStringx = http_build_query($RefresToken);

// Hedef URL'yi belirle
$targetUrlx = 'https://www.katfarlaryedekparca.com/oauth/v2/token?' . $queryStringx;


$curl = curl_init();

curl_setopt_array($curl, array(
		CURLOPT_URL => $targetUrlx,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);


// JSON verilerini diziye çevir
$responseArrayx = json_decode($response, true);

$UpdateData = array(
  'access_token' => $responseArrayx["access_token"],

);

echo $db->UpdateByObjectId("IdeaSoft",'65a784f66b188048239f446c',$UpdateData);