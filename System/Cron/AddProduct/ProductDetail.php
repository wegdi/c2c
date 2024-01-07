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
    $product_description=$Product->ProductJsonLoginCount($value["product_description"]);
    $product_meta_description=$Product->ProductJsonLoginCount($value["product_meta_description"]);
    $product_meta_keyword=$Product->ProductJsonLoginCount($value["product_meta_keyword"]);
    $product_meta_keyword=$Product->ProductJsonLoginCount($value["product_meta_keyword"]);
    $sku=$Product->ProductJsonLoginCount($value["sku"]);
    $quantity=$Product->ProductJsonLoginCount($value["quantity"]);
    $kdv=$Product->ProductJsonLoginCount($value["kdv"]);
    $price=$Product->ProductJsonLoginCount($value["price"]);

    $jsonData = file_get_contents(URL.$value["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);


        if (isset($value["model"])) {
          // code...
        }



}
?>
