<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

$SupplierCode=$_GET["SupplierCode"];


$Supplier = $db->Query('Supplier', ["Status" => 1,"SupplierCode" => $SupplierCode], [], 'TEK');



for ($page = 1; $page <= $Supplier["Loop"]; $page++) {

    $jsonFilePath = $_SERVER['DOCUMENT_ROOT'] . '/System/Product/Json/'.$SupplierCode.'_product_'.$_page.'.json';
    echo $jsonFilePath;
    //file_get_contents($url);

}


?>
