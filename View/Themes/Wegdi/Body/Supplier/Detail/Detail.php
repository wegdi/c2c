<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);




// JSON dosyasının URL'si
$jsonUrl = 'https://c2c.wegdi.com/Json/659694796d1cf.json';

// JSON verisini alma
$jsonData = file_get_contents($jsonUrl);

// JSON verisini PHP dizisine dönüştürme
$decodedData = json_decode($jsonData, true);

// PHP dizisini ekrana yazdırma
print_r($decodedData);

?>
