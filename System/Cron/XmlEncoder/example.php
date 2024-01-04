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



    preg_match_all('/"(.+)": "(.+)"/', file_get_contents("https://c2c.wegdi.com/Json/659693f87cc90.json"), $output_array);
    $r = 0;
    while($r<= count($output_array[1])){
        $data = array(
            'LeftData' => $db->Guvenlik($output_array[1][$r]),
            'RightData' => $db->Guvenlik($output_array[2][$r])
        );
        $db->Add("RCategory", $data);
        $r = $r+1;
    }
    echo 'bitti';

?>




<?php

// XML verisini çekmek için URL
//$xmlUrl = 'https://b2b.dogan-oto.com.tr/bayi/xmlexportv3Dogan.aspx?code=%C4%B0STANBUL.0631';

// XML verisini indir
//$xmlData = file_get_contents($xmlUrl);
//echo $xmlData;
//print_r($xmlData);
/*
$jsonFilePath = JSONFILE.$uniqid.'.json';


file_put_contents($jsonFilePath, $xmlData);

// Eğer başarılı bir şekilde indirilemezse, hata mesajını göster
if ($xmlData === FALSE) {
    die('XML verisi indirilemedi.');
}

// XML verisini PHP SimpleXML nesnesine dönüştür
$xml = simplexml_load_string($xmlData);

// Elde edilen SimpleXML nesnesini göster
print_r($xml);
*/




?>
