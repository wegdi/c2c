<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://cronmy.wegdi.com/modal/Api/odemeler.php',
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
    print_R($value);
    $Companies = $db->Query('Companies',['CompanyCodex' => (string)$value["firma"]], [], 'TEK');

      $Orderx = array(
        'PaymentAmount' => (double)$value["odeme_tutar"],
        'OrderID' => (string)$value["odeme_rand_id"],
        'Condition' => $value["odeme_kosul"],
        'CompanyCode' => $Companies["CompanyCode"],
        'Date' => strtotime($value["zaman"]),
        'CompanyCode' => (int)$Companies["CompanyCode"],
        'Status' => 1,
        'Invoice' => (int)$value["fatura"],
        'Message' => $value["mesaj"],
        'Id' => (int)$value["odeme_id"]

      );
      $Order = $db->Query('Order',['Id' => (int)$value["odeme_id"]], [], 'TEK');


      if ($Order["_id"]=="") {
        $db->Add("Order", $Orderx);
      }else {
        $db->UpdateByObjectId("Order",(string)$Order["_id"], $Orderx);
      }


  }
