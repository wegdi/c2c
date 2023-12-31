<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();


$data = array(
    'Name' => $db->Guvenlik($_POST["Name"]),
    'Access' => $_POST["Access"]
);
$response = $db->UpdateByObjectId("Authority", $security->Decrypt($_POST["oid"],"4"), $data);
echo $response;


?>
