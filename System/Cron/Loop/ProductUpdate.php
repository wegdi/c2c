<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require SYSTEM . 'General/General.php';
$db = new General();

echo SYSTEM . 'General/General.php';
echo "<br>";
echo __DIR__;
/*
$Products = $db->Query('Products', ['IdeaSoft' => 1],[], 'COK');


foreach ($Products as $key => $value) {
  $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/Product-Price-Update.php?ProductId=".(string)$value["_id"];
  file_get_contents($url);
}
*/
