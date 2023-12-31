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
$GoogleKeyword = $db->Query('GoogleAdGroup', ['CompaniesCode' => (int)$UserControl["CompanyCode"],'Date' => (int)$singleDate,'CampaignId' => (string)$_POST["CampaignId"]], [], 'COK');

foreach ($GoogleKeyword as $key => $value) {
    $data[] = array(
      'GroupName' => $value["Name"],
      'GroupClick' => $value["Clicks"],
      'GroupClickCost' => $value["CostMicros"],
      'GroupConversions' => $value["Conversions"],
      'GroupId' => $value["Id"],


    );
}
echo json_encode($data);
}
?>
