<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
require_once('IdeaSoftFunc.php');

$db = new General();

$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
$ideaSoftInstance = new IdeaSoft($IdeaSoft["domain"],$IdeaSoft["access_token"]);


$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');


$BrandGt = $db->Query('Brand',[], [], 'COK');

foreach ($BrandGt as $key => $value) {


  $Brand=[
      'name' => $value["Name"],
      'slug' => 'string',
      'status' => 0,
      'sortOrder' => 999,
      'showcaseContent' => '',
      'displayShowcaseContent' => 0,
      'pageTitle' => $value["Name"],
      'metaDescription' => $value["Name"].' yedek parça ürünleri.',
      'canonicalUrl' => 'marka/'.$db->Seflink($value["Name"]),
      'attachment' => '',

    ];

    $result = $ideaSoftInstance->post($Brand,'brands');
    $result = json_decode($result,1);

    $data = array('BrandId' => $result["id"]);
    echo $db->UpdateByObjectId("Brand", (string)$value["_id"], $data);

}




//
