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
    echo $jsonFilePath;
    file_put_contents($jsonFilePath, $json);

    $data = array(
        'SupplierName' => $db->Guvenlik($_POST["tedarikciAdi"]),
        'SupplierUrl' => $db->Guvenlik($_POST["tedarikciLink"]),
        'SupplierCode' => $uniqid,
        'SupplierFilePath' => '/Json/'.$uniqid.'.json'
    );

    echo $db->Add("Supplier", $data);

<<<<<<< HEAD
  /*  if (condition) {
      // code...
=======

    preg_match_all('/"(.+)": "(.+)"/', file_get_contents("https://c2c.wegdi.com/Json/659693f87cc90.json"), $output_array);
    $r = 0;
    while($r<= count($output_array[1])){
        $data = array(
            'LeftData' => $db->Guvenlik($output_array[1][$r]),
            'RightData' => $db->Guvenlik($output_array[2][$r])
        );
        $db->Add("RCategory", $data);
        $r = $r+1;
>>>>>>> 748fc6b4a9ed55134a8a46267c9b0720f7366c30
    }
    */

}
?>
