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

// HTML tabloyu başlat
echo '
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Xml Eşleştirme</h5>
            </div>
            <div class="card-body">
                <table id="MetaTablse" class="display table table-bordered dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Anahtar</th>
                            <th>Değer</th>
                            <th>Eşleştirme</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td>'.$ustAnahtarString.'</td>
                      <td></td>
                        <td></td>
                    </tr>

';

// HTML tablo içeriğini oluşturan fonksiyonu çağır
printDiziIcerigi($ilkDizi);

// HTML tabloyu kapat
echo '
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->
';


function printDiziIcerigi($veri, $parentKey = null, $indent = 0) {
    foreach ($veri as $anahtar => $deger) {
        $anahtarString = is_string($anahtar) ? $anahtar : json_encode($anahtar);
        echo "<tr>";

        $alt = '';

        if (is_array($deger)) {
            foreach ($deger as $key => $value) {
                if (!is_numeric($key)) {
                    $alt .= ' -> ' . $key;
                }
            }
        }

        // Indentation for hierarchical display
        $indentation = str_repeat("&nbsp;", $indent * 4);

        echo "<td>" . $indentation . $parentKey . " -> " . $anahtarString . $alt . "</td>";

        if (is_array($deger)) {
            echo "<td>";
            printDiziIcerigi($deger, $anahtarString, $indent + 1);
            echo "</td>";
        } else {
            echo "<td>" . $deger . "</td>";
        }

        echo '<td>

        <div class="tag_content">
    Nereye:
    <select name="tag[root;item;stokkod]" onchange="changeXMLContent();" data-name="stokkod" data-value="3700696800027">
        <option value="-">- pas geç -</option>
        <!-- Add more options as needed -->
    </select>
    <input type="hidden" name="tag_cache[3][tag_name]" value="stokkod">
    <input type="hidden" name="tag_cache[3][tag_content]" value="3700696800027">
    <input type="hidden" name="tag_cache[3][tag_key]" value="root;item;stokkod">
    <input type="hidden" name="tag_cache[3][level]" value="'.($indent + 2).'">
</div>

        </td>';
        echo "</tr>";
    }
}
?>
