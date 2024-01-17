<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    //echo $db->IdeaSoftToken();
    $magaza = 'mfkoto';
    $token = $db->IdeaSoftToken();


    
    $filter = ['GroupId' => '0'];
    $Category_Menu = $db->Query('Category_Menu', $filter, [], 'COK');
    foreach ($Category_Menu as $Category_Menu_Item) {
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
            'id' => $Category_Menu_Item["Uniqid"],
            'name' => $Category_Menu_Item["Title"],
            'slug' => $Category_Menu_Item["Title"],
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
            'metaDescription' => $Category_Menu_Item["Title"],
            'metaKeywords' => $Category_Menu_Item["Title"],
            'canonicalUrl' => $Category_Menu_Item["Title"],
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
            echo $menu["id"];

        }
        //2.kategori
        /*
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
        }*/
    } 
?>