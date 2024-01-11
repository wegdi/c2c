<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
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

foreach ($Supplier as $key => $value) {
    $jsonData = file_get_contents(URL . $value["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);
    $explode = explode(';', $value["star"]);

    // 2li Giriş
    if (count($explode) == 2) {
        foreach ($decodedData[$explode[0]] as $keyUrun => $valueUrun) {
            foreach ($valueUrun as $keyUrunIC => $valueUrunIC) {
                $Urunler = [];

                $fields = ["product_name", "product_description", "kdv", "manufacturer_name", "model"];

                foreach ($fields as $field) {
                    $fieldArray = Parcala($value[$field]);

                    if (count($fieldArray) == 1) {
                        $Urunler[$field] = $valueUrunIC[$fieldArray[0]];
                    } elseif (count($fieldArray) == 3) {
                        foreach ($valueUrunIC[$fieldArray[0]] as $keyBirAlt => $valueBirAlt) {
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
