<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();

$Supplier = $db->Query('Supplier',["Status" =>1], [], 'COK');

$ProductData=[];
foreach ($Supplier as $key => $value) {

    if (isset($value["model"])) {
      $ProductData = array(
      'model' => $Product->ProductJsonLogin($value["model"],$value["SupplierFilePath"]),
      'product_name' =>  $Product->ProductJsonLogin($value["product_name"],$value["SupplierFilePath"]),

    );
    }

}
print_r($ProductData);

 ?>
