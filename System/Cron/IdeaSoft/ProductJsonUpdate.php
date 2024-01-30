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


   $SupplierUrl = $db->Query('Supplier',["Status" => 1], [], 'COK');

   foreach ($SupplierUrl as $key => $value) {

    // XML verisini PHP DOMDocument nesnesine dönüştür
    $dom = new \DOMDocument;
    $dom->load($value["SupplierUrl"]);

    // CDATA içeriğini text noduna dönüştür
    convertCDATAtoText($dom);

    // Dönüştürülmüş DOMDocument nesnesini SimpleXML nesnesine dönüştür
    $xml = simplexml_import_dom($dom);

    // JSON_ENCODE fonksiyonuna JSON_UNESCAPED_UNICODE sabitini ekleyerek Türkçe karakter uyumlu hale getir
    $json = json_encode($xml, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $jsonFilePath = JSONFILE.$value["SupplierCode"].'.json';
    file_put_contents($jsonFilePath, $json);

    }


?>
