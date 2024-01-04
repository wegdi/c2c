<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
/*
// JSON dosyasının URL'si
$jsonUrl = 'https://c2c.wegdi.com/Json/65968ec9c3a67.json';

// JSON verisini alma
$jsonData = file_get_contents($jsonUrl);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($jsonData, true);

$donguler = [];
$final = [];
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


if (count($donguler)==1) {

  $ilkDizi = reset($data["$donguler[0]"]);
  foreach ($ilkDizi as $keyx => $valuex) {
    echo $keyx.' -- ';
    echo "<br>";
  }

}elseif (count($donguler)==2) {

$ilkDizi = reset($data["$donguler[0]"]["$donguler[1]"]);
foreach ($ilkDizi as $keyx => $valuex) {
  echo $keyx.' -- ';
  echo "<br>";
}
}elseif (count($donguler)==3) {
$ilkDizi = reset($data["$donguler[0]"]["$donguler[1]"]["$donguler[2]"]);
foreach ($ilkDizi as $keyx => $valuex) {
  echo $keyx.' -- ';
}
}elseif (count($donguler)==4) {
$ilkDizi = reset($data["$donguler[0]"]["$donguler[1]"]["$donguler[2]"]["$donguler[3]"]);
foreach ($ilkDizi as $keyx => $valuex) {
  echo $keyx.' -- ';
}
}
*/
$jsonUrl = 'https://c2c.wegdi.com/Json/65968ec9c3a67.json';

// JSON verisini alma
$jsonData = file_get_contents($jsonUrl);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($jsonData, true);

// Tüm key'leri toplamak için kullanılacak dizi
$tumKeyler = [];

// Key'leri toplama fonksiyonu
function toplaKeyler($veri, &$keyler, $depth = 0, $maxDepth = 3) {
    if ($depth > $maxDepth) {
        return;
    }

    foreach ($veri as $key => $value) {
        $keyler[] = $key;
        if (is_array($value)) {
            toplaKeyler($value, $keyler, $depth + 1, $maxDepth);
        }
    }
}

// Üst anahtarları yazdırma ve key'leri toplama
foreach ($data as $ustAnahtar => $altDizi) {
    // Üst anahtarı string olarak almak istiyorsak
    $ustAnahtarString = is_string($ustAnahtar) ? $ustAnahtar : json_encode($ustAnahtar);

    // Sayısal değer içeren key'leri kontrol et
    $tumKeyler[] = $ustAnahtarString;

    // Alt diziyi yazdırma ve key'leri toplama (en fazla 3 alt diziye kadar)
    toplaKeyler($altDizi, $tumKeyler, 1, 3);

    echo "<br>";
}

// Tekrar edenleri kaldır
$tumKeyler = array_unique($tumKeyler);
print_r($tumKeyler);
?>
