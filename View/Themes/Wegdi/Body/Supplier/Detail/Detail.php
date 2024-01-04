<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

// JSON dosyasının URL'si
$jsonUrl = 'https://c2c.wegdi.com/Json/65968acc2a290.json';

// JSON verisini alma
$jsonData = file_get_contents($jsonUrl);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($jsonData, true);

// Üst ve Alt anahtarları saklamak için dizi oluştur
$anahtarlar = array();

// Üst anahtarları ve Alt diziyi birleştirme
foreach ($data as $ustAnahtar => $altDizi) {
    $anahtarlar[] = array(
        'ustAnahtar' => is_string($ustAnahtar) ? $ustAnahtar : json_encode($ustAnahtar),
        'altAnahtarlar' => array_map(function ($altAnahtar) {
            return is_string($altAnahtar) ? $altAnahtar : json_encode($altAnahtar);
        }, array_keys($altDizi))
    );
}

// Oluşturulan diziyi ekrana yazdırma
print_r($anahtarlar);
?>
