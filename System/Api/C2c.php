<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    echo 'test c2c';

    $client = new http\Client;
    $request = new http\Client\Request;

    $request->setRequestUrl('https://mfkoto.myideasoft.com/admin-api/abandoned_carts');
    $request->setRequestMethod('GET');
    $request->setHeaders([
    'Content-Type' => 'application/json',
    'Authorization' => ''
    ]);

    $client->enqueue($request)->send();
    $response = $client->getResponse();

    echo $response->getBody();


?>