<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();

$filtre=[];
$filtre['CategoryId']=['$ne' => null];
$filtre['IdeaSoft']=0;

$valuex = $db->Query('Products', $filtre,[], 'COK',1,30);

// Curl multi oturumu başlatma
$mh = curl_multi_init();

foreach ($valuex as $key => $value) {
    $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/Product-Price-Send.php?ProductId=" . (string)$value["_id"];

    // Curl oturumu oluşturma
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Curl oturumunu multi oturum ile ilişkilendirme
    curl_multi_add_handle($mh, $ch);
}

// Tüm isteklerin tamamlanmasını beklemek için döngü
$running = null;
do {
    curl_multi_exec($mh, $running);
} while ($running > 0);

// Tüm curl oturumlarını kapatma
foreach ($valuex as $key => $value) {
    curl_multi_remove_handle($mh, $ch);
    curl_close($ch);
}

// Curl multi oturumunu kapatma
curl_multi_close($mh);
?>
