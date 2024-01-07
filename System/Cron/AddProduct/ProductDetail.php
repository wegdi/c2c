<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();

$Supplier = $db->Query('Supplier',["SupplierCode" => (string)$param2], [], 'TEK');


 ?>
