<?php
function convertCDATAtoText($node) {
    foreach ($node->childNodes as $child) {
        if ($child instanceof \DOMCdataSection) {
            $textNode = $node->ownerDocument->createTextNode($child->nodeValue);
            $node->replaceChild($textNode, $child);
        } elseif ($child->hasChildNodes()) {
            convertCDATAtoText($child);
        }
    }
}

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();
$uniqid = uniqid();

if ($_POST["tedarikciAdi"]!="" and $_POST["tedarikciLink"]!="") {

  $SupplierUrl = $db->Query('Supplier',["SupplierUrl" => (string)$_POST["tedarikciLink"]], [], 'TEK');
  $SupplierName = $db->Query('Supplier',["SupplierName" => (string)$_POST["tedarikciAdi"]], [], 'TEK');


  if ($SupplierUrl["_id"]=="" and $SupplierName["_id"]=="") {


    // XML verisini PHP DOMDocument nesnesine dönüştür
    $dom = new \DOMDocument;
    $dom->load($_POST["tedarikciLink"]);

    // CDATA içeriğini text noduna dönüştür
    convertCDATAtoText($dom);

    // Dönüştürülmüş DOMDocument nesnesini SimpleXML nesnesine dönüştür
    $xml = simplexml_import_dom($dom);

    // JSON_ENCODE fonksiyonuna JSON_UNESCAPED_UNICODE sabitini ekleyerek Türkçe karakter uyumlu hale getir
    $json = json_encode($xml, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    $jsonFilePath = JSONFILE.$uniqid.'.json';
    file_put_contents($jsonFilePath, $json);

    $data = array(
        'SupplierName' => $db->Guvenlik($_POST["tedarikciAdi"]),
        'SupplierUrl' => $db->Guvenlik($_POST["tedarikciLink"]),
        'SupplierCode' => $uniqid,
        'SupplierFilePath' => '/Json/'.$uniqid.'.json'
    );

    $response= $db->Add("Supplier", $data);
    $response=json_decode($response,1);
    if ($response["success"]=="true") {
    $return = array(
      'url' => URL.'/Supplier/Detail/'.$uniqid.'/1',
    );
    echo json_encode($return);
    }
  }else {
    $returnx = array(
      'status' => false,
      'message' => 'Tedarikçi Linki veya Tedarikçi Adı Sistemde Kayıtlı',
      'urlc' => URL.'/Supplier/Detail/'.$SupplierUrl["SupplierCode"]
    );
    echo json_encode($returnx);
  }
}

?>
