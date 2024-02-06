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
        //$kategoriler[] = $kategoribir.' > '. $kategoriiki.' > '.$kategoriuc;

        // Kategoriyi parçala
        $parcali_kategori = explode(" ", $kategoriiki);

        // Dört basamaklı bir sayı içeren kategoriyi bul
        foreach ($parcali_kategori as $parca) {
            // Parçada dört basamaklı bir sayı varsa ve 1960 ile 2025 arasında ise ekrana yazdır
            if (preg_match('/\b\d{4}\b/', $parca) && $parca >= 1960 && $parca <= 2025) {
                echo $value["kod"] .' '.$parca;
                echo "<br>";
                //echo "Dört basamaklı sayı bulundu ve 1960 ile 2025 arasında: $parca<br>";
            }
        }
    }
}


// Dizi elemanlarını artan düzende sıralar
//sort($kategoriler);

// Tekrarlanmayan elemanları alır
//$newArray = array_unique($kategoriler);

//print_r($newArray);

?>
