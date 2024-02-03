<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();

$state = $_GET["state"];
$code = $_GET["code"];
$domain = $_GET["domain"];


// Veritabanını güncelle

$params = array(
    'grant_type' => 'authorization_code',
    'client_id' => '3pebeuh6xb40swk0c08ckkow0g0ogcc40k4ggkw8so8owgowk4',
    'client_secret' => '40cezisrdy68cwoso8k40c4kcso040o8sso80ggkggs4gkk84c',
    'code' => $code,
    'redirect_uri' => 'https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php'
);






// Parametreleri URL'ye çevir
$queryString = http_build_query($params);

$targetUrl = 'https://www.katfarlaryedekparca.com/oauth/v2/token?' . $queryString;


$curl = curl_init();

curl_setopt_array($curl, array(
		CURLOPT_URL => $targetUrl,
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
$response =json_decode($response,1);
$data = array(
  'access_token' => $response["access_token"],
  'refresh_token' => $response["refresh_token"],

);
echo $db->UpdateByObjectId("IdeaSoft", "65a784f66b188048239f446c",$data);
