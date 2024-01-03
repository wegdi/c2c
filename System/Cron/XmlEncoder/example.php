<?php

// XML verisini çekmek için URL
$xmlUrl = 'https://b2b.dogan-oto.com.tr/bayi/xmlexportv3Dogan.aspx?code=%C4%B0STANBUL.0631';

// XML verisini PHP SimpleXML nesnesine dönüştür
$xml = simplexml_load_file($xmlUrl);

// SimpleXML nesnesini JSON formatına çevir
$json = json_encode($xml);

$json_decode=json_decode($json,1);
// JSON verisini ekrana yazdır
$i = 0;
foreach ($json_decode["stok"] as $product) {
    if($i<= 5){
        echo $product[$i];
        echo '<br>';
    }

    $i = $i+1;
    # code...
}
echo count($json_decode["stok"]);
?>
