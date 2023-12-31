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
$Invoice = $db->Query('Invoice', ['aliciVknTckn' => (int)$Companies["TaxNumber"]], [], 'COK');
foreach ($Invoice as $key => $value) {
    $data[] = array(
      'belgeTarihi' => date('d-m-y',$value["belgeTarihi"]),
      'belgeNumarasi' => $value["belgeNumarasi"],
      'vergilerDahilToplamTutar' =>  '₺'.number_format($value["vergilerDahilToplamTutar"], 2, ',', '.'),
      'aliciUnvanAdSoyad' =>  $value["aliciUnvanAdSoyad"],
      'Urlc' =>  'https://ads.akillipanda.com/System/Cron/Invoice/GetInvoice.php?id='.$value["faturaUuid"],

    );
}
echo json_encode($data);
}
?>
