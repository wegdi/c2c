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

$Supplier = $db->Query('Supplier',["Status" =>1], [], 'COK');

foreach ($Supplier as $key => $value) {

    foreach ($QuerList as $keyQuerList) {

     if (isset($keyQuerList)) {
          $explode = explode(';', $keyQuerList);
          $count = count($explode);

          if ($count == 2) {
              $jsonData = file_get_contents("https://c2c.wegdi.com" . $SupplierFilePath);
              $one = $explode[0];
              $two = $explode[1];
              $array = [];

              $decodedData = json_decode($jsonData, true);
          }


        }
      }


}

 ?>
