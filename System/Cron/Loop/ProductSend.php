<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();

$filtre=[];
$filtre['CategoryId']=['$ne' => null];
$filtre['IdeaSoft']=0;


$valuex = $db->Query('Products', $filtre,[], 'COK',1,5);

foreach ($valuex as $key => $value) {
  print_r($value);
  $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/Product-Price-Send.php?ProductId=" . (string)$value["_id"];
  file_get_contents($url);

}



 ?>
