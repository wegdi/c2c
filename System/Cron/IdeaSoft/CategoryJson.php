<?php
header('Content-Type: application/json; charset=utf-8');

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$Category = $db->Query('Category',[], [], 'COK');

foreach ($Category as $key => $value) {
    unset('_id');
   print_R($value);
}
?>
