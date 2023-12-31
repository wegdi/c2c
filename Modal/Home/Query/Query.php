<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();
date_default_timezone_set($db->GetSystem("TimeZone"));
header('Content-Type: application/json; charset=utf-8');

$aylar = [
    "Ocak",
    "Şubat",
    "Mart",
    "Nisan",
    "Mayıs",
    "Haziran",
    "Temmuz",
    "Ağustos",
    "Eylül",
    "Ekim",
    "Kasım",
    "Aralık"
];

$Data = [];
$Dataone = [];
$Datatwo=[];

$year = date("Y"); // Geçerli yılı al

for ($i = 1; $i <= 12; $i++) {
    $startTimestamp = strtotime("$year-$i-01");
    $endTimestamp = strtotime("$year-$i-31");

    $filter = [
        "Date" => [
            '$gte' => (int)$startTimestamp,
            '$lte' => (int)$endTimestamp
        ],
        "CompaniesCode" => (int)$db->GetUser('CompanyCode'),
    ];
    $GoogleCampaign = $db->Query('GoogleCampaign', $filter, [], 'COK');
    $toplamfiyat = 0;
    $toplamtiklama= 0;
    $toplamharcama= 0;

    foreach ($GoogleCampaign as $key => $value) {
      $toplamfiyat = $toplamfiyat+ $value['CampaignConversion'];
      $toplamtiklama = $toplamtiklama+ $value['CampaignClick'];
      $toplamharcama = $toplamharcama+ $value['Remaining_Budget'];

    }

    $Data[]=$toplamfiyat;
    $Dataone[]=$toplamtiklama;
    $Datatwo[]=$toplamharcama;


}


$Response = array(
    'Conversions' =>  array(
    'label' => 'Dönüşümler',
     'Labels' => $aylar,
     'Data' => $Data
   ),
   'Click' =>  array(
   'label' => 'Tıklamalar',
    'Labels' => $aylar,
    'Data' => $Dataone
  ),
  'Amount' =>  array(
  'label' => 'Harcanan Tutar',
   'Labels' => $aylar,
   'Data' => $Datatwo
 )

);
echo json_encode($Response);
?>
