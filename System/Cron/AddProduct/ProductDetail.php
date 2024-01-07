<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();

$Supplier = $db->Query('Supplier',["Status" =>1], [], 'COK');


foreach ($Supplier as $key => $value) {

    if (isset($value["model"])) {
    echo "string";


  $dd=  array_merge($Product->ProductJsonLogin($value["model"],$value["SupplierFilePath"]), $Product->ProductJsonLogin($value["product_name"],$value["SupplierFilePath"]));

    }

}
print_r(   $dd );

 ?>
