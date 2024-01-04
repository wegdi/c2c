<?php

// XML verisini çekmek için URL
$xmlUrl = 'https://b2b.dogan-oto.com.tr/bayi/xmlexportv3Dogan.aspx?code=%C4%B0STANBUL.0631';

// XML verisini PHP SimpleXML nesnesine dönüştür
$xml = simplexml_load_file($xmlUrl);

print_r($xml);

?>
