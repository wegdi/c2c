<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
require_once('IdeaSoftFunc.php');

$db = new General();

$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
$ideaSoftInstance = new IdeaSoft($IdeaSoft["domain"],$IdeaSoft["access_token"]);


$Domain=$IdeaSoft["domain"];

$ProductId=$_GET["ProductId"];


$Products = $db->Query('Products', ['_id' => $db->ObjectId($ProductId)], [], 'TEK');

$Brand = $db->Query('Brand', ['Name' => $Products["manufacturer_name"]], [], 'TEK');




$ProductPost=[
  'name' => $Products["product_name"],
  'slug' => $db->Seflink($Products["product_name"]),
  'sku' => $Products["C2Cmodel"],
  'barcode' => $Products["C2Cmodel"],
  'stockAmount' => $Products["quantity"],
  'price1' => $Products["price_one"],
  'currency' => [
      'id' => 1

  ],
  'discount' => 10,
  'discountType' => 1,
  'moneyOrderDiscount' => '',
  'buyingPrice' => '',
  'marketPriceDetail' => 'string',
  'taxIncluded' => 0,
  'tax' => $Products["kdv"],
  'warranty' => 24,
  'volumetricWeight' => 1,
  'stockTypeLabel' => 'Piece',
  'customShippingDisabled' => 0,
  'customShippingCost' => 5,
  'distributor' => 'superTedarik',
  'hasGift' => 0,
  'gift' => '',
  'status' => 0,
  'hasOption' => 0,
  'shortDetails' => '',
  'searchKeywords' => '',
  'installmentThreshold' => '-',
  'homeSortOrder' => 1,
  'popularSortOrder' => 1,
  'brandSortOrder' => 1,
  'featuredSortOrder' => 1,
  'campaignedSortOrder' => 1,
  'newSortOrder' => 1,
  'discountedSortOrder' => 1,
  'categoryShowcaseStatus' => 0,
  'midblockSortOrder' => -2147483648,
  'pageTitle' => $Products["product_name"],
  'metaDescription' => $Products["product_name"].' '.$Products["product_meta_keyword"],
  'metaKeywords' => '',
  'canonicalUrl' => '',

  'brand' => [
      'id' =>  $Brand["BrandId"]
  ],
  'button' => [
      'property1' => [
              'product'
      ],
      'property2' => [
              'product'
      ]
  ],
  'countDown' => [
      'property1' => [
              'product'
      ],
      'property2' => [
              'product'
      ]
  ],

  'categories' => [
      [
          'id' => $Products["CategoryId"],
      ],
  ],
  'prices' => [

  ],
  'distributors' => [

  ],
  'extraInfos' => [

  ],
  'images' => [

  ],
  'tags' => [

  ],
  'mappings' => [

  ],
  'selectionGroups' => [

  ],
  'optionGroups' => [

  ],
  'labels' => [

  ],
  'offeredProducts' => [

  ],
  'combineProducts' => [

  ],
  'customizationGroups' => [

  ],

  'seoSetting' => [
      'property1' => [
              'product'
      ],
      'property2' => [
              'product'
      ]
  ],
  'children' => [

  ]
];



$result = $ideaSoftInstance->post($ProductPost,'products');
$result = json_decode($result,1);
print_r($result);
