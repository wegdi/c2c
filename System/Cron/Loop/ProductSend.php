<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();

$filtre=[];
$filtre['CategoryId']=['$ne' => null];
$filtre['IdeaSoft']=0;


$value = $db->Query('Products', $filtre,[], 'COK');

print_r($value);
/*
  $Total=ceil($value["Total"]/TOTAL);



  for ($page = 1; $page <= $Total; $page++) {
      $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductDetail.php?page=" . $page;
      file_get_contents($url);

  }



*/



 ?>
