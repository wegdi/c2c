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

);

$db->UpdateByObjectId("IdeaSoft","65a784f66b188048239f446c", $Response);
