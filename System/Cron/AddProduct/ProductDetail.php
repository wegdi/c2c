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

$suppliers = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($suppliers as $supplier) {
    $jsonData = file_get_contents(URL . $supplier["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);
    $explode = explode(';', $supplier["star"]);

    if (count($explode) == 1 and isset($decodedData[$explode[0]])) {
        foreach ($decodedData[$explode[0]] as $keyUrun => $valueUrun) {
            $Urunler = [];

            $productFields = [
                "product_name", "product_description", "product_meta_description", "product_meta_keyword",
                "model", "sku", "quantity", "main_image", "image_1", "image_2", "image_3", "image_4", "image_5",
                "image_6", "image_7", "image_8", "image_9", "image_10", "manufacturer_name", "price",
                "product_option_price", "product_option_quantity", "product_option_name", "product_option_value",
                "product_attribute_group", "product_attribute_name", "product_attribute_value", "kdv"
            ];

            foreach ($productFields as $field) {
                $fieldArray = Parcala($supplier[$field]);

                if (count($fieldArray) == 1) {
                    $Urunler[$field] = $valueUrun[$fieldArray[0]];
                } elseif (count($fieldArray) == 2) {
                    $Urunler[$field] = current($valueUrun[$fieldArray[0]]);
                }
            }

            print_r($Urunler);
        }
    } elseif (count($explode) == 2 and isset($decodedData[$explode[0]])) {

        foreach ($decodedData[$explode[0]] as $key => $valueXbir) {
          foreach ($valueXbir as $valueUrunIC) {

              $Urunler = [];

              $productFields = [
                  "product_name", "product_description", "product_meta_description", "product_meta_keyword",
                  "model", "sku", "quantity", "main_image", "image_1", "image_2", "image_3", "image_4", "image_5",
                  "image_6", "image_7", "image_8", "image_9", "image_10", "manufacturer_name", "price",
                  "product_option_price", "product_option_quantity", "product_option_name", "product_option_value",
                  "product_attribute_group", "product_attribute_name", "product_attribute_value", "kdv"
              ];

              foreach ($productFields as $field) {
                  $fieldArray = Parcala($supplier[$field]);

                  if (count($fieldArray) == 1) {
                      $Urunler[$field] = $valueUrunIC[$fieldArray[0]];
                  }elseif (count($fieldArray) == 2) {
                      $Urunler[$field] = current($valueBirAlt[$fieldArray[0]]);
                  }
                  elseif (count($fieldArray) == 3) {
                      foreach ($valueUrunIC[$fieldArray[0]] as $valueBirAlt) {
                          $Urunler[$field] = $valueBirAlt[end($fieldArray)];
                      }
                  }
              }

              print_r($Urunler);
          }
        }

    }
}
?>
