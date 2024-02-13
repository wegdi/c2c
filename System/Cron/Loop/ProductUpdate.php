<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();

$Products = $db->Quantity('Products', ['IdeaSoft' => 1]);

// Örnek bir $value dizisi tanımla
$value = array("SupplierCode" => "örnek_değer");

// Çoklu cURL oturumu oluştur
$mh = curl_multi_init();

// Her sayfa için bir cURL oturumu başlat
for ($i = 1; $i <= ceil($Products / 40); $i++) {
    $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/Product-Price-Update.php?page=".$i;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Curl oturumunu multi oturum ile ilişkilendirme
    curl_multi_add_handle($mh, $ch);
}

// Tüm istekler tamamlanana kadar döngüde kal
$active = null;
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);

// Tüm istekler tamamlandığında döngüden çık
while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) != -1) {
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
}

// Çoklu cURL oturumu kapat
curl_multi_close($mh);
