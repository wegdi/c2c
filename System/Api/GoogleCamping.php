<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();
date_default_timezone_set('Europe/London');
header('Content-Type: application/json');

$Token = $_POST["token"];
$UserControl = $db->Query('Users', ['mobiltoken' => (string)$Token], [], 'TEK');
if ($UserControl["_id"]!="") {

$Companies = $db->Query('Companies', ['CompanyCode' => (int)$UserControl["CompanyCode"]], [], 'TEK');
$Date = date('Y-m-d');
$singleDate = strtotime($Date);
$GoogleKeyword = $db->Query('GoogleCampaign', ['CompaniesCode' => (int)$UserControl["CompanyCode"],'Date' => (int)$singleDate], [], 'COK');

foreach ($GoogleKeyword as $key => $value) {
    $data[] = array(
      'CampaignName' => $value["CampaignName"],
      'CampaignClick' => $value["CampaignClick"],
      'CampaignClickCost' =>  $value["CampaignClickCost"],
      'DailyBudget' =>  '₺'.number_format($value["DailyBudget"], 2, ',', '.'),
      'CampaignType' =>  $value["CampaignType"],
      'CampaignStatus' =>  $value["CampaignStatus"],
      'CampaignId' =>  $value["CampaignId"],


    );
}
echo json_encode($data);
}
?>
