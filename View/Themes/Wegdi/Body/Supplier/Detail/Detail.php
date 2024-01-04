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
    echo "<table id='example' class='display' style='width:100%'>";
    echo "<thead><tr><th>Key</th><th>Value</th></tr></thead>";
    echo "<tbody>";
    foreach ($veri as $anahtar => $deger) {
        $anahtarString = is_string($anahtar) ? $anahtar : json_encode($anahtar);

        if (is_array($deger)) {
            printDiziIcerigi($deger, $indent + 1);
        } else {
            echo "<tr>";
            echo "<td>" . $anahtarString . "</td>";
            echo "<td>" . $deger . "</td>";
            echo "</tr>";
        }
    }
    echo "</tbody>";
    echo "</table>";

    echo "
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js'></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>";
}
?>
