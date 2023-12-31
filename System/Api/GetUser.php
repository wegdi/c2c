<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://cronmy.wegdi.com/modal/Api/firmalar.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$json=json_decode($response,1);

  foreach ($json as $key => $value) {

    print_r($value);

    $Companies = $db->Query('Companies',['GoogleId' => $value["GoogleId"]], [], 'TEK');


    if ($Companies["_id"]=="") {
      $db->Add("Companies", $value);

    }else {
      $db->UpdateByObjectId("Companies",(string)$Companies["_id"], $value);

    }

  //  echo $db->Add("Companies", $value);

  }
