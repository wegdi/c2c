<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();


// Parametreleri tanımla
$params = array(
    'client_id' => '1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8',
    'response_type' => 'code',
    'state' => '2b33fdd45jbevd6nam',
    'redirect_uri' => 'https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php'
);

// Parametreleri URL'ye çevir
$queryString = http_build_query($params);

// Tam URL'yi oluştur
$url = 'http://www.katfarlaryedekparca.com/oauth/v2/token?' . $queryString;

// Yönlendir
header('Location: ' . $url);
exit;

?>