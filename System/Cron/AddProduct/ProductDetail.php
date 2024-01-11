<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();
echo rand();


$Supplier = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($Supplier as $key => $value) {


    $jsonData = file_get_contents(URL.$value["SupplierFilePath"]);
    $decodedData = json_decode($jsonData, true);
    $explode = explode(';', $value["star"]);
    PRİNT_R($explode);





}

// $ProductData dizisini ekrana yazdırma
?>
