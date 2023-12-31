<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();

$clientId = '777726485505-cdgi66s5pv6trsoujqdummocqq7p4sgg.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://ads.akillipanda.com/System/Cron/GTM/redirectUri.php'; // OAuth 2.0 kimlik doğrulama ayarlarında belirlediğiniz yönlendirme URI
$GoogleSystem = $db->Query('Settings',['GtmRefresh_token' => ['$ne' => null]], [], 'TEK');

$code = $GoogleSystem["GtmRefresh_token"]; // Kullanıcının kimlik doğrulama işlemi sırasında aldığınız code

// Google API URL'leri

// İstek parametreleri
$params = array(
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'refresh_token' => $code,
    'redirect_uri' => $redirectUri,
    'grant_type' => 'refresh_token',
);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.googleapis.com/oauth2/v4/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $params,
));

$response = curl_exec($curl);
echo $response;
curl_close($curl);
$responses=json_decode($response,true);
echo "string";

// Erişim tokenı ve yenileme tokenını alın
$accessToken = $responses['access_token'];


$data = array(
  'GtmAccess_token' => $accessToken
);
$response = $db->UpdateByObjectId("Settings","64c64788ffc21632bef8fab5", $data);

// Erişim tokenı ve yenileme tokenını saklayabilirsiniz.
// Artık bu erişim tokenını kullanarak Google Tag Manager API'sine erişebilirsiniz.

?>
