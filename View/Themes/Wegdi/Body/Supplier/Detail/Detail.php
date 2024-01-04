<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

// JSON dosyasının URL'si
$jsonUrl = 'https://c2c.wegdi.com/Json/659694796d1cf.json';

// JSON verisini alma
$jsonData = file_get_contents($jsonUrl);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($jsonData, true);

// İlk elemanı al
$ilkEleman = null;

if (!empty($data) && is_array($data)) {
    reset($data); // Diziyi sıfırla (başa konumlandır)
    $ilkEleman = current($data); // İlk elemanı al
}

// PHP dizisini ekrana yazdırma
print_r($ilkEleman);
?>
