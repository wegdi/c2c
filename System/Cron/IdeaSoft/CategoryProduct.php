<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

$CategoryList = $db->Query('CategoryList',[], [], 'COK');

foreach ($CategoryList as $key => $value) {
  if ($value["IdeaSoftId"]!="") {
    print_r($value);

  }

}
