<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();
$value = $db->Query('Supplier', ["Status" => 1,],["sort" => ["Total" => -1]], 'TEK');

  $Total=ceil($value["Total"]/TOTAL);

  $Loop=ceil($value["Loop"]/5);


  for ($page = 1; $page <= $Total; $page++) {
      $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductDetail.php?page=" . $page;
      file_get_contents($url);

  }



  /*for ($page = 1; $page <= $Total; $page++) {
      $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductDetail.php?page=" . $page;
      file_get_contents($url);

  } */





 ?>
