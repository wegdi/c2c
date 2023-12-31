<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();
date_default_timezone_set('Europe/London');
header('Content-Type: application/json');

$Token = $_POST["token"];
$UserControl = $db->Query('Users', ['mobiltoken' => (string)$Token], [], 'TEK');
if ($UserControl["_id"]!="") {
  // code...


$Companies = $db->Query('Companies', ['CompanyCode' => (int)$UserControl["CompanyCode"]], [], 'TEK');
$Date = date('Y-m-d');
$singleDate = strtotime($Date);
$GoogleKeyword = $db->Query('GoogleKeyword', ['CompaniesCode' => (int)$UserControl["CompanyCode"],'Date' => (int)$singleDate,'AdGroupId' => (int)$_POST["GroupId"]], [], 'COK');

foreach ($GoogleKeyword as $key => $value) {
    $data[] = array(
      'Keyword' => $value["Keyword"],
      'Conversions' => $value["Conversions"],
      'Impressions' => $value["Impressions"],
      'CostMicros' => $value["CostMicros"],
      'AverageCpm' => $value["AverageCpm"],
      'AverageCost' => $value["AverageCost"],
      'MatchType' => $value["MatchType"],
      'Type' => $value["Type"],
      'Status' => $value["Status"],
      'Clicks' => $value["Clicks"],




    );
}
echo json_encode($data);
}
?>
