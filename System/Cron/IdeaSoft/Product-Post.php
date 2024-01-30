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


$base64Data = $Products["main_image"];

// Veri tipi ve diğer meta bilgilerini çıkartın
$data = explode(',', $base64Data);
$imageData = end($data);

// Base64 verisini decode edin
$imageBinary = base64_decode($imageData);

// Resmi geçici bir dosyaya yazın (isteğe bağlı)
$tempFileName = tempnam(sys_get_temp_dir(), 'image_');
file_put_contents($tempFileName, $imageBinary);
echo $tempFileName;


$ProductPost=[
  'name' => $Products["product_name"],
  'slug' => $db->Seflink($Products["product_name"]),
  'sku' => $Products["C2Cmodel"],
  'barcode' => $Products["C2Cmodel"],
  'stockAmount' => $Products["quantity"],
  'price1' => $Products["price_one"],
  'currency' => [
      'id' => 0

  ],
  'discount' => 0,
  'discountType' => 1,
  'moneyOrderDiscount' => '',
  'buyingPrice' => '',
  'marketPriceDetail' => '',
  'taxIncluded' => 1,
  'tax' => $Products["kdv"],
  'warranty' => 24,
  'volumetricWeight' => 1,
  'stockTypeLabel' => 'Piece',
  'customShippingDisabled' => 0,
  'customShippingCost' => 5,
  'distributor' => 'superTedarik',
  'hasGift' => 0,
  'gift' => '',
  'status' => 1,
  'hasOption' => 0,
  'shortDetails' => '',
  'searchKeywords' => '',
  'installmentThreshold' => '-',
  'homeSortOrder' => 0,
  'popularSortOrder' => 0,
  'brandSortOrder' => 0,
  'featuredSortOrder' => 0,
  'campaignedSortOrder' => 0,
  'newSortOrder' => 0,
  'discountedSortOrder' => 0,
  'categoryShowcaseStatus' => 0,
  'midblockSortOrder' => -2147483648,
  'pageTitle' => $Products["product_name"],
  'metaDescription' => $Products["product_name"].' '.$Products["product_meta_keyword"],
  'metaKeywords' => '',
  'canonicalUrl' => '',

  'brand' => [
      'id' =>  $Brand["BrandId"]
  ],


  'categories' => [
      [
          'id' => $Products["CategoryId"],
      ],
  ],
  'images' => [
    [
      'filename' => 'product_image',  // İsteğe bağlı bir dosya adı belirtin
      'extension' => 'jpg',                // İsteğe bağlı bir dosya uzantısı belirtin
      'file' => new CURLFile($tempFileName)
    ],

  ]
];



$result = $ideaSoftInstance->post($ProductPost,'products');
$result = json_decode($result,1);
print_r($result);
