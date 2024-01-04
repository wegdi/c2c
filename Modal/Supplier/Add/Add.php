<?php
function get_cdata($element) {
    $node = dom_import_simplexml($element);
    $cdata = $node->ownerDocument->createCDATASection($node->textContent);
    $node->replaceChild($cdata, $node->firstChild);
    return $element;
}

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();
$uniqid = uniqid();

if ($_POST["tedarikciAdi"]!="" and $_POST["tedarikciLink"]!="") {

    // XML verisini PHP SimpleXML nesnesine dönüştür
    $xml = simplexml_load_file($_POST["tedarikciLink"]);

    // CDATA içeriklerini elde etmek için XML içeriğini döngü ile gezip get_cdata fonksiyonunu kullan
    array_walk_recursive($xml, 'get_cdata');

    $json = json_encode($xml, JSON_PRETTY_PRINT);

    $jsonFilePath = JSONFILE.$uniqid.'.json';
    echo $jsonFilePath;
    file_put_contents($jsonFilePath, $json);

    $data = array(
        'SupplierName' => $db->Guvenlik($_POST["tedarikciAdi"]),
        'SupplierUrl' => $db->Guvenlik($_POST["tedarikciLink"]),
        'SupplierCode' => $uniqid,
        'SupplierFilePath' => '/Json/'.$uniqid.'.json'
    );

    //echo $db->Add("Supplier", $data);
}
?>
