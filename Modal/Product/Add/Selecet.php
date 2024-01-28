<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();


$data = array('CategoryId' => (int)$_POST["selectedValue"] );
echo $db->UpdateByObjectId("Products",(string)$key, $data);
 ?>
