<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();


$suppliers = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($suppliers as $supplier) {
    $filePath = $_SERVER['DOCUMENT_ROOT'] . $supplier["SupplierFilePath"];
    $jsonData = file_get_contents($filePath);
    $decodedData = json_decode($jsonData, true);

    foreach ($decodedData["stok"]  as $key => $value) {
      $kategoribir=$value["marka"];
      $kategoriiki=$value["kategori"].' Sonrası';
      $kategoriuc=$value["model"];
      echo $kategoribir.' > '.$kategoriiki.' > '.$kategoriuc;
      echo "<br>";




    }

}
?>
