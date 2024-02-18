<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$filtre = [];
$filtre["ParentId"]=0;
$Category = $db->Query('IdeaSoftCategory', $filtre, [], 'COK');

$CategoryOne=[];
foreach ($Category as $key => $value) {

if ($value["IdeaSoftId"] > 64914) {
  print_r($value);

}
}
