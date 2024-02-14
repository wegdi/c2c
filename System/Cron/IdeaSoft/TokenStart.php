<?php

// Parametreleri bir dizi olarak oluştur
$parameters = array(
    'client_id' => '3pebeuh6xb40swk0c08ckkow0g0ogcc40k4ggkw8so8owgowk4',
    'response_type' => 'code',
    'state' => '40cezisrdy68cwoso8k40c4kcso040o8sso80ggkggs4gkk84c',
    'redirect_uri' => 'https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php'
);

// Parametreleri URL'ye eklemek için http_build_query kullan
$url = 'https://mfkoto.myideasoft.com/panel/auth?' . http_build_query($parameters);

// Yönlendirme
header('Location: ' . $url);
exit;

?>
