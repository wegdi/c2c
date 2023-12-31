<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();

header('Content-Type: application/json');

$Token=$_POST["token"];

$UserControl = $db->Query('Users',['mobiltoken' => (string)$Token], [], 'TEK');

if ($UserControl["_id"]=="") {
  $response = array('status' => false );

}else {
  $response = array('status' => true );

}
echo json_encode($response);

?>
