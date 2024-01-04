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

// Veritabanına kaydedilecek anahtarlar dizisi
$databaseKeys = [];

// Fonksiyonu çağır ve veritabanı anahtarlarını al
getDatabaseKeys($data);

// Veritabanına kaydedilecek anahtarları yazdır
print_r($databaseKeys);

// Veritabanına kaydedilecek anahtarları almak için fonksiyon
function getDatabaseKeys($veri, $parentKey = null) {
    global $databaseKeys;

    foreach ($veri as $anahtar => $deger) {
        $currentKey = ($parentKey) ? $parentKey . ' -> ' . $anahtar : $anahtar;
        $databaseKeys[] = $currentKey;

        if (is_array($deger)) {
            getDatabaseKeys($deger, $currentKey);
        }
    }
}
?>
