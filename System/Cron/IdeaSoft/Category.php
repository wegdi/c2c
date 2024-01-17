<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    //echo $db->IdeaSoftToken();
    $magaza = 'mfkoto';
    $token = $db->IdeaSoftToken();

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
        'id' => 123,
        'name' => 'Kırtasiye',
        'slug' => 'kirtasiye',
        'sortOrder' => 999,
        'status' => 1,
        'distributor' => '',
        'percent' => 1,
        'displayShowcaseContent' => 0,
        'showcaseContent' => '',
        'showcaseContentDisplayType' => 1,
        'displayShowcaseFooterContent' => 0,
        'showcaseFooterContent' => 'string',
        'showcaseFooterContentDisplayType' => 1,
        'hasChildren' => 0,
        'pageTitle' => 'string',
        'metaDescription' => 'Kaliteli kırtasiye ürünleri.',
        'metaKeywords' => 'kırmızı, kalem, kırtasiye',
        'canonicalUrl' => 'kategoriler/idea-kalem',
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
        echo '<pre>';
        print_r($response);
        echo '</pre>';
    }

    /*
    $filter = ['GroupId' => '0'];
    $Category_Menu = $db->Query('Category_Menu', $filter, [], 'COK');
    foreach ($Category_Menu as $Category_Menu_Item) {
        //$Category_Menu_Item["Title"];

        //2.kategori
        $filter = ['GroupId' => (string)$Category_Menu_Item["Uniqid"]];
        $Category_Menu2 = $db->Query('Category_Menu', $filter, [], 'COK');
        foreach ($Category_Menu2 as $Category_Menu_Item2) {
            //$Category_Menu_Item2["Title"];
            //3.kategori
            $filter = ['GroupId' => (string)$Category_Menu_Item2["Uniqid"]];
            $Category_Menu3 = $db->Query('Category_Menu', $filter, [], 'COK');
            foreach ($Category_Menu3 as $Category_Menu_Item3) {
                //$Category_Menu_Item3["Title"];

            }
        }
    } */
?>