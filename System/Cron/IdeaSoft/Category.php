<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    $magaza = 'mfkoto';
    $token = $db->IdeaSoftToken();
    $page=$_GET["page"];


    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://".$magaza.".myideasoft.com/admin-api/categories?sort=-id&limit=100&page=".$page,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Authorization:  $token"
      ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {

      $data=[];
      $IdeaSoftCategory=json_decode($response,1);
      print_r($IdeaSoftCategory);
      foreach ($IdeaSoftCategory as $key => $value) {
        $data["Name"] = $value["name"];
        $data["Slug"] = $value["slug"];
        $data["IdeaSoftId"] = (int)$value["id"];
        $data["Status"] = $value["status"];
        if (is_array($value["parent"])) {
        $data["ParentId"] = (int)$value["parent"]["id"];

      }else {
        $data["ParentId"] = 0;

      }

        $IdeaSoftCategory = $db->Query('IdeaSoftCategory', ["IdeaSoftId" => (int)$value["id"]], [], 'TEK');

        if ($IdeaSoftCategory["_id"]=="") {
          $db->Add("IdeaSoftCategory", $data);

        }else {
          $db->UpdateByObjectId("IdeaSoftCategory", (string)$IdeaSoftCategory["_id"], $data);

        }


      }
    }




?>
