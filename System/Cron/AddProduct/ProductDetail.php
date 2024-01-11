<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();
echo rand();


function Parcala($value='')
{
  $parcala = explode(';', $value);

  array_shift($parcala);
  return $parcala;

}
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
                $product_name=Parcala($value["product_name"]);

                if (count($product_name)==1) {

                  $Urunler["product_name"] => $valueIcler[end($product_name)],

                } elseif (count($product_nexp) == 2 && count($product_description_exp) == 2) {
                    echo "3";
                } elseif (count($product_nexp) == 3 && count($product_description_exp) == 3) {
                    
                }
            }
        }

        print_r($Urunler);
    }
}

// $ProductData dizisini ekrana yazdırma
?>
