<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();



$Supplier = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($Supplier as $key => $value) {

  $dizi=[
    'product_name' => $value["product_name"],
    'product_description' => $value["product_description"],
    'product_meta_description' => $value["product_meta_description"],
    'product_meta_keyword'  => $value["product_meta_keyword"],
    'quantity' => $value["quantity"],
    'price' => $value["price"],
    'kdv'  => $value["kdv"]
  ];

  $Products=$Product->ReturnProduct(URL.$value["SupplierFilePath"],$value["model"],$dizi,$value["SupplierCode"]);
  foreach ($Products as $keyc => $valuec) {
      print_r($valuec);
    foreach ($valuec as $key => $value) {


    }


  /*  $ProductIf = $db->Query('Products', ["model" => $valuec["model"]], [], 'COK');

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
