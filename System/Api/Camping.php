<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://cronmy.wegdi.com/modal/Api/kamp.php',
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


    $Companies = $db->Query('Companies',['CompanyCodex' => $value["CompaniesCode"]], [], 'TEK');
    if ($Companies["_id"]!="") {
      $Orderx = array(
        "CampaignName" => $value["CampaignName"],
         "CampaignClick" => (int)$value["CampaignClick"],
         "CampaignClickCost" => (double)$value["CampaignClickCost"],
         "CampaignView" => $value["CampaignView"],
         "CampaignInteraction" =>  $value["CampaignInteraction"],
         "CampaignType" => $value["CampaignType"],
         "CampaignConversion" => (int)$value["CampaignConversion"],
         "CampaignStatus" => $value["CampaignStatus"],
         "Period" => $value["Period"],
         "CampaignId" => (int)$value["CampaignId"],
         "DailyBudget" =>  (double)$value["DailyBudget"],
         "Remaining_Budget" => (double)$value["Remaining_Budget"],
         "CompaniesCode" => (int)$Companies["CompanyCode"],
         "CompanyCodex" => $value["CompaniesCode"],
         "Date" => strtotime($value["Date"])

      );
      print_R($Orderx);

      $Order = $db->Query('GoogleCampaign',['CompaniesCode' => (int)$Companies["CompanyCode"],'Date' => strtotime($value["Date"]),'CampaignId' => (int)$value["CampaignId"]], [], 'TEK');


      if ($Order["_id"]=="") {
        $db->Add("GoogleCampaign", $Orderx);
      }else {
        $db->UpdateByObjectId("GoogleCampaign",(string)$Order["_id"], $Orderx);

      }
    }


  }
