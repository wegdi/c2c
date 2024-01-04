<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

// JSON dosyasının URL'si
$jsonUrl = 'https://c2c.wegdi.com/Json/659687e783c65.json';

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


if ($altAnahtarString) {
  $yaz='
  <tr>
  <td></td>
    <td></td>

  <td>'.$altAnahtarString.'</td></tr>';
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

                    '.$yaz.'



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

// HTML tablo içeriğini oluşturan fonksiyon
function printDiziIcerigi($veri, $parentKey = null) {
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


        echo "<td>" . $anahtarString .   $alt. "</td>";

        if (is_array($deger)) {
            echo "<td>";

            foreach ($deger as $key => $value) {
              echo $key;echo "<br>";
                echo $value;
            }
            //printDiziIcerigi($deger, $anahtarString);
            echo "</td>";
        } else {
            echo "<td>" . $deger . "</td>";
        }
        //  echo "<td>" . $deger . "</td>";
        echo '<td>

        <div class="tag_content">
    Nereye:
    <select name="tag[root;item;stokkod]" onchange="changeXMLContent();" data-name="stokkod" data-value="3700696800027">
        <option value="-">- pas geç -</option>
        <option value="product_id">Ürün ID</option>
        <option value="product_name[1]">Ürün Adı (tr-tr)</option>
        <option value="product_description[1]">Açıklama (tr-tr)</option>
        <option value="product_meta_description[1]">Meta description (tr-tr)</option>
        <option value="product_meta_keyword[1]">Meta keyword (tr-tr)</option>
        <option value="product_tag[1]">XML Ürün Etiketi (tr-tr)</option>
        <option value="model">Ürün Kodu</option>
        <option value="sku">SKU</option>
        <option value="upc">UPC</option>
        <option value="ean">EAN</option>
        <option value="jan">JAN</option>
        <option value="isbn">ISBN</option>
        <option value="mpn">MPN</option>
        <option value="quantity">Stok</option>
        <option value="main_image">Ana Resim</option>
        <option value="image_1">Ürün resmi 1</option>
        <option value="image_2">Ürün resmi 2</option>
        <option value="image_3">Ürün resmi 3</option>
        <option value="image_4">Ürün resmi 4</option>
        <option value="image_5">Ürün resmi 5</option>
        <option value="image_6">Ürün resmi 6</option>
        <option value="image_7">Ürün resmi 7</option>
        <option value="image_8">Ürün resmi 8</option>
        <option value="image_9">Ürün resmi 9</option>
        <option value="image_10">Ürün resmi 10</option>
        <option value="product_category_name_1[1]">Kategori Adı 1 (tr-tr)</option>
        <option value="product_category_name_2[1]">Kategori Adı 2 (tr-tr)</option>
        <option value="product_category_name_3[1]">Kategori Adı 3 (tr-tr)</option>
        <option value="product_category_name_4[1]">Kategori Adı 4 (tr-tr)</option>
        <option value="product_category_name_5[1]">Kategori Adı 5 (tr-tr)</option>
        <option value="product_category_name_6[1]">Kategori Adı 6 (tr-tr)</option>
        <option value="manufacturer_name">Marka</option>
        <option value="price">Fiyat</option>
        <option value="special">Kampanya fiyatı</option>
        <option value="weight">Ağırlık</option>
        <option value="length">Uzunluk</option>
        <option value="width">Genişlik</option>
        <option value="height">Yükseklik</option>
        <option value="minimum">Minimum Sipariş</option>
        <option value="product_option_price">Seçenek Fiyatı</option>
        <option value="product_option_quantity">Seçenek Stok</option>
        <option value="product_option_name[1]">Seçenek Adı (tr-tr)</option>
        <option value="product_option_value[1]">Seçenek Değeri (tr-tr)</option>
        <option value="product_attribute_group[1]">Özellik Grubu (tr-tr)</option>
        <option value="product_attribute_name[1]">Özellik Adı (tr-tr)</option>
        <option value="product_attribute_value[1]">Özellik Değer (tr-tr)</option>
    </select>
    <input type="hidden" name="tag_cache[3][tag_name]" value="stokkod">
    <input type="hidden" name="tag_cache[3][tag_content]" value="3700696800027">
    <input type="hidden" name="tag_cache[3][tag_key]" value="root;item;stokkod">
    <input type="hidden" name="tag_cache[3][level]" value="2">
</div>

        </td>';
        echo "</tr>";
    }
}
?>
