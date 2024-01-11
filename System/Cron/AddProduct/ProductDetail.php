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
              array_shift($product_nexp);
              if (count($product_nexp) == 1) {

                  $Urunler[] = ["product_name" => $valueUrunIC[end($product_nexp)]];


              }elseif (count($product_nexp) == 2) {
                echo "3";
              }elseif (count($product_nexp) == 3) {
                array_shift($product_nexp);
                foreach ($valueUrunIC[$product_nexp[0]] as $keyIcler => $valueIcler) {

                  $Urunler[] = ["product_name" => $valueIcler[end($product_nexp)]];

                }


              }




            //Urun Acıklaması


            $product_description = explode(';', $value["product_description"]);
            array_shift($product_description);
            if (count($product_description) == 1) {

                $Urunler[] = ["product_description" => $valueUrunIC[end($product_description)]];


            }elseif (count($product_description) == 2) {
              echo "3";
            }elseif (count($product_description) == 3) {
              array_shift($product_description);
              foreach ($valueUrunIC[$product_description[0]] as $keyIcler => $valueIcler) {

                $Urunler[] = ["product_description" => $valueIcler[end($product_description)]];

              }


            }








          }

          print_R($Urunler);

        }
    }
}

// $ProductData dizisini ekrana yazdırma
?>
