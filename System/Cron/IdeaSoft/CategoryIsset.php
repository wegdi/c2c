<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$filtre = [];
$filtre["ParentId"]=0;
$Category = $db->Query('IdeaSoftCategory', $filtre, [], 'COK');

$CategoryOne=[];
foreach ($Category as $key => $value) {

if ($value["IdeaSoftId"] > 64914) {

  $CategoryList = $db->Query('CategoryList',['IdeaSoftId' => '','CategoryOne' => $value["Name"]], [], 'COK');

  foreach ($CategoryList as $keycs => $valuecs) {

    print_r($valuecs);
    $deger=array('Marka' =>  $valuecs["CategoryOne"],'Model' => $valuecs["CategoryTwo"],'Tur' => $valuecs["CategoryTree"]);
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
    $response=json_decode($response,1);
    $IdeaSoftId=$response["data"]["IdeaSoftId"];

    echo $IdeaSoftId;

    $SonDonus = $db->Query('CategoryList',['CategoryOne' => $valuecs["CategoryOne"],'CategoryTwo' => $valuecs["CategoryTwo"],'CategoryTree' => $valuecs["CategoryTree"] ], [], 'TEK');

    if ($SonDonus["_id"]!="" and $IdeaSoftId!="") {
      echo $db->UpdateByObjectId("CategoryList", (string)$SonDonus["_id"], ['IdeaSoftId' => $IdeaSoftId]);

    }

  }
}
}
