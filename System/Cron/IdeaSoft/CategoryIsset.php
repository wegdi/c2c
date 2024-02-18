<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$filtre = [];

$filtre["IdeaSoftId"]="";

$Category = $db->Query('CategoryList', $filtre, [], 'COK',1,1);

$CategoryOne=[];
foreach ($Category as $key => $value) {
    $CategoryOne[]=$value["CategoryOne"];

}

$CategoryOne=array_unique($CategoryOne);


$NewAlt=[];
$NewAltSon=[];

foreach ($CategoryOne as $keyx => $valuec) {

  ///İlk Kategoriyi Ekle

  $CategoryS = $db->Query('IdeaSoftCategory',['Name' => $valuec], [], 'TEK');

  if ($CategoryS["_id"]=="") {

    $AltKategoriler = $db->Query('CategoryList',['CategoryOne' => $valuec], [], 'COK');
    foreach ($AltKategoriler as $keyAlt => $valueAlt) {

      $deger=array('Marka' => $valuec,'Model' => $valueAlt["CategoryTwo"],'Tur' => $valueAlt["CategoryTree"]);
      print_r($deger);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    		CURLOPT_URL => 'https://c2c.wegdi.com/Modal/Supplier/Category/CategoryCreate.php',
    		CURLOPT_RETURNTRANSFER => true,
    		CURLOPT_ENCODING => '',
    		CURLOPT_MAXREDIRS => 10,
    		CURLOPT_TIMEOUT => 0,
    		CURLOPT_FOLLOWLOCATION => true,
    		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    		CURLOPT_CUSTOMREQUEST => 'POST',
    		CURLOPT_POSTFIELDS => $deger,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response =json_decode($response,1);
    $IdeaSoftId=$response["data"]["IdeaSoftId"];

    $SonDonus = $db->Query('CategoryList',['CategoryOne' => $valuec,'CategoryTwo' => $valueAlt["CategoryTwo"],'CategoryTree' => $valueAlt["CategoryTree"] ], [], 'TEK');

    if ($SonDonus["_id"]!="" and $IdeaSoftId!="") {
      $db->UpdateByObjectId("CategoryList", (string)$SonDonus["_id"], ['IdeaSoftId' => $IdeaSoftId]);

    }



    }





  }


}
