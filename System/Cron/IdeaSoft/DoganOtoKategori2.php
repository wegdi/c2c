<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

$suppliers = $db->Query('Supplier', ["Status" => 1], [], 'COK');

$kategoriler = [];
foreach ($suppliers as $supplier) {
    $filePath = $_SERVER['DOCUMENT_ROOT'] . $supplier["SupplierFilePath"];
    $jsonData = file_get_contents($filePath);
    $decodedData = json_decode($jsonData, true);


    foreach ($decodedData["stok"] as $key => $value) {
        //$kategoriler[] =$value["cokluKategori"];
        $kategoribir = $value["marka"];
        $kategoriiki = str_replace('-', '', $value["kategori"]) . ' Sonrası';
        $kategoriuc = $value["model"];
        //print_r($value);
        // Kategoriyi parçala
        $parcali_kategori = explode(" ", $kategoriiki);

        // Dört basamaklı bir sayı içeren kategoriyi bul
        foreach ($parcali_kategori as $parca) {
            // Parçada dört basamaklı bir sayı varsa ve 1960 ile 2025 arasında ise ekrana yazdır
            if (preg_match('/\b\d{4}\b/', $parca) && $parca >= 1960 && $parca <= 2025) {

              $bul = array("TAMPON BRAKETLERİ","TAMPON DEMİRİ VE TRAVERS","DAVLUMBAZ", "RADYATÖR", "BAGAJ KAPAĞI", "ETEK SACI", "Kapı Bantları", "Kapı Kolu", "Kapı ve Kapı Sacları", "Motor Kaputları", "Panjur", "Spoyler", "Tampon", "Tampon ek Parçalar", "Tuning", "Çamurluk", "Ön Cam Izgara",);

              $bul = array_map('strtoupper', $bul);

              // Çıktı: Burada 5 ve 6 yazıyor

              $metin = str_replace($bul,"Karoser İç Parçalar", $kategoriuc);


                $kategoriler[] = $kategoribir.' > ' .$parcali_kategori[0].'  > '. $parca.' > '.$metin;


                //echo "Dört basamaklı sayı bulundu ve 1960 ile 2025 arasında: $parca<br>";
            }
        }



    }
}

sort($kategoriler);

$newArray = array_unique($kategoriler);
echo count($newArray);
print_r($newArray);

?>
