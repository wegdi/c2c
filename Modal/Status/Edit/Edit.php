<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();


$data = array(
    'StatusName' => $db->Guvenlik($_POST["StatusName"]),
    'Icon' => $db->Guvenlik($_POST["Icon"]),
    'Color' => $db->Guvenlik($_POST["Color"])

);

$response = $db->UpdateByObjectId("Status", $security->Decrypt($_POST["oid"], "4"), $data);
echo $response;
?>
