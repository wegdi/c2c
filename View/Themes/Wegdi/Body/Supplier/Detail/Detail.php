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

if (count($donguler) == 1) {
    $ilkDizi = reset($data["$donguler[0]"]);
} elseif (count($donguler) == 2) {
    $ilkDizi = reset($data["$donguler[0]"]["$donguler[1]"]);
} elseif (count($donguler) == 3) {
    $ilkDizi = reset($data["$donguler[0]"]["$donguler[1]"]["$donguler[2]"]);
} elseif (count($donguler) == 4) {
    $ilkDizi = reset($data["$donguler[0]"]["$donguler[1]"]["$donguler[2]"]["$donguler[3]"]);
}

// HTML tablosu oluşturan fonksiyonu çağır
printDiziIcerigi($ilkDizi);

// HTML tablosu oluşturan fonksiyon
function printDiziIcerigi($veri, $indent = 0) {
    echo "<table border='1'>";
    foreach ($veri as $anahtar => $deger) {
        $anahtarString = is_string($anahtar) ? $anahtar : json_encode($anahtar);
        echo "<tr>";
        echo "<td>" . str_repeat("&nbsp;", $indent * 4) . "Anahtar: " . $anahtarString . "</td>";

        if (is_array($deger)) {
            echo "<td>";
            printDiziIcerigi($deger, $indent + 1);
            echo "</td>";
        } else {
            echo "<td>" . str_repeat("&nbsp;", ($indent + 1) * 4) . "Değer: " . $deger . "</td>";
        }

        echo "</tr>";
    }
    echo "</table>";
}
?>
