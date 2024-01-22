<?php

// Parametreleri bir dizi olarak oluştur
$parameters = array(
    'client_id' => '1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8',
    'response_type' => 'code',
    'state' => '3lhhwkqmlc6cow88wgwwkwcc8k00gwsw8k8osg00084ossc4wo',
    'redirect_uri' => 'https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php'
);

// Parametreleri URL'ye eklemek için http_build_query kullan
$url = 'https://mfkoto.myideasoft.com/panel/auth?' . http_build_query($parameters);

// Yönlendirme
header('Location: ' . $url);
exit;

?>
