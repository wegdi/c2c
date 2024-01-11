<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();
echo rand();

$Supplier = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($Supplier as $key => $value) {
    $jsonData = file_get_contents(URL.$value["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);
    $explode = explode(';', $value["star"]);

    // 2li Giriş
    if (count($explode) == 2) {
        $Urunler = [];
        foreach ($decodedData[$explode[0]] as $keyUrun => $valueUrun) {
          foreach ($valueUrun as $keyUrunIC => $valueUrunIC) {

            $product_nexp = explode(';', $value["product_name"]);


              if (count($product_nexp) == 2) {
                  $Urunler[] = ["product_name" => $valueUrunIC[end($product_nexp)]];
              }
          }

          print_R($Urunler);

        }
    }
}

// $ProductData dizisini ekrana yazdırma
?>
