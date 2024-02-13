<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();


$Products = $db->Quantity('Products', ['IdeaSoft' => 1]);


for ($i=0; ceil($Products/10) < ; $i++) {

  echo $i;
  $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductAdd.php?SupplierCode=" . $value["SupplierCode"] . '&page=' . $page;


  // Cevap beklemeden isteği gönder
  //file_get_contents($url);
}
