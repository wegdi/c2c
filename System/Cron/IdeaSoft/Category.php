<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    $magaza = 'mfkoto';
    $token = $db->IdeaSoftToken();


    for ($page = 1; $page <= 66; $page++) {
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://$magaza.myideasoft.com/admin-api/categories?page=$page&limit=100",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: $token"
        ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
              $IdeaSoftCategory=json_decode($response,1);
              print_r($IdeaSoftCategory);

            }
        }
    }


?>
