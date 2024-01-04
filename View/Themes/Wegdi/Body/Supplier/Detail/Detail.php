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

// Üst anahtarları yazdırma
foreach ($data as $ustAnahtar => $altDizi) {
    echo "Üst Anahtar: " . $ustAnahtar . "<br>";

    // Alt diziyi yazdırma
    foreach ($altDizi as $altAnahtar => $deger) {
        echo "    Alt Anahtar: " . $altAnahtar . "<br>";
    }

    echo "<br>";
}
?>
