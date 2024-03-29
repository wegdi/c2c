<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();

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
    $filePath = $_SERVER['DOCUMENT_ROOT'] . $supplier["SupplierFilePath"];
    $jsonData = file_get_contents($filePath);
    $decodedData = json_decode($jsonData, true);
    $explode = explode(';', $supplier["star"]);

    if (count($explode) == 1 and isset($decodedData[$explode[0]])) {

      $Total=count($decodedData[$explode[0]]);

      $datax = array(
        'Total' =>  $Total,
        'Loop' =>  ceil($Total/TOTAL)

        );
      $db->UpdateByObjectId("Supplier",(string)$supplier["_id"], $datax);

      $itemsPerPage = TOTAL; // Her sayfada kaç öğe gösterileceğini belirtin
      $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1; // Sayfa numarasını alın

      $startIndex = ($page - 1) * $itemsPerPage;

      $output = array_slice($decodedData[$explode[0]], $startIndex, $itemsPerPage);

        foreach ($output as $keyUrun => $valueUrun) {
            $Urunler = [];

            $productFields = [
                "product_name", "product_description", "product_meta_description", "product_meta_keyword",
                "model", "sku", "quantity", "main_image", "image_1", "image_2", "image_3", "image_4", "image_5",
                "image_6", "image_7", "image_8", "image_9", "image_10", "manufacturer_name", "price",
                "product_option_price", "product_option_quantity", "product_option_name", "product_option_value",
                "product_attribute_group", "product_attribute_name", "product_attribute_value", "kdv","product_description_1","product_description_2"
            ];

            foreach ($productFields as $field) {
                $fieldArray = Parcala($supplier[$field]);

                if (count($fieldArray) == 1) {
                    $Urunler[$field] = $valueUrun[$fieldArray[0]];
                } elseif (count($fieldArray) == 2) {
                    $Urunler[$field] = current($valueUrun[$fieldArray[0]]);
                }
            }
            $Urunler["SupplierCode"] = $supplier["SupplierCode"];
            $Urunler["UpdateDate"] = time();



            $UrunlerSonuc[] =$Urunler;


        }
    } elseif (count($explode) == 2 and isset($decodedData[$explode[0]])) {

        foreach ($decodedData[$explode[0]] as $key => $valueXbir) {

          $Total=count($valueXbir);

          $itemsPerPage = TOTAL; // Her sayfada kaç öğe gösterileceğini belirtin
          $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1; // Sayfa numarasını alın

          $startIndex = ($page - 1) * $itemsPerPage;
          $output = array_slice($decodedData[$explode[0]], $startIndex, $itemsPerPage);

          foreach ($output as $valueUrunIC) {

              $Urunler = [];

              $productFields = [
                  "product_name", "product_description", "product_meta_description", "product_meta_keyword",
                  "model", "sku", "quantity", "main_image", "image_1", "image_2", "image_3", "image_4", "image_5",
                  "image_6", "image_7", "image_8", "image_9", "image_10", "manufacturer_name", "price",
                  "product_option_price", "product_option_quantity", "product_option_name", "product_option_value",
                  "product_attribute_group", "product_attribute_name", "product_attribute_value", "kdv","product_description_1","product_description_2"
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
                  $Urunler["SupplierCode"] = $supplier["SupplierCode"];
                  $Urunler["UpdateDate"] = time();

              }
                $UrunlerSonuc[] =$Urunler;


          }
        }

        $datax = array(
          'Total' =>  $Total,
          'Loop' =>  ceil($Total/TOTAL)

          );
        $db->UpdateByObjectId("Supplier",(string)$supplier["_id"], $datax);


    }
    $UrunlerSonucJson = json_encode($UrunlerSonuc);
    $jsonFilePath = $_SERVER['DOCUMENT_ROOT'] . '/System/Product/Json/'.$supplier["SupplierCode"].'_product_'.$_GET['page'].'.json';
    file_put_contents($jsonFilePath, $UrunlerSonucJson);
}
?>
