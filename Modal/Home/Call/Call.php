<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();
date_default_timezone_set($db->GetSystem("TimeZone"));


$Phone=$db->GetUser("Phone");
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

$year = date("Y"); // Geçerli yılı al

for ($i = 1; $i <= 12; $i++) {
    $startTimestamp = strtotime("$year-$i-01");
    $endTimestamp = strtotime("$year-$i-31");

    $filter = [
        "calldate_ts" => [
            '$gte' => (string)$startTimestamp,
            '$lte' => (string)$endTimestamp
        ],
        "calltype" => "3",
        "src" => (string)$Phone
    ];
    $callData=$db->Quantity("Calls",$filter);

    $filterx = [
        "calldate_ts" => [
            '$gte' => (string)$startTimestamp,
            '$lte' => (string)$endTimestamp
        ],
        "calltype" => "2",
        "dst" => (string)$Phone
    ];
    $callDatax=$db->Quantity("Calls",$filterx);

    $filterxx = [
        "calldate_ts" => [
            '$gte' => (string)$startTimestamp,
            '$lte' => (string)$endTimestamp
        ],
        "calltype" => "1",
        "dst" => (string)$Phone
    ];
    $callDataxx=$db->Quantity("Calls",$filterxx);



    $Data[] = $callData+$callDatax+$callDataxx;

  }


$Response = array(
  'label' => 'Arama İstatistikleriniz',
  'Labels' => $aylar,
  'Data' => $Data
);
echo json_encode($Response);
?>
