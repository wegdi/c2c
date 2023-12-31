<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();

$arrayName = array('GtmCode' => $_GET["code"] );
$response = $db->UpdateByObjectId("Settings","64c64788ffc21632bef8fab5", $arrayName);

if ($response) {
  $http="https://ads.akillipanda.com/System/Cron/GTM/Access.php";
  header('Location: ' . $http);

}
 ?>
