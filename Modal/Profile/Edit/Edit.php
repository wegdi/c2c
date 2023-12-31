<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

$data = array(
  'Password' => $db->Guvenlik(md5($_POST["Password"]))
);

$response = $db->UpdateByObjectId("Users",$db->ObjectId($db->GetUser('_id')), $data);
echo $response;

?>
