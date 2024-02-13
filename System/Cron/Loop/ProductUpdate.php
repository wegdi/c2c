<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();

$Products = $db->Query('Products', ['_id' => $db->ObjectId($ProductId),'IdeaSoft' => 1], [], 'COK');


foreach ($Products as $key => $value) {
  $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/Product-Price-Update.php?page=".(string)$value["_id"];
  file_get_contents($url);
}
