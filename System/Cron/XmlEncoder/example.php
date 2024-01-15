<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();


$jsonFilePath = $_SERVER['DOCUMENT_ROOT'] . '/System/Cron/XmlEncoder/kategoriler.json';
$jsonData = file_get_contents($jsonFilePath);
$data = json_decode($jsonData, true);
echo '<pre>';
print_r($data);
echo '</pre>';

// Veritabanına kaydetme işlemi
foreach ($data as $kategori) {
    $kategori_title = $kategori['title'];
    $uniqid = uniqid();
    $data = array(
        'Uniqid' => $uniqid,
        'GroupId'=> '0',
        'Title' => $kategori_title
    );
    $db->Add("Category_Menu", $data);
    /*
    //
    foreach ($kategori['alt_kategoriler'] as $alt_kategori) {
        $alt_kategori_title = $alt_kategori['title'];
        $uniqid2 = uniqid();
        $data2 = array(
            'Uniqid' => $uniqid2,
            'GroupId'=> $uniqid,
            'Title' => $alt_kategori_title
        );
        $db->Add("Category_Menu", $data2);

        //
        if(count($alt_kategori['alt_kategoriler2']) > 0){
            foreach ($alt_kategori['alt_kategoriler2'] as $alt_kategori2) {
                $alt_kategori2_title = $alt_kategori2['title'];
                $uniqid3 = uniqid();
                $data3 = array(
                    'Uniqid' => $uniqid3,
                    'GroupId'=> $uniqid2,
                    'Title' => $alt_kategori2_title
                );
                $db->Add("Category_Menu", $data3);
            }
        }
    }
    */
    
}
echo 'bittiii';

?>
