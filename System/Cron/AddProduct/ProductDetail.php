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



    $model=$Product->ProductJsonLoginCount($value["model"]);

    if (isset($value["product_description"])) {
      $product_description=$Product->ProductJsonLoginCount($value["product_description"]);
    }
    if (isset($value["product_meta_description"])) {
      $product_meta_description=$Product->ProductJsonLoginCount($value["product_meta_description"]);
    }

    if (isset($value["product_meta_keyword"])) {
    $product_meta_keyword=$Product->ProductJsonLoginCount($value["product_meta_keyword"]);
    }
    if (isset($value["sku"])) {
      $sku=$Product->ProductJsonLoginCount($value["sku"]);
    }
    if (isset($value["quantity"])) {
      $quantity=$Product->ProductJsonLoginCount($value["quantity"]);
    }

    if (isset($value["kdv"])) {
      $kdv=$Product->ProductJsonLoginCount($value["kdv"]);

    }
    if (isset($value["price"])) {
      $price=$Product->ProductJsonLoginCount($value["price"]);

    }





    $jsonData = file_get_contents(URL.$value["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);


    if ($model == 2) {
        $explode=explode(';',$value["model"]);
        $one = $explode[0];
        $two = $explode[1];
        $ProductData = [];

        foreach ($decodedData[$one] as $keydecodedData => $valuedecodedData) {
            // Ekrana sıralı bir şekilde yazdırma
            echo 'model'.'-->'.$valuedecodedData["$two"];

            echo "<br>";
        }
    }



}
?>
