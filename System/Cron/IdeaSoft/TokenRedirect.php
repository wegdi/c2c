<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();


$state=$_GET["state"];
$code=$_GET["code"];
$domain=$_GET["domain"];



$Response = array(
  'state' => $state,
  'code' => $code,
  'domain' => $domain,
  'client_id' => '1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8',
  'response_type' => 'code',
  'state' => '3lhhwkqmlc6cow88wgwwkwcc8k00gwsw8k8osg00084ossc4wo',
  'redirect_uri' => 'https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php'
);

$db->UpdateByObjectId("IdeaSoft","65a784f66b188048239f446c", $Response);
