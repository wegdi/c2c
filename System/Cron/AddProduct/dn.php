<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();
echo rand();

function Parcala($value = '')
{
    if (strpos($value, ';') !== false) {
        $parcala = explode(';', $value);
        array_shift($parcala);
        return $parcala;
    } else {
        return [$value];
    }
}

$allProducts = []; // Tüm ürünleri depolamak için dizi

$suppliers = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($suppliers as $supplier) {
    $jsonData = file_get_contents(URL . $supplier["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);
    $explode = explode(';', $supplier["star"]);

    $keys = [
        "product_name", "product_description", "product_meta_description", "product_meta_keyword",
        "model", "sku", "quantity", "main_image", "image_1", "image_2", "image_3", "image_4", "image_5",
        "image_6", "image_7", "image_8", "image_9", "image_10", "manufacturer_name", "price",
        "product_option_price", "product_option_quantity", "product_option_name", "product_option_value",
        "product_attribute_group", "product_attribute_name", "product_attribute_value", "kdv"
    ];

    if (isset($decodedData[$explode[0]])) {
        $dataToIterate = count($explode) == 1 ? [$decodedData[$explode[0]]] : $decodedData[$explode[0]];

        foreach ($dataToIterate as $value) {
            foreach ($value as $keyUrun => $valueUrun) {
                $Urunler = [];

                foreach ($keys as $field) {
                    $fieldArray = Parcala($supplier[$field]);

                    if (count($fieldArray) == 1 && isset($valueUrun[$fieldArray[0]])) {
                        $Urunler[$field] = $valueUrun[$fieldArray[0]];
                    } elseif (count($fieldArray) == 2) {
                        $fieldValue = isset($valueUrun[$fieldArray[0]]) ? $valueUrun[$fieldArray[0]] : '';

                        if (is_array($fieldValue) && isset($fieldValue[0])) {
                            $Urunler[$field] = current($fieldValue);
                        } else {
                            $Urunler[$field] = $fieldValue;
                        }
                    } else {
                        $Urunler[$field] = '';
                    }
                }

                $allProducts[] = $Urunler; // Ürünü diziye ekle
            }
        }
    }
}

print_r($allProducts);
/*
// $allProducts'ı JSON'a dönüştür
$jsonAllProducts = json_encode($allProducts, JSON_UNESCAPED_UNICODE);

// Zaman damgasına dayalı benzersiz bir dosya adı oluştur
$filename = SYSTEM . 'Product/Json/all_products.json';

// JSON verisini dosyaya kaydet (varolan dosyayı üzerine yazar)
file_put_contents($filename, $jsonAllProducts);

// İhtiyaç duyarsanız $allProducts'ı yazdırabilir veya başka bir şey yapabilirsiniz
print_r($allProducts);
*/
?>
