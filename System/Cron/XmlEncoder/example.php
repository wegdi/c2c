<?php

// XML verisini çekmek için URL
$xmlUrl = 'https://b2b.dogan-oto.com.tr/bayi/xmlexportv3Dogan.aspx?code=%C4%B0STANBUL.0631';

// XML verisini indir
$xmlData = file_get_contents($xmlUrl);

// Eğer başarılı bir şekilde indirilemezse, hata mesajını göster
if ($xmlData === FALSE) {
    die('XML verisi indirilemedi.');
}

// XML verisini PHP SimpleXML nesnesine dönüştür
$xml = simplexml_load_string($xmlData);

// Elde edilen SimpleXML nesnesini göster
print_r($xml);

?>
