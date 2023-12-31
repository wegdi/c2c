<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();


$GeoIP = $db->Query('GeoIP',['Xm' =>'0'], [], 'TEK');
$data = array(
    'Country' => $_POST["countryList"]
);
$response = $db->UpdateByObjectId("GeoIP",$GeoIP["_id"],$data);
echo $response;
?>
