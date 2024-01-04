<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

// JSON dosyasının URL'si
$jsonUrl = 'https://c2c.wegdi.com/Json/65968ec9c3a67.json';

// JSON verisini alma
$jsonData = file_get_contents($jsonUrl);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($jsonData, true);

// İlk anahtarın adını al
$ilkAnahtarAdi = null;

if (!empty($data) && is_array($data)) {
    reset($data); // Diziyi sıfırla (başa konumlandır)
    $ilkAnahtarAdi = key($data); // İlk anahtarın adını al
}

// İlk anahtarın adını ekrana yazdırma
echo "İlk Anahtar: " . $ilkAnahtarAdi;
?>
