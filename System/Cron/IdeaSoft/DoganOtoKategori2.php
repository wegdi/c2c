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

    $itemsPerPage = 600; // Her sayfada kaç öğe gösterileceğini belirtin
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1; // Sayfa numarasını alın

    $startIndex = ($page - 1) * $itemsPerPage;


    $slicedStok = array_slice($decodedData["stok"],$startIndex, $itemsPerPage);


    foreach ($slicedStok as $key => $value) {
        //$kategoriler[] =$value["cokluKategori"];
        $kategoribir = $value["marka"];
        $kategoriiki = str_replace('-', '', $value["kategori"]);
        $kategoriuc = $value["model"];
        $kategoriler[] = $kategoribir.' > ' .$kategoriiki.'  > '. $kategoriuc;
        $kategorilerfull = $kategoribir.' > ' .$kategoriiki.'  > '. $kategoriuc;


        $Products = $db->Query('Products', ["SupplierCode" => $supplier["SupplierCode"], "model" => $value["kod"]], [], 'TEK');

        if ($Products["_id"] != "") {

            $value = array(
              'CategoryOne' => $kategoribir,
              'CategoryTwo' => $kategoriiki,
              'CategoryTree' => $kategoriuc,
              'CategoryFull' => $kategorilerfull

            );
            $db->UpdateByObjectId("Products", (string)$Products["_id"], $value);

        }

    }
}

sort($kategoriler);

$newArray = array_unique($kategoriler);
echo count($newArray);
print_r($newArray);

?>
