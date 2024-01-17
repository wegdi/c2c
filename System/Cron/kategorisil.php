<?php

$base_url = 'https://mfkoto.myideasoft.com/admin-api/categories/';

$token = 'NDhmMDdjMTU0NDc5NWIwNzA2OTA1ZGNhZjAyZjU3YWZlNmUwNmYzNjNlNzBiYTExMzZkNTAzNGYwMTA3NzljMA';

$curl = curl_init();

for ($id = 50592; $id <= 50992; $id++) {
    $url = $base_url . $id;

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);

    // Handle the response as needed (you can echo it or perform additional actions)
    echo "Deleted category with ID $id. Response: $response\n";
}

curl_close($curl);
?>
