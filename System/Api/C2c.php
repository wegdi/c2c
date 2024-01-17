<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();




$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://mfkoto.myideasoft.com/admin-api/categories",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'id' => 123,
    'name' => 'Kırtasiye',
    'slug' => 'kirtasiye',
    'sortOrder' => 999,
    'status' => 0,
    'distributor' => '',
    'percent' => 1,
    'imageFile' => 'kalem.jpg',
    'displayShowcaseContent' => 0,
    'showcaseContent' => 'Üst içerik metni.',
    'showcaseContentDisplayType' => 1,
    'displayShowcaseFooterContent' => 0,
    'showcaseFooterContent' => 'string',
    'showcaseFooterContentDisplayType' => 1,
    'hasChildren' => 0,
    'pageTitle' => 'string',
    'metaDescription' => 'Kaliteli kırtasiye ürünleri.',
    'metaKeywords' => 'kırmızı, kalem, kırtasiye',
    'canonicalUrl' => 'kategoriler/idea-kalem',
    'attachment' => 'string',
    'parent' => [
        'property1' => [
                'category'
        ],
        'property2' => [
                'category'
        ]
    ],
    'isCombine' => 0,
    'seoSetting' => [
        'property1' => [
                'category'
        ],
        'property2' => [
                'category'
        ]
    ]
  ]),
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Authorization: Bearer NDhmMDdjMTU0NDc5NWIwNzA2OTA1ZGNhZjAyZjU3YWZlNmUwNmYzNjNlNzBiYTExMzZkNTAzNGYwMTA3NzljMA",
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

?>
