<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();


$auth_url = "http://www.katfarlaryedekparca.com/panel/auth";
$client_id = "1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8";
$response_type = "code";
$state = "3lhhwkqmlc6cow88wgwwkwcc8k00gwsw8k8osg00084ossc4wo";
$redirect_uri = "https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php";

$full_url = $auth_url . "?client_id=" . $client_id . "&response_type=" . $response_type . "&state=" . $state . "&redirect_uri=" . urlencode($redirect_uri);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $full_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

curl_close($ch);

echo $response;

?>