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
    'client_id' => '1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8',
    'client_secret' => '3lhhwkqmlc6cow88wgwwkwcc8k00gwsw8k8osg00084ossc4wo',
    'code' => $code,
    'redirect_uri' => 'https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php'
);

// Parametreleri URL'ye çevir
$queryString = http_build_query($params);

// Hedef URL'yi belirle
$targetUrl = 'https://www.katfarlaryedekparca.com/oauth/v2/token?' . $queryString;

// Diğer sayfadaki JSON verilerini çek
$responseJson = file_get_contents($targetUrl);

// JSON verilerini diziye çevir
$responseArray = json_decode($responseJson, true);

$Response = array(
    'state' => $state,
    'code' => $code,
    'domain' => $domain,
    'client_id' => '1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8',
    'response_type' => 'code',
    'state' => '3lhhwkqmlc6cow88wgwwkwcc8k00gwsw8k8osg00084ossc4wo',
    'redirect_uri' => 'https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php'
);



$db->UpdateByObjectId("IdeaSoft", "65a784f66b188048239f446c", array_merge($Response,$responseArray));
