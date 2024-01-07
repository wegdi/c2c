<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();



$Supplier = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($Supplier as $key => $value) {


  $Products=$Product->ReturnProduct(URL.$value["SupplierFilePath"],$value["model"],$value["product_description"],'product_description');
  foreach ($Products as $keyc => $valuec) {
    print_r($valuec);
    /*
    $ProductIf = $db->Query('Products', ["model" => $valuec["model"]], [], 'COK');

    if ($ProductIf["_id"]=="") {
      $db->Add("Products", $valuec);
    }else {
      $db->UpdateByObjectId("Products",(string)$ProductIf["_id"], $valuec);

    }
    */

  }

}

// $ProductData dizisini ekrana yazdırma
?>
