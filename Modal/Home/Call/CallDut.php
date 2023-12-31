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
    $Calls = $db->Query('Calls', $filter, [], 'COK');
    $toplamfiyat = 0;
    foreach ($Calls as $key => $value) {
      $toplamfiyat = $toplamfiyat+ $value['duration'];
    }



    $filterx = [
        "calldate_ts" => [
            '$gte' => (string)$startTimestamp,
            '$lte' => (string)$endTimestamp
        ],
        "calltype" => "2",
        "dst" => (string)$Phone
    ];

    $Callsx = $db->Query('Calls', $filterx, [], 'COK');
    $toplamfiyaxt = 0;
    foreach ($Callsx as $key => $value) {
      $toplamfiyatx = $toplamfiyaxt+ $value['duration'];
    }




    $filterxx = [
        "calldate_ts" => [
            '$gte' => (string)$startTimestamp,
            '$lte' => (string)$endTimestamp
        ],
        "calltype" => "2",
        "dst" => (string)$Phone
    ];

    $Callsxx = $db->Query('Calls', $filterxx, [], 'COK');
    $toplamfiyatxx = 0;
    foreach ($Callsxx as $key => $value) {
      $toplamfiyatxx = $toplamfiyatxx+ $value['duration'];
    }

    $Data[] = ($toplamfiyat+$toplamfiyatx+$toplamfiyatxx)/60;

  }


$Response = array(
  'label' => 'Arama Süresi (Saat)',
  'Labels' => $aylar,
  'Data' => $Data
);
echo json_encode($Response);
?>
