<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
require_once('ProductFunction.php');

$db = new General();
$Product = new ProductJsonDecoder();


$suppliers = $db->Query('Supplier', ["Status" => 1], [], 'COK');

foreach ($suppliers as $key => $value) {

  $Total=ceil($value/500);

  for ($page = 0; $page <= $Total; $page++) {
      $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductDetail.php?page=" . $page;
      file_get_contents($url);

  }

}



 ?>
