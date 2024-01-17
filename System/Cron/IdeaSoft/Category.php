<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    //echo $db->IdeaSoftToken();
    $magaza = 'mfkoto';
    $token = $db->IdeaSoftToken();
    /*
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => "https://$magaza.myideasoft.com/admin-api/categories",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        'name' => $Category_Menu_Item["Title"],
        'sortOrder' => 999,
        'status' => 1,
        'distributor' => '',
        'percent' => 1,
        'displayShowcaseContent' => 0,
        'showcaseContent' => 'Üst içerik metni.',
        'showcaseContentDisplayType' => 1,
        'displayShowcaseFooterContent' => 0,
        'showcaseFooterContent' => 'string',
        'showcaseFooterContentDisplayType' => 1,
        'hasChildren' => 0,
        'pageTitle' => $Category_Menu_Item["Title"],
        'attachment' => 'string'
    ]),
    CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Authorization: $token",
        "Content-Type: application/json"
    ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
        $menu = json_decode($response,true);
    }
    */
    
    $i=1;
    $filter = ['GroupId' => '0'];
    $Category_Menu = $db->Query('Category_Menu', $filter, [], 'COK');
    foreach ($Category_Menu as $Category_Menu_Item) {
        if($i == 1){
            //$Category_Menu_Item["Title"];
            $curl = curl_init();
            curl_setopt_array($curl, [
            CURLOPT_URL => "https://$magaza.myideasoft.com/admin-api/categories",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'name' => $Category_Menu_Item["Title"],
                'sortOrder' => 999,
                'status' => 1,
                'distributor' => '',
                'percent' => 1,
                'displayShowcaseContent' => 0,
                'showcaseContent' => 'Üst içerik metni.',
                'showcaseContentDisplayType' => 1,
                'displayShowcaseFooterContent' => 0,
                'showcaseFooterContent' => 'string',
                'showcaseFooterContentDisplayType' => 1,
                'hasChildren' => 0,
                'pageTitle' => $Category_Menu_Item["Title"],
                'attachment' => 'string'
            ]),
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Authorization: $token",
                "Content-Type: application/json"
            ],
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
            echo "cURL Error #:" . $err;
            } else {
                $menu = json_decode($response,true);
            }
        }
        $i = $i+1;
    }
?>