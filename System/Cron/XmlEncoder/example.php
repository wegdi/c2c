<?php

// XML verisini çekmek için URL
$xmlUrl = 'https://b2b.dogan-oto.com.tr/bayi/xmlexportv3Dogan.aspx?code=%C4%B0STANBUL.0631';

// XML verisini PHP SimpleXML nesnesine dönüştür
$xml = simplexml_load_file($xmlUrl);

// SimpleXML nesnesini JSON formatına çevir
$json = json_encode($xml);

$json_decode=json_decode($json,1);
// JSON verisini ekrana yazdır
/*
$i = 0;
while($i <= 4){
    print_r($json_decode["stok"][$i]);
    $i = $i+1;
}*/
echo '<pre>';
print_r($json_decode["stok"]);
echo '</pre>';
echo 'stok son';
?>
