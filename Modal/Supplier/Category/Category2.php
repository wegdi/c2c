<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();

$Marka = $_POST["Marka"];
$CategoryList = $db->Query('CategoryList', ['CategoryOne' => $Marka], [], 'COK');

// Tekrarlanan değerleri kaldırmak için array_unique() fonksiyonunu kullanıyoruz
$List = array_unique(array_column($CategoryList, 'CategoryTwo'));

echo json_encode($List);
?>
