<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

$jsonUrl = $db->Query('Supplier',["SupplierCode" => (string)$param2], [], 'TEK');

// JSON dosyasının URL'si
//$jsonUrl = 'https://c2c.wegdi.com/Json/65968becd3425.json';

// JSON verisini alma
$jsonData = file_get_contents("https://c2c.wegdi.com".$jsonUrl["SupplierFilePath"]);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($jsonData, true);

$donguler = [];
$final = [];
// Üst anahtarları yazdırma
foreach ($data as $ustAnahtar => $altDizi) {
    // Üst anahtarı string olarak almak istiyorsak
    $ustAnahtarString = is_string($ustAnahtar) ? $ustAnahtar : json_encode($ustAnahtar);
    $donguler[] = $ustAnahtarString;
    // Alt diziyi yazdırma
    foreach ($altDizi as $altAnahtar => $deger) {
        // Alt anahtarı sadece int değilse yazdır
        if (!is_int($altAnahtar)) {
            // Alt anahtarı string olarak almak istiyorsak
            $altAnahtarString = is_string($altAnahtar) ? $altAnahtar : json_encode($altAnahtar);
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

$tableHtml = '
<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-header">
              <h5 class="card-title mb-0">Xml Eşleştirme Tablosu</h5>
          </div>
          <div class="card-body">
<table class="display table table-bordered dt-responsive">';
$tableHtml .= "<tr><th>Anahtar</th><th>Değer</th><th>Eşleştir</th></tr>";

// DataTable içeriğini oluştur
$say=0;
foreach ($databaseKeys as $item) {
  $tag = $ustAnahtarString . '->' . $item['anahtar'];
$tag = str_replace(["->", ' '], [';', ''], $tag);

    $tableHtml .= "<tr>";
    $tableHtml .= "<td>" .$ustAnahtarString.' -> '. $item['anahtar'] . "</td>";
    $tableHtml .= "<td>";

    // Değer bir dizi içeriyorsa satır satır yazdır
    if (is_array($item['deger'])) {

    } else {
        $tableHtml .= $item['deger'];
    }

    $tableHtml .= "</td>";
    $tableHtml .= '<td>




  <div class="input-group">
  <label class="input-group-text" for="inputGroupSelect01">Eşleştir</label>
   <select class="form-select"  id="secler'.$say.'" name="tag['.$tag.']"  data-name="stokkod" onchange="changeJsonContent("secler'.$say.'");">
       <option value="-">- pas geç -</option>
       <option value="product_name">Ürün Adı</option>
       <option value="product_description">Açıklama </option>
       <option value="product_meta_description">Meta description </option>
       <option value="product_meta_keyword">Meta keyword </option>
       <option value="model">Ürün Kodu</option>
       <option value="sku">SKU</option>
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
       <option value="manufacturer_name">Marka</option>
       <option value="price">Fiyat</option>
       <option value="product_option_price">Seçenek Fiyatı</option>
       <option value="product_option_quantity">Seçenek Stok</option>
       <option value="product_option_name[1]">Seçenek Adı (tr-tr)</option>
       <option value="product_option_value[1]">Seçenek Değeri (tr-tr)</option>
       <option value="product_attribute_group[1]">Özellik Grubu (tr-tr)</option>
       <option value="product_attribute_name[1]">Özellik Adı (tr-tr)</option>
       <option value="product_attribute_value[1]">Özellik Değer (tr-tr)</option>
   </select>
   <input type="hidden" name="tag" class="tag" value="'.$tag.'">

</div>

    </td>';
    $tableHtml .= "</tr>";
    $say++;
}

$tableHtml .= '</table>  </div>
</div>
</div><!--end col-->
</div><!--end row-->

';

// Dışarıda kullanılacak HTML
echo $tableHtml;


?>
