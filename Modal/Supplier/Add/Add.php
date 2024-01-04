<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();
$uniqid=uniqid();

if ($_POST["tedarikciLink"]!="" and $_POST["tedarikciLink"]!="") {

  // XML verisini çekmek için URL
  $xmlUrl = 'https://b2b.dogan-oto.com.tr/bayi/xmlexportv3Dogan.aspx?code=%C4%B0STANBUL.0631';

  // XML verisini PHP SimpleXML nesnesine dönüştür
  $xml = simplexml_load_file($xmlUrl);

  // SimpleXML nesnesini JSON formatına çevir
  $json = json_encode($xml);

  $json_decode=json_decode($json,1);

  $data = array(
      'SupplierName' => $db->Guvenlik($_POST["tedarikciAdi"]),
      'SupplierUrl' => $db->Guvenlik($_POST["tedarikciLink"]),
      'SupplierCode' => $uniqid,

  );

  echo $db->Add("Supplier", $data);

}
