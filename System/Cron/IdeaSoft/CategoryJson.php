<?php
header('Content-Type: application/json; charset=utf-8');

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$IdeaSoftCategory = $db->Query('Category',[], [], 'COK');

echo $IdeaSoftCategory;

?>
