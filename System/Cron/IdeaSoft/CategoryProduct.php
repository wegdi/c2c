<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

$CategoryList = $db->Query('CategoryList',[], [], 'COK');

foreach ($CategoryList as $key => $value) {
  if ($value["IdeaSoftId"]!="") {

    $Products = $db->Query('Products',['CategoryFull' => $value["CategoryFull"]], [], 'COK');

    foreach ($Products as $keyx => $valuex) {


      $arrayName = array('CategoryId' => $value["IdeaSoftId"] );
      $db->UpdateByObjectId("Products", (string)$valuex["_id"], $arrayName);


    }





  }

}
