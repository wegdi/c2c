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

                $product_name = Parcala($value["product_name"]);
                $product_description = Parcala($value["product_description"]);
                $kdv = Parcala($value["kdv"]);
                $manufacturer_name = Parcala($value["manufacturer_name"]);



                if (count($product_name) == 1) {
                  // Her ürün adını ayrı bir dizi elemanı olarak ekleyin
                  $Urunler["product_name"] = $valueUrunIC[$product_name[0]];
                }elseif (count($product_name) == 2) {
                  //echo "string";
                }elseif (count($product_name) == 3) {
                  foreach ($valueUrunIC[$product_name[0]] as $keyBirAlt => $valueBirAlt) {
                    $Urunler["product_name"] = $valueBirAlt[end($product_name)];
                  }
                }


                if (count($product_description) == 1) {
                  // Her ürün adını ayrı bir dizi elemanı olarak ekleyin
                  $Urunler["product_description"] = $valueUrunIC[$product_description[0]];
                }elseif (count($product_description) == 2) {
                  //echo "string";
                }elseif (count($product_description) == 3) {
                  foreach ($valueUrunIC[$product_description[0]] as $keyBirAlt => $valueBirAlt) {
                    $Urunler["product_description"] = $valueBirAlt[end($product_description)];
                  }
                }



                if (count($kdv) == 1) {
                  // Her ürün adını ayrı bir dizi elemanı olarak ekleyin
                  $Urunler["kdv"] = $valueUrunIC[$kdv[0]];
                }elseif (count($kdv) == 2) {
                  //echo "string";
                }elseif (count($kdv) == 3) {
                  foreach ($valueUrunIC[$kdv[0]] as $keyBirAlt => $valueBirAlt) {
                    //print_R($valueBirAlt);
                    $Urunler["kdv"] = $valueBirAlt[end($kdv)];
                  }
                }


                if (count($manufacturer_name) == 1) {
                  // Her ürün adını ayrı bir dizi elemanı olarak ekleyin
                  $Urunler["manufacturer_name"] = $valueUrunIC[$manufacturer_name[0]];
                }elseif (count($manufacturer_name) == 2) {
                  //echo "string";
                }elseif (count($manufacturer_name) == 3) {
                  foreach ($valueUrunIC[$manufacturer_name[0]] as $keyBirAlt => $valueBirAlt) {
                    //print_R($valueBirAlt);
                    $Urunler["manufacturer_name"] = $valueBirAlt[end($manufacturer_name)];
                  }
                }
                print_R($Urunler);

            }
        }

    }
}

// $ProductData dizisini ekrana yazdırma
?>
