<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();
$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');

$Domain=$IdeaSoft["domain"];

$ProductId=$_GET["ProductId"];


$Products = $db->Query('Products', ['_id' => $db->ObjectId($ProductId)], [], 'TEK');



$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => $Domain."/admin-api/products",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'name' => $Products["product_name"],
    'slug' => $db->Seflink($Products["product_name"]),
    'sku' => $Products["C2Cmodel"],
    'barcode' => $Products["C2Cmodel"],
    'stockAmount' => $Products["quantity"],
    'price1' => $Products["price_one"],
    'currency' => [
        'property1' => [
                'product',
                'subscription_product',
                'tabbed_midblock_product',
                'draft_order'
        ],
        'property2' => [
                'product',
                'subscription_product',
                'tabbed_midblock_product',
                'draft_order'
        ]
    ],
    'discount' => 0,
    'discountType' => 0,
    'moneyOrderDiscount' => 10,
    'buyingPrice' => $Products["price_one"],
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
    'parent' => [
        'property1' => [
                'product'
        ],
        'property2' => [
                'product'
        ]
    ],
    'brand' => [
        'property1' => [
                'product',
                'stock_warning',
                'midblock'
        ],
        'property2' => [
                'product',
                'stock_warning',
                'midblock'
        ]
    ],
    'detail' => [
        'property1' => [
                'product'
        ],
        'property2' => [
                'product'
        ]
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
    'specialInfo' => [
        'property1' => [
                'product'
        ],
        'property2' => [
                'product'
        ]
    ],
    'specGroup' => [
        'property1' => [
                'product'
        ],
        'property2' => [
                'product'
        ]
    ],
    'protection' => [
        'property1' => [
                'product'
        ],
        'property2' => [
                'product'
        ]
    ],
    'categories' =>   [
      (string)$Products["CategoryId"]
    ],
    'prices' => [
      $Products["price_one"]
    ],
    'distributors' => [

    ],
    'extraInfos' => [

    ],
    'images' => [
      $Products["main_image"]
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
    'midblock' => [
        'property1' => [
                'product'
        ],
        'property2' => [
                'product'
        ]
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
  ]),
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Authorization: Bearer ".$IdeaSoft["access_token"],
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
