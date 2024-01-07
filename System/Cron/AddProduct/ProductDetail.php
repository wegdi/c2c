<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();

$QuerList = array(
    "product_name",
    "product_description",
    "product_meta_description",
    "product_meta_keyword",
    "model"
);



$Supplier = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($Supplier as $key => $value) {

    $model=ProductJsonLoginCount($value["model"));
    echo $model;

}
?>
