<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();
$uniqid=uniqid();

$data = array(
    'SupplierName' => $db->Guvenlik($_POST["tedarikciAdi"]),
    'SupplierUrl' => $db->Guvenlik($_POST["en"]),
    'SupplierCode' => $$uniqid,
    'Pages' => '', // Burada uygun bir değer atamanız gerekecektir
    'Parent_ID' => $db->Guvenlik($_POST["parent_id"]),
    'Seo_Url' => $db->Seflink($db->Guvenlik($_POST["en"])), // Parantez eksikti
    'Icon' => $db->Guvenlik($_POST["icon"]),
    'Order' => $db->Guvenlik($_POST["order"])
);

echo $db->Add("Supplier", $data); // `Add` fonksiyonunu düzgün şekilde çağırın
