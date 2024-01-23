<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    $magaza = 'mfkoto';
    $token = $db->IdeaSoftToken();

    function categories_add($ideasoftid,$magaza,$token){
        $uniqid = uniqid();
        $db = new General();
        $r = 0;
        $son = '';
        $ids = $ideasoftid;
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://$magaza.myideasoft.com/admin-api/categories?parent=$ids&limit=100",
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
            //echo '<pre>';
            //print_r($men);
            //echo '</pre>';
            if(count($men) > 0){
                while($r < count($men)){
                    $Data = array(
                        "Uniqid"    =>  $uniqid,
                        "Name" => $men[$r]["name"],
                        "Slug" => $men[$r]["slug"],
                        "IdeaSoftId" => (int)$men[$r]["id"],
                        "GroupId" => $ids,
                        "SortOrder" => (int)$men[$r]["sortOrder"],
                        "Status" => (int)$men[$r]["status"],
                        "DistributorCode" =>  $men[$r]["distributorCode"],
                        "IdeaSoftDate" =>  $men[$r]["createdAt"]
                    );
                    $db->Add("IdeaSoftCategory", $Data);
                    $r = $r+1;
                    $son = $men[$r]["id"].' - '.$men[$r]["name"];
                }
                return $son;
            }else{
                return 'parent id ile değer bulunamadı!';
            }
        }
    }
    
    $i = 1;
    $filter = ['GroupId' => '0'];
    $IdeaSoftCategory = $db->Query('IdeaSoftCategory', $filter, [], 'COK');
    foreach ($IdeaSoftCategory as $value) {
        if($i == 1){
            $ideasoftid = $value["IdeaSoftId"];
            echo categories_add($ideasoftid,$magaza,$token);
            $filter = ['GroupId' => $ideasoftid];
            $IdeaSoftCategory = $db->Query('IdeaSoftCategory', $filter, [], 'COK');
            foreach ($IdeaSoftCategory as $value) {
                $ideasoftid = $value["IdeaSoftId"];
                echo categories_add($ideasoftid,$magaza,$token);
            }
            
        }
        $i = $i+1;
    }
?>