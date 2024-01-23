<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    $magaza = 'mfkoto';
    $token = $db->IdeaSoftToken();

    $id_box = array('57220','57643','57776','58814','60041','60629','61002','61229','61485','62285','63003','63509','63902','64071','64223');
    $ids = implode(",",$id_box);
    
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => "https://$magaza.myideasoft.com/admin-api/categories?ids=$ids&limit=100",
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
        $men = json_decode($response, true);
        echo '<pre>';
        print_r($men);
        echo '</pre>';
        $i = 0;
        while($i < count($men)){
            $Data = array(
                "name" => $men[$i]["name"],
                "slug" => $men[$i]["slug"],
                "IdeaSoftId" => (int)$men[$i]["id"],
                "GroupId" => (int)"0",
                "sortOrder" => (int)$men[$i]["sortOrder"],
                "status" => (int)$men[$i]["status"],
                "distributorCode" =>  $men[$i]["distributorCode"],
                "IdeaSoftDate" =>  $men[$i]["createdAt"],
                "Date" => strtotime($value["Date"])
              );
            $db->Add("IdeaSoftCategory", $Data);


            $i = $i+1;
        }




    }
    
?>