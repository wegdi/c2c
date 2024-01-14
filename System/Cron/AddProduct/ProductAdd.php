<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

$SupplierCode = $_GET["SupplierCode"];
$Pages = $_GET["page"];

$jsonFilePath = $_SERVER['DOCUMENT_ROOT'] . '/System/Product/Json/' . $SupplierCode . '_product_' . $Pages . '.json';

// Dosyanın var olup olmadığını kontrol et
if (file_exists($jsonFilePath)) {
    // Dosya varsa içeriği oku ve ekrana yazdır
    $jsonData = file_get_contents($jsonFilePath);
    $decodedData = json_decode($jsonData, true);

    foreach ($decodedData as $key => $value) {

        // quantity değerini kontrol et
        if (isset($value['quantity']) && is_string($value['quantity'])) {
            // String ifadeyi integera çevir
            $value['quantity'] = (int)$value['quantity'];
        }

        $value['C2Cmodel'] =   $db->customShortHash($value["model"]);



        $Products = $db->Query('Products', ["SupplierCode" => $SupplierCode, "model" => $value["model"]], [], 'TEK');

        if ($Products["_id"] == "") {
            $db->Add("Products", $value);
        } else {
            $db->UpdateByObjectId("Products", (string)$Products["_id"], $value);
        }

    }
} else {
    // Dosya yoksa hata mesajını yazdır
    echo "Belirtilen dosya bulunamadı.";
}
?>
