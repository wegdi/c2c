<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();

$filtre=[];
$filtre['CategoryId']=['$ne' => null];
$filtre['IdeaSoft']=0;

$valuex = $db->Query('Products', $filtre,[], 'COK',1,30);

foreach ($valuex as $key => $value) {
  print_r($value);
  $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/Product-Price-Send.php?ProductId=" . (string)$value["_id"];

  // Curl kullanarak bir istek gönderme
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_exec($ch);
  curl_close($ch);
}

?>
