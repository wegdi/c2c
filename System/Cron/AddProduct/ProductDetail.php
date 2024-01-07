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
   $model = $Product->ProductJsonLoginCount($value["model"]);
   $product_name = $Product->ProductJsonLoginCount($value["product_name"]);

    $jsonData = file_get_contents(URL.$value["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);

    $ProductData = [];

    if ($model == 2) {
        $explode = explode(';', $value["model"]);
        $one = $explode[0];
        $two = $explode[1];

        foreach ($decodedData[$one] as $keydecodedData => $valuedecodedData) {
            // Ekrana sıralı bir şekilde yazdırma
            echo  $valuedecodedData[$Product->ProductJsonLoginEnd($value["model"])];;
            $ProductData['model'] = $valuedecodedData[$Product->ProductJsonLoginEnd($value["model"])];
            $ProductData['product_name'] = $valuedecodedData[$Product->ProductJsonLoginEnd($value["product_name"])];

            echo "<br>";
        }
    } elseif ($model == 3) {
        $explode = explode(';', $value["model"]);
        $one = $explode[0];
        $tree = $explode[2];

        foreach ($decodedData[$one][$tree] as $keydecodedData => $valuedecodedData) {
            // Ekrana sıralı bir şekilde yazdırma
            echo 'model'.'-->'.$valuedecodedData["$tree"];
        }
    }

    print_r($ProductData); // Döngü içinde değil, döngü sonunda çağrılmalıdır.
}
?>
