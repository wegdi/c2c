<?php
header('Content-Type: application/json; charset=utf-8');

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$filtre=[];
if (ctype_digit($_GET["search"])) {
  $filtre["IdeaSoftId"]= (int)$_GET["search"];
}else {
  $filtre["Name"]= (string)$_GET["Name"];
}

$Category = $db->Query('Category',$filtre, [], 'COK');
$CategoryJson = [];

foreach ($Category as $key => $value) {
    unset($value['_id']);
    $CategoryJson[] = $value;
}

echo json_encode($CategoryJson);


?>
