<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();

$Supplier = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($Supplier as $key => $value) {

  $Product->ReturnProduct(URL.$value["SupplierFilePath"],$value["model"],$value["product_name"],'omu');

  /*
    $model = $Product->ProductJsonLoginCount($value["model"]);

    $jsonData = file_get_contents(URL.$value["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);

    $ProductData = [];

    if ($model == 2) {
        $explode = explode(';', $value["model"]);
        $one = $explode[0];
        $two = $explode[1];

        foreach ($decodedData[$one] as $keydecodedData => $valuedecodedData) {
            // Ekrana sıralı bir şekilde yazdırma
            $modelValue = $valuedecodedData[$Product->ProductJsonLoginEnd($value["model"])];
            $product_nameValue = $valuedecodedData[$Product->ProductJsonLoginEnd($value["product_name"])];

            // $ProductData dizisine ekleme
            $ProductData[] = array('model' => $modelValue, 'product_name' => $product_nameValue);
        }
    } elseif ($model == 3) {
        $explode = explode(';', $value["model"]);
        $one = $explode[0];
        $tree = $explode[2];

        foreach ($decodedData[$one][$tree] as $keydecodedData => $valuedecodedData) {
            // Ekrana sıralı bir şekilde yazdırma
            $modelValue = $valuedecodedData["$tree"];
            echo 'model: '.$modelValue.'<br>';

            // $ProductData dizisine ekleme
            $ProductData[] = array('model' => $modelValue, 'product_name' => '');
        }
    }
    */
}

// $ProductData dizisini ekrana yazdırma
?>
