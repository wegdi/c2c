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

$donguler = [];

// Üst anahtarları yazdırma
foreach ($data as $ustAnahtar => $altDizi) {
    // Üst anahtarı string olarak almak istiyorsak
    $ustAnahtarString = is_string($ustAnahtar) ? $ustAnahtar : json_encode($ustAnahtar);

    echo "Üst Anahtar: " . $ustAnahtarString . "<br>";
    $donguler[] = $ustAnahtarString;

    // Alt diziyi yazdırma
    foreach ($altDizi as $altAnahtar => $deger) {
        // Alt anahtarı sadece int değilse yazdır
        if (!is_int($altAnahtar)) {
            // Alt anahtarı string olarak almak istiyorsak
            $altAnahtarString = is_string($altAnahtar) ? $altAnahtar : json_encode($altAnahtar);

            echo "    Alt Anahtar: " . $altAnahtarString . "<br>";
            $donguler[] = $altAnahtarString;
        }
    }

    echo "<br>";
}


// Alt anahtarları yazdırma
foreach ($donguler as $anahtar) {
    if (isset($data[$anahtar])) {
        print_r($data[$anahtar]);
    }
}
?>
