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
    $say = 0;
    $filter = ['GroupId' => '0'];
    $Category_Menu = $db->Query('Category_Menu', $filter, [], 'COK');
    foreach ($Category_Menu as $Category_Menu_Item) {
        $seflink = '';
        if($i == 7){
            //$Category_Menu_Item["Title"];
            $seflink = $db->Seflink($Category_Menu_Item["Title"]);
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
                'slug'  => $seflink,
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
                $menuid = $menu["id"];
                $say = $say+1;
            }
            //kategori2
            /*
            $filter = ['GroupId' => (string)$Category_Menu_Item["Uniqid"]];
            $Category_Menu2 = $db->Query('Category_Menu', $filter, [], 'COK');
            foreach ($Category_Menu2 as $Category_Menu_Item2) {
                $seflink .='-'.$db->Seflink($Category_Menu_Item2["Title"]);
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
                    'name' => $Category_Menu_Item2["Title"],
                    'slug'  =>  $seflink,
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
                    'pageTitle' => $Category_Menu_Item2["Title"],
                    'attachment' => 'string',
                    'parent'    =>  [
                        'id'    =>  $menuid
                    ]
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
                    $menuid2 = $menu["id"];
                    $say = $say+1;
                }
                //kategori3
                $filter = ['GroupId' => (string)$Category_Menu_Item2["Uniqid"]];
                $Category_Menu3 = $db->Query('Category_Menu', $filter, [], 'COK');
                foreach ($Category_Menu3 as $Category_Menu_Item3) {
                    $seflink .='-'.$db->Seflink($Category_Menu_Item3["Title"]);
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
                        'name' => $Category_Menu_Item3["Title"],
                        'slug'  =>  $seflink,
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
                        'pageTitle' => $Category_Menu_Item3["Title"],
                        'attachment' => 'string',
                        'parent'    =>  [
                            'id'    =>  $menuid2
                        ]
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
                        $seflink = $db->Seflink($Category_Menu_Item["Title"]).'-'.$db->Seflink($Category_Menu_Item2["Title"]);
                        $say = $say+1;
                        //$menu = json_decode($response,true);
                        //$menuid3 = $menu["id"];
                    }
                }
                $seflink = $db->Seflink($Category_Menu_Item["Title"]);
            }*/
        }
        $i = $i+1;
    }
    echo "toplam : ".$say." adet eklendi!";
    echo '<pre>';
    print_r($menu);
    echo '</pre>';
?>