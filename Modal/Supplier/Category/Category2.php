<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();

$Marka=$_POST["Marka"];
$uniqueCategories = []; // Benzersiz kategorileri saklamak için bir dizi oluşturuyoruz
$CategoryList = $db->Query('CategoryList',['CategoryOne' => $Marka], [], 'COK');

$List=[];
foreach ($CategoryList  as $key => $value) {
      $List[]=$value["CategoryTwo"];
      if (!in_array($value["CategoryTwo"], $uniqueCategories)):
        $uniqueCategories[] = $value["CategoryTwo"]; // Kategoriyi benzersiz dizisine ekliyoruz


}

echo json_encode($uniqueCategories);
