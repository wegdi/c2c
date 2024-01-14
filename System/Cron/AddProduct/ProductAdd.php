<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

$SupplierCode=$_GET["SupplierCode"];
$Pages=$_GET["page"];


$jsonFilePath = $_SERVER['DOCUMENT_ROOT'] . '/System/Product/Json/'.$SupplierCode.'_product_'.$Pages.'.json';

echo $jsonFilePath;




?>
