<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();

$api_url = 'http://www.katfarlaryedekparca.com/oauth/v2/token';

$data = array(
    'grant_type' => 'refresh_token',
    'client_id' => '1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8',
    'client_secret' => '3lhhwkqmlc6cow88wgwwkwcc8k00gwsw8k8osg00084ossc4wo',
    'refresh_token' => 'NTdiMTU5ZjU4ZTNlMTZmM2E1MjQ2ZjRhNDkzNjg0MGM1ZGM3OTgyMDQ3OGM1NjE1ZmIxNDcwNDFkMThiYjYzZA'
);

$ch = curl_init($api_url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Curl Hatası: ' . curl_error($ch);
}

curl_close($ch);

// Cevabı kullanabilirsiniz
echo $response;

?>
