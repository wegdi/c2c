<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();


$Products = $db->Quantity('Products', ['IdeaSoft' => 1]);

// Örnek bir $value dizisi tanımla
$value = array("SupplierCode" => "örnek_değer");

// Döngünün koşulunu düzelt
for ($i = 1; $i < ceil($Products / 10); $i++) {


    $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/Product-Price-Update.php?page=".$i;

    file_get_contents($url);
}
