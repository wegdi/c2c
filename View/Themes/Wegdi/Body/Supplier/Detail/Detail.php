<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

// JSON dosyasının URL'si
$jsonUrl = 'https://c2c.wegdi.com/Json/65968ec9c3a67.json';

// JSON verisini alma
$jsonData = file_get_contents($jsonUrl);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($jsonData, true);

$donguler = [];
$final = [];
// Üst anahtarları yazdırma
foreach ($data as $ustAnahtar => $altDizi) {
    // Üst anahtarı string olarak almak istiyorsak
    $ustAnahtarString = is_string($ustAnahtar) ? $ustAnahtar : json_encode($ustAnahtar);

    echo "Üst Anahtar: " . $ustAnahtarString . "<br>";
    $donguler[] = $ustAnahtarString;

    // Alt diziyi yazdırma
    foreach ($altDizi as $altAnahtar => $deger) {
        // Alt anahtarı sadece int değilse yazdır
        if (!is_int($altAnahtar)) {
            // Alt anahtarı string olarak almak istiyorsak
            $altAnahtarString = is_string($altAnahtar) ? $altAnahtar : json_encode($altAnahtar);

            echo "    Alt Anahtar: " . $altAnahtarString . "<br>";
            $donguler[] = $altAnahtarString;
        }
    }

    echo "<br>";
}

echo count($donguler);


if (count($donguler)==1) {

  foreach ($data["$donguler[0]"] as $key => $value) {
      print_r($value);
  }




}elseif (count($donguler)==2) {
  foreach ($data["$donguler[0]"]["$donguler[1]"] as $key => $value) {
    if (!empty($value)) {
        // PHP dizisinin ilk elemanını alın
        $ilkDeger = reset($value);
    }
  }

}

/*
if (!empty($final)) {
    // PHP dizisinin ilk elemanını alın
    $ilkDeger = reset($final);
}



foreach ($ilkDeger as $key => $value) {
echo $key.' '.$value;
echo "<br>";
}
*/
?>
