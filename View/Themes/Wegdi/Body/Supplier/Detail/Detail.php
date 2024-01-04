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

// Fonksiyonu çağırarak içeriği yazdırma
printDiziIcerigi($data);

// Fonksiyonun tanımı
function printDiziIcerigi($veri, $indent = 0) {
    foreach ($veri as $anahtar => $deger) {
        $anahtarString = is_string($anahtar) ? $anahtar : json_encode($anahtar);
        echo str_repeat("&nbsp;", $indent * 4) . "Anahtar: " . $anahtarString . "<br>";

        if (is_array($deger)) {
            printDiziIcerigi($deger, $indent + 1);
        } else {
            echo str_repeat("&nbsp;", ($indent + 1) * 4) . "Değer: " . $deger . "<br>";
        }
    }
}


?>
