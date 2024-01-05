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

$databaseKeys = [];

// Fonksiyonu çağır ve veritabanı anahtarlarını al
getDatabaseKeys($ilkDizi);

// Veritabanına kaydedilecek anahtarları yazdır
echo "<pre>";
print_r($databaseKeys);
echo "</pre>";

// Veritabanına kaydedilecek anahtarları almak için fonksiyon
function getDatabaseKeys($veri, $parentKey = null) {
    global $databaseKeys;

    foreach ($veri as $anahtar => $deger) {
        $currentKey = ($parentKey) ? $parentKey . ' -> ' . $anahtar : $anahtar;
        $databaseKeys[] = array('anahtar' => $currentKey, 'deger' => $deger);

        if (is_array($deger)) {
            getDatabaseKeys($deger, $currentKey);
        }
    }
}

$tableHtml = '<table class="display table table-bordered dt-responsive">';
$tableHtml .= "<tr><th>Anahtar</th><th>Değer</th><th>Eşleştir</th></tr>";

// DataTable içeriğini oluştur
foreach ($databaseKeys as $item) {
    $tableHtml .= "<tr>";
    $tableHtml .= "<td>" . $item['anahtar'] . "</td>";
    $tableHtml .= "<td>";

    // Değer bir dizi içeriyorsa satır satır yazdır
    if (is_array($item['deger'])) {
        foreach ($item['deger'] as $subValue) {
            $tableHtml .= $subValue . "<br>";

            // Eğer alt değerler de dizi içeriyorsa, onları da satır satır yazdır
            if (is_array($subValue)) {
                foreach ($subValue as $nestedValue) {
                    $tableHtml .= $nestedValue . "<br>";
                }
            }
        }
    } else {
        $tableHtml .= $item['deger'];
    }

    $tableHtml .= "</td>";
    $tableHtml .= "<td>Eşleştir</td>";
    $tableHtml .= "</tr>";
}

$tableHtml .= "</table>";

// Dışarıda kullanılacak HTML
echo $tableHtml;


?>
