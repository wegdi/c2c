<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();

$Marka=$POST["Marka"];

$CategoryList = $db->Query('CategoryList',['CategoryOne' => $Marka], [], 'COK');

$List=[];
foreach ($CategoryList  as $key => $value) {
      $List[]=$value["CategoryTwo"];
}

echo json_encode($List);
