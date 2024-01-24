<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();
$IdeaSoftCategory = $db->Query('IdeaSoftCategory', [], [], 'COK');

$categories = [];

// Ana kategorileri bul
foreach ($IdeaSoftCategory as $key => $value) {
    if ($value['GroupId'] == 0) {
        $categories[] = [
            'Name' => $value['Name'],
            'Slug' => $value['Slug'],
        ];
    }
}

// JSON çıktısını ekrana yazdır
echo json_encode($categories, JSON_PRETTY_PRINT);


?>
