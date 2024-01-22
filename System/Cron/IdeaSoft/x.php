<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();

// Parametreleri tanımla
$params = array(
    'client_id' => '7_7d67dc7597f034d63775c1d9ae5d9ac7f5750197f',
    'response_type' => 'code',
    'state' => '2b33fdd45jbevd6nam',
    'redirect_uri' => 'http://client.example-app.com/auth'
);

// Parametreleri URL'ye çevir
$queryString = http_build_query($params);

// Tam URL'yi oluştur
$url = 'http://www.ideashopgiyim.com/panel/auth?' . $queryString;

// Yönlendir
header('Location: ' . $url);
exit;

?>