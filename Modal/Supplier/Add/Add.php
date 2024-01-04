<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();
$uniqid = uniqid();

print_r($_POST);
if ($_POST["tedarikciAdi"]!="" and $_POST["tedarikciLink"]!="") {

  // XML verisini PHP SimpleXML nesnesine dönüştür
  $xml = simplexml_load_file($_POST["tedarikciLink"]);

  // SimpleXML nesnesini JSON formatına çevir
  $json = json_encode($xml, JSON_PRETTY_PRINT);

  // JSON dosyasını belirli bir dizine kaydet
  $jsonFilePath = JSONFILE.$uniqid.'.json'; // Burada "your_filename.json" dosya adını değiştirebilirsiniz.
  file_put_contents($jsonFilePath, $json);


  $data = array(
      'SupplierName' => $db->Guvenlik($_POST["tedarikciAdi"]),
      'SupplierUrl' => $db->Guvenlik($_POST["tedarikciLink"]),
      'SupplierCode' => $uniqid,
      'SupplierFilePath' => '/Json/'.$uniqid.'.json'

  );

  echo $db->Add("Supplier", $data);
}
?>
