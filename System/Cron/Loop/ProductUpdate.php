<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();

$Products = $db->Quantity('Products', ['IdeaSoft' => 1]);

// Örnek bir $value dizisi tanımla
$value = array("SupplierCode" => "örnek_değer");

// Çoklu cURL oturumu oluştur
$mh = curl_multi_init();

// Her sayfa için bir cURL oturumu başlat
for ($i = 1; $i <= ceil($Products / 40); $i++) {
    $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/Product-Price-Update.php?page=".$i;

    file_get_contents($url);

}
