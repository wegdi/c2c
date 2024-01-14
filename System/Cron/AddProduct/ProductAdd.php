<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

$SupplierCode=$_GET["SupplierCode"];
$Supplier = $db->Query('Supplier', ["Status" => 1,"SupplierCode" => $SupplierCode], [], 'TEK');


?>
