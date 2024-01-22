<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();

$token_url = "https://www.katfarlaryedekparca.com/oauth/v2/token";
$grant_type = "authorization_code";
$client_id = "1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8";
$client_secret = "3lhhwkqmlc6cow88wgwwkwcc8k00gwsw8k8osg00084ossc4wo";
$code = "Q0ODMI2OGYjMjBkN2mJmYzNkOTE4gzMGRhZDZTcykyOGQ3M2M2YTU2ZGVlMzE2MzB2MYkc5NWzE0ZWNiYjI2MA";
$redirect_uri = "https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php";

$full_url = $token_url . "?grant_type=" . $grant_type . "&client_id=" . $client_id . "&client_secret=" . $client_secret . "&code=" . $code . "&redirect_uri=" . urlencode($redirect_uri);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $full_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 0);

$response = curl_exec($ch);

curl_close($ch);

echo $response;

?>
