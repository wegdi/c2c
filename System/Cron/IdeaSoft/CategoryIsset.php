<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$filtre = [];

$Category = $db->Query('CategoryList', $filtre, [], 'COK');

$CategoryOne=[];
foreach ($Category as $key => $value) {
    $CategoryOne[]=$value["CategoryOne"];

}

$CategoryOne=array_unique($CategoryOne);


$NewAlt=[];
foreach ($CategoryOne as $keyx => $valuec) {

  $CategoryS = $db->Query('Category',['Name' => $valuec], [], 'TEK');

  if ($CategoryS["_id"]=="") {
    echo $valuec;
    echo "<br>";
    $AltKategoriler = $db->Query('CategoryList',['CategoryOne' => $valuec], [], 'COK');
    foreach ($AltKategoriler as $keyAlt => $valueAlt) {
      $NewAlt[]=$valueAlt["CategoryTwo"];
    }
    $NewAlt=array_unique($NewAlt);

    print_r($NewAlt);

  }


}
