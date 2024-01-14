<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();
$value = $db->Query('Supplier', ["Status" => 1,],["sort" => ["Total" => -1]], 'TEK');


  $Loop=ceil($value["Loop"]/5);
  echo $Loop;

/*
  for ($page = 1; $page <= $Loop; $page++) {

      $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductAdd.php?page=" . $page;
      file_get_contents($url);

  }

*/
asd



 ?>
