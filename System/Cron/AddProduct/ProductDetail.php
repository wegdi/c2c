<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();



$Supplier = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($Supplier as $key => $value) {


  $ss=$Product->ReturnProduct(URL.$value["SupplierFilePath"],$value["model"],$value["product_name"],'product_name');
  print_r($ss);

}

// $ProductData dizisini ekrana yazdırma
?>
