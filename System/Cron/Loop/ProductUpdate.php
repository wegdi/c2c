<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();


$Products = $db->Quantity('Products', ['IdeaSoft' => 1]);

// Örnek bir $value dizisi tanımla
$value = array("SupplierCode" => "örnek_değer");

// Döngünün koşulunu düzelt
for ($i = 0; $i < ceil($Products / 10); $i++) {
    echo $i;

    // $page değişkeni tanımlanmamış gibi görünüyor, onu da tanımlamanız gerekebilir
    $page = $i + 1;

    $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductAdd.php?SupplierCode=" . $value["SupplierCode"] . '&page=' . $page;

    // Cevap beklemeden isteği gönder
    //file_get_contents($url);
}
