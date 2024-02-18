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
$NewAltSon=[];

foreach ($CategoryOne as $keyx => $valuec) {

  ///İlk Kategoriyi Ekle

  $CategoryS = $db->Query('Category',['Name' => $valuec], [], 'TEK');

  if ($CategoryS["_id"]=="") {

    $AltKategoriler = $db->Query('CategoryList',['CategoryOne' => $valuec], [], 'COK');
    foreach ($AltKategoriler as $keyAlt => $valueAlt) {
      $NewAlt[]=$valueAlt["CategoryTwo"];
      $NewAlt[]=$valueAlt["CategoryTree"];

    }

  print_R($NewAlt);



  }


}
