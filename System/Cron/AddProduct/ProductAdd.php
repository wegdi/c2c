<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

$Supplier = $db->Query('Supplier', ["Status" => 1], [], 'TEK');


?>
