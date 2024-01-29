<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
require_once('IdeaSoftFunc.php');

$db = new General();

$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
$ideaSoftInstance = new IdeaSoftPost($IdeaSoft["domain"],$IdeaSoft["access_token"]);


$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');


$BrandGt = $db->Query('Brand', [], [], 'COK');

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
      'seoSetting' => [
          'property1' => [
                  'brand'
          ],
          'property2' => [
                  'brand'
          ]
      ]
    ];
    print_r($Brand);

}




//$result = $ideaSoftInstance->post($yourPostData, $yourApiUrl);
