<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();
$valueX = $db->Query('Supplier', ["Status" => 1,],[], 'COK');


foreach ($valueX as $key => $value) {

  for ($page = 1; $page <= $value["Loop"]; $page++) {

      $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductAdd.php?SupplierCode=" . $page;
      file_get_contents($url);

  }
}




 ?>
