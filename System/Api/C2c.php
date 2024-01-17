<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();



        // Parametreleri tanımla
        $params = array(
            'client_id' => '1iydisrb33pc88ccog88wgw8gwkwkc8k4woo4s8goss44koog8',
            'response_type' => 'code',
            'state' => '3lhhwkqmlc6cow88wgwwkwcc8k00gwsw8k8osg00084ossc4wo',
            'redirect_uri' => 'https://c2c.wegdi.com/System/Cron/IdeaSoft/TokenRedirect.php'
        );

        // Parametreleri URL'ye çevir
        $queryString = http_build_query($params);

        // Tam URL'yi oluştur
        $url = 'https://mfkoto.myideasoft.com/panel/auth?' . $queryString;

        // Yönlendir
        header('Location: ' . $url);
        exit;

?>
