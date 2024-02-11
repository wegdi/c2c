<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();

$Marka = $_POST["Marka"];
$uniqueCategories = []; // Benzersiz kategorileri saklamak için bir dizi oluşturuyoruz
$CategoryList = $db->Query('CategoryList', ['CategoryOne' => $Marka], [], 'COK');

foreach ($CategoryList as $key => $value) {
    // Her bir kategori değerini diziye eklerken, aynı zamanda benzersiz olup olmadığını kontrol ediyoruz
    if (!in_array($value["CategoryTwo"], $uniqueCategories)) {
        $uniqueCategories[] = $value["CategoryTwo"]; // Kategoriyi benzersiz dizisine ekliyoruz
    }
}

// Benzersiz kategori değerlerini A'dan Z'ye doğru sıralıyoruz
sort($uniqueCategories);

echo json_encode($uniqueCategories);
?>
