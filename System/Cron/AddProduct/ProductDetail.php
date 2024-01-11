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

                // product_name ve product_description kontrolü
                $product_nexp = explode(';', $value["product_name"]);
                $product_description_exp = explode(';', $value["product_description"]);

                array_shift($product_nexp);
                array_shift($product_description_exp);

                $productKey = end($product_nexp) . '_' . end($product_description_exp);

                if (count($product_nexp) == 1 && count($product_description_exp) == 1) {
                    $Urunler[$productKey] = [
                        "product_name" => $valueUrunIC[end($product_nexp)],
                        "product_description" => $valueUrunIC[end($product_description_exp)]
                    ];
                } elseif (count($product_nexp) == 2 && count($product_description_exp) == 2) {
                    echo "3";
                } elseif (count($product_nexp) == 3 && count($product_description_exp) == 3) {
                    array_shift($product_nexp);
                    array_shift($product_description_exp);
                    foreach ($valueUrunIC[$product_nexp[0]] as $keyIcler => $valueIcler) {
                        $Urunler[$productKey] = [
                            "product_name" => $valueIcler[end($product_nexp)],
                            "product_description" => $valueIcler[end($product_description_exp)]
                        ];
                    }
                }
            }
        }

        print_r($Urunler);
    }
}

// $ProductData dizisini ekrana yazdırma
?>
