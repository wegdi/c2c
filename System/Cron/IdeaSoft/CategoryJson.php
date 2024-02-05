<?php
header('Content-Type: application/json; charset=utf-8');

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

header('Content-Type: application/json; charset=utf-8');

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$filtre = [];

// Sanitize the search term
$searchTerm = $_GET["search"];
$searchTerm = preg_quote($searchTerm, '/');
$searchTerm = htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8');

if (ctype_digit($searchTerm)) {
    $filtre["IdeaSoftId"] = (int)$searchTerm;
} else {
    // Using a case-insensitive regex for the "Name" field
    $filtre["Name"] = new MongoDB\BSON\Regex($searchTerm, 'i');
}

$Category = $db->Query('Category', $filtre, [], 'COK');

$CategoryJson = [];

foreach ($Category as $key => $value) {
    unset($value['_id']);
    $CategoryJson[] = $value;
}

echo json_encode($CategoryJson);

?>
