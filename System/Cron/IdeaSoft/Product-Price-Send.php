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


if ($Products["price_one"]!="") {
  $price=$Products["price_one"];

}else {
  $price=$Products["price"];

}


// Resmin uzantısını al
$pathInfo = pathinfo($imageUrl);

echo $pathInfo;

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


function resizeImage($imagePath, $maxWidth, $maxHeight, $extension)
{
    // $imagePath değişkeninin geçerli bir URL olup olmadığını kontrol et
    if (!filter_var($imagePath, FILTER_VALIDATE_URL)) {
        return false;
    }

    // Resmi indir ve geçerli bir resim olup olmadığını kontrol et
    $imageContent = @file_get_contents($imagePath);

    if ($imageContent === false) {
        return false;
    }

    $image = imagecreatefromstring($imageContent);

    // Geçerli bir resim olup olmadığını kontrol et
    if ($image === false) {
        return false;
    }

    $originalWidth = imagesx($image);
    $originalHeight = imagesy($image);

    $widthRatio = $maxWidth / $originalWidth;
    $heightRatio = $maxHeight / $originalHeight;

    $ratio = min($widthRatio, $heightRatio);

    $newWidth = $originalWidth * $ratio;
    $newHeight = $originalHeight * $ratio;

    $newImage = imagecreatetruecolor($maxWidth, $maxHeight);

    $white = imagecolorallocate($newImage, 255, 255, 255); // Beyaz renk

    imagefill($newImage, 0, 0, $white); // Beyaz arka plan ile doldur

    $offsetX = ($maxWidth - $newWidth) / 2;
    $offsetY = ($maxHeight - $newHeight) / 2;

    imagecopyresampled($newImage, $image, $offsetX, $offsetY, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    ob_start();
    imagejpeg($newImage);
    $resizedImageData = ob_get_clean();

    imagedestroy($newImage);
    imagedestroy($image);

    return 'data:image/jpeg;base64,' . base64_encode($resizedImageData);
}


if (strtolower(substr($imageUrl, 0, 7)) === 'http://') {
       $imageUrl = 'https://' . substr($imageUrl, 7);
}

$resizedBase64Data = resizeImage($imageUrl, 1200, 1800, $extension);

// Resmi base64'e çevir
$base64Data = imageToBase64($imageUrl, $extension);



$ProductPost=[
  'name' => $Products["product_name"],
  'slug' => $db->Seflink($Products["product_name"]),
  'sku' => $Products["C2Cmodel"],
  'barcode' => $Products["C2Cmodel"],
  'stockAmount' => $Products["quantity"],
  'price1' => $price,
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
    'details' => $Products["product_name"].' '.$Products["product_description_1"].' '.$Products["product_description_2"].' <br><br><br><br><br><br><a href="https://www.wegdi.com/" title="Dijital Ajans">Entegrasyon hizmeti wegdi.com tarafından sağlanmaktadır.</a>'

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
  echo $db->UpdateByObjectId("Products", (string)$ProductId,$IdeaData);

}


$Image=[
    'filename' => $pathInfo["filename"],
    'extension' => $pathInfo["extension"],
    'sortOrder' => 1,
    'thumbUrl' => 'string',
    'originalUrl' => 'string',
    'attachment' =>  $resizedBase64Data,
    'product' => [

        'id' => $result["id"],

    ]
];


$imageresult = $ideaSoftInstance->post($Image,'product_images');
$imageresult = json_decode($imageresult,1);
