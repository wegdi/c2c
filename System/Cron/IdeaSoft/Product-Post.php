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

$imageUrl=$Products["main_image"];

// Resmin uzantısını al
$pathInfo = pathinfo($imageUrl);

$extension = $pathInfo['extension'];

// Resmi base64'e çevirme fonksiyonu
function imageToBase64($imageUrl, $extension)
{
    // Resmi URL'den indir
    $imageData = file_get_contents($imageUrl);

    // Base64'e çevir ve başlık ekleyerek uzantıyı belirt
    $base64Data = 'data:image/' . $extension . ';base64,' . base64_encode($imageData);

    return $base64Data;
}

// Resmi base64'e çevir
$base64Data = imageToBase64($imageUrl, $extension);



$ProductPost=[
  'name' => $Products["product_name"],
  'slug' => $db->Seflink($Products["product_name"]),
  'sku' => $Products["C2Cmodel"],
  'barcode' => $Products["C2Cmodel"],
  'stockAmount' => $Products["quantity"],
  'price1' => $Products["price_one"],
  'currency' => [
      'id' => 3

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
  'shortDetails' => $Products["product_name"],
  'searchKeywords' => '',
  'installmentThreshold' => '-',
  'categoryShowcaseStatus' => 1,
  'midblockSortOrder' => -2147483648,
  'pageTitle' => $Products["product_name"],
  'metaDescription' => $Products["product_name"].' '.$Products["product_meta_keyword"],
  'metaKeywords' => '',
  'canonicalUrl' => '',
  'detail' => [
    'details' => $Products["product_name"].' '.$Products["product_description_1"].' '.$Products["product_description_2"]
  ],

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
      'filename' => $pathInfo["filename"],  // İsteğe bağlı bir dosya adı belirtin
      'extension' => $pathInfo["extension"],                // İsteğe bağlı bir dosya uzantısı belirtin
    ],

  ]
];




$result = $ideaSoftInstance->post($ProductPost,'products');
$result = json_decode($result,1);


if ($result["id"]) {

  $IdeaData = array(
    'IdeaSoft' => 1,
    'IdeaSoftProductId' => $result["id"],
 );
  $db->UpdateByObjectId("Products", (string)$ProductId,$IdeaData);

}


$Image=[
    'filename' => $pathInfo["filename"],
    'extension' => $pathInfo["extension"],
    'sortOrder' => 1,
    'thumbUrl' => 'string',
    'originalUrl' => 'string',
    'attachment' =>  $base64Data,
    'product' => [

        'id' => $result["id"],

    ]
];


$imageresult = $ideaSoftInstance->post($Image,'product_images');
$imageresult = json_decode($imageresult,1);
