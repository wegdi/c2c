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

  $jsonData = file_get_contents(URL.$value["SupplierFilePath"]);
  $decodedData = json_decode($jsonData, true);

    foreach ($QuerList as $keyQuerList) {

     if (isset($value["$keyQuerList"])) {
          $explode = explode(';', $value["$keyQuerList"]);
          $count = count($explode);

          if ($count == 2) {
              $one = $explode[0];
              $two = $explode[1];
            $ProductData=[];
            foreach ($decodedData[$one] as $keydecodedData => $valuedecodedData) {
              print_r($valuedecodedData);
                //$ProductData=$valuedecodedData[$two];
            }

          }


        }
        print_R($ProductData);

      }


}

 ?>
