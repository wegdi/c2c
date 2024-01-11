<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();
echo rand();

function Parcala($value = '')
{
  $parcala = explode(';', $value);
  array_shift($parcala);
  return $parcala;
}

$Supplier = $db->Query('Supplier', ["Status" => 1], [], 'COK');
$Urunler = [];

foreach ($Supplier as $key => $value) {
    $jsonData = file_get_contents(URL.$value["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);
    $explode = explode(';', $value["star"]);

    // 2li Giriş
    if (count($explode) == 2) {

        foreach ($decodedData[$explode[0]] as $keyUrun => $valueUrun) {

            foreach ($valueUrun as $keyUrunIC => $valueUrunIC) {
                $product_name = Parcala($value["kdv"]);

                if (count($product_name) == 1) {
                  // Her ürün adını ayrı bir dizi elemanı olarak ekleyin
                  $Urunler["product_name"] = $valueUrunIC[$product_name[0]];
                }elseif (count($product_name) == 2) {
                  echo "string";
                }elseif (count($product_name) == 3) {
                  foreach ($valueUrunIC[$product_name[0]] as $keyBirAlt => $valueBirAlt) {
                    foreach ($valueBirAlt as $key => $value) {
                      print_r( $value);
                    }
                  }
                }


            }
        }

    }
}

// $ProductData dizisini ekrana yazdırma
?>
