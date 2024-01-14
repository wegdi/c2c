<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();
$suppliers = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($suppliers as $key => $value) {

  $Total=ceil($value["Total"]/500);

  for ($page = 0; $page <= $Total; $page++) {
      $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductDetail.php?page=" . $page.'?SupplierCode='.$value["SupplierCode"];
      file_get_contents($url);

  }

}



 ?>
