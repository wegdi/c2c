<?php
header('Content-Type: application/json; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$Search=$_GET["search"];

if ($Search!="") {
  $query = [
      'Slug' => new MongoDB\BSON\Regex($Search, 'i'), // 'i' for case-insensitive
  ];
}else {
  $query =[];
}

$Products = $db->Query('Products',$query, [], 'COK');

// Tüm kategorileri depolamak için bir dizi oluşturun
$categories = [];

// Ana kategorileri bulun
foreach ($Products as $key => $value) {
    $categories[] = [
        'manufacturer_name' => $value['manufacturer_name']
    ];
}


// JSON çıktısını ekrana yazdır
echo json_encode($categories, JSON_PRETTY_PRINT);
?>
