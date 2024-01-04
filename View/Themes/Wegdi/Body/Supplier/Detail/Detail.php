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

// Tüm key'leri toplamak için kullanılacak dizi
$tumKeyler = [];

// Key'leri toplama fonksiyonu
function toplaKeyler($veri, &$keyler) {
    foreach ($veri as $key => $value) {
        $keyler[] = $key;
        if (is_array($value)) {
            toplaKeyler($value, $keyler);
        }
    }
}

// Üst anahtarları yazdırma ve key'leri toplama
foreach ($data as $ustAnahtar => $altDizi) {
    // Üst anahtarı string olarak almak istiyorsak
    $ustAnahtarString = is_string($ustAnahtar) ? $ustAnahtar : json_encode($ustAnahtar);

    echo "Üst Anahtar: " . $ustAnahtarString . "<br>";
    $tumKeyler[] = $ustAnahtarString;

    // Alt diziyi yazdırma ve key'leri toplama
    toplaKeyler($altDizi, $tumKeyler);

    echo "<br>";
}

// Tüm key'leri ekrana yazdırma
echo "Tüm Key'ler: <br>";
foreach ($tumKeyler as $key) {
    echo $key . "<br>";
}
?>
