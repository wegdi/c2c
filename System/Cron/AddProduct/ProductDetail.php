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
    }elseif ($model == 3) {
      $explode=explode(';',$value["model"]);
      $one = $explode[0];
      $two = $explode[1];
      $tree = $explode[2];

      $ProductData = [];

      foreach ($decodedData[$one][$tree] as $keydecodedData => $valuedecodedData) {
          // Ekrana sıralı bir şekilde yazdırma
          echo 'model'.'-->'.$valuedecodedData["$tree"];

      }
    }



}
?>
