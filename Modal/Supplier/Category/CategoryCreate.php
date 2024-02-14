<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
//require_once(SYSTEM.'Cron/IdeaSoft/IdeaSoftFunc.php');
$db=new General();
//$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
//$ideaSoftInstance = new IdeaSoft($IdeaSoft["domain"],$IdeaSoft["access_token"]);
$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
$token =$IdeaSoft["access_token"];
$Category1 = $db->Query('IdeaSoftCategory',['Name' => (string)$_POST["Marka"]], [], 'TEK');
if($Category1["_id"] != ""){
  //kategori1 var ise
  $ideasoftidd = $Category1["IdeaSoftId"];
}else{
  // kategori 1 ideasoft ekle
  $data = [
    'name' => $_POST["Marka"],
    'sortOrder' => 999,
    'status' => 1,
    'distributor' => '',
    'percent' => 1,
    'displayShowcaseContent' => 0,
    'showcaseContent' => 'Üst içerik metni.',
    'showcaseContentDisplayType' => 1,
    'displayShowcaseFooterContent' => 0,
    'showcaseFooterContent' => 'string',
    'showcaseFooterContentDisplayType' => 1,
    'hasChildren' => 0,
    'pageTitle' => 'string',
    'metaDescription' => '',
    'metaKeywords' => '',
    'canonicalUrl' => '',
    'attachment' => 'string',
    'isCombine' => 0
  ];

  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL => $IdeaSoft["domain"]."/admin-api/categories",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
      "Accept: application/json",
      "Authorization: Bearer $token",
      "Content-Type: application/json"
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  //$response = $ideaSoftInstance->post($data,'categories');
  $response = json_decode($response,true);
  if($response["id"] != ""){
    $ideasoftidd = $response["id"];
    $dataadd = array(
        'Name' => $response["name"],
        'Slug' => $response["slug"],
        'IdeaSoftId'  =>  $ideasoftidd,
        'Status'  =>  1,
        'ParentId'  =>  0
    );
    $result = $db->Add("IdeaSoftCategory", $dataadd);
  }
}


$model_name = $_POST["Model"];
$Model = $db->Query('IdeaSoftCategory',['Name' => (string)$model_name], [], 'TEK');
if($Model["IdeaSoftId"] != ""){
  //model varsa
  $ideasoftidd = $Model["IdeaSoftId"];
}else{
  //model yok ideasoft ekle
  $data2 = [
    'name' => $_POST["Model"],
    'sortOrder' => 999,
    'status' => 1,
    'distributor' => '',
    'percent' => 1,
    'displayShowcaseContent' => 0,
    'showcaseContent' => 'Üst içerik metni.',
    'showcaseContentDisplayType' => 1,
    'displayShowcaseFooterContent' => 0,
    'showcaseFooterContent' => 'string',
    'showcaseFooterContentDisplayType' => 1,
    'hasChildren' => 0,
    'pageTitle' => 'string',
    'metaDescription' => '',
    'metaKeywords' => '',
    'canonicalUrl' => '',
    'attachment' => 'string',
    'parent' => [
        'id' => $ideasoftidd
    ]
  ];
  $curl2 = curl_init();
  curl_setopt_array($curl2, [
    CURLOPT_URL => $IdeaSoft["domain"]."/admin-api/categories",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data2),
    CURLOPT_HTTPHEADER => [
      "Accept: application/json",
      "Authorization: Bearer $token",
      "Content-Type: application/json"
    ],
  ]);
  $response2 = curl_exec($curl2);
  $err2 = curl_error($curl2);
  curl_close($curl2);
  //$response = $ideaSoftInstance->post($data,'categories');
  $response2 = json_decode($response2,true);
  if($response2["id"] != ""){
    $name2 = $response2["name"];
    $ideasoftidd2 = $response2["id"];
    $dataadd2 = array(
        'Name' => (string)$name2,
        'Slug' => $response2["slug"],
        'IdeaSoftId'  =>  (int)$ideasoftidd2,
        'Status'  =>  1,
        'ParentId'  =>  (int)$ideasoftidd
    );
    $result = $db->Add("IdeaSoftCategory", $dataadd2);
  }
}

function ilkHarfiBuyut($cumle) {
  $kelimeler = explode(" ", $cumle);
  $duzeltilmisCumle = "";
  foreach ($kelimeler as $kelime) {
      $ilkHarf = strtoupper(substr($kelime, 0, 1));
      $geriKalan = strtolower(substr($kelime, 1));
      $duzeltilmisCumle .= $ilkHarf . $geriKalan . " ";
  }
  return rtrim($duzeltilmisCumle);
}

$box1 = array('Aydınlatma', 'Far Grubu');
$box1_grup = 'Dış Aydınlatma Ürünleri';
$box2 = array('Yağ ve Su Bidonları');
$box2_grup = 'Motor ve Mekanik Parçaları';
$box3 = array('Hava Filitre Kutusu');
$box3_grup = 'Periyodik Bakım Ürünleri';
$box4 = array('Far Yıkama Robotu');
$box4_grup = 'Sensör,Valf ve Elektrik Ürünleri';
$box5 = array('Davlumbaz', 'Radyatör', 'Tampon Demiri ve Travers', 'Torpido', 'Kaput Menteşeleri', 'Fan', 'Fan Davlumbazı', 'Karter ve Alt Muhafaza', 'Marşbiyel Bakaliti', 'Panel', 'Motor Üst Kapağı');
$box5_grup = 'Karoser İç Parçalar';
$box6 = array('Ayna', 'Bagaj Kapagı', 'Body Kit', 'Etek Sacı', 'Kapı Bantları', 'Kapı Kolu', 'Kapı ve Kapı Sacları', 'Motor Kaputları', 'PANJUR', 'Spoyler', 'Tampon', 'Tampon ek Parçalar', 'Tuning', 'Çamurluk', 'Ön Cam Izgara');
$box6_grup = 'Karoser Dış Parçalar';
$tur_title = '';
$tur_type = ilkHarfiBuyut($_POST["Tur"]);
if(in_array($tur_type, $box1)){
  $tur_title = $box1_grup;
}elseif(in_array($tur_type, $box2)){
  $tur_title = $box2_grup;
}elseif(in_array($tur_type, $box3)){
  $tur_title = $box3_grup;
}elseif(in_array($tur_type, $box4)){
  $tur_title = $box4_grup;
}elseif(in_array($tur_type, $box5)){
  $tur_title = $box5_grup;
}elseif(in_array($tur_type, $box6)){
  $tur_title = $box6_grup;
}

$tur_name = $_POST["Marka"]." -> ".$_POST["Model"]." -> ".$tur_title;
$Tur = $db->Query('Category',['Name' => (string)$tur_name], [], 'TEK');
if($Tur["IdeaSoftId"] != ""){
  //Tur varsa
  $ideasoftidd2 = $Tur["IdeaSoftId"];
}else{
  //Tur yok ideasoft ekle
  $data3 = [
    'name' => $tur_title,
    'sortOrder' => 999,
    'status' => 1,
    'distributor' => '',
    'percent' => 1,
    'displayShowcaseContent' => 0,
    'showcaseContent' => 'Üst içerik metni.',
    'showcaseContentDisplayType' => 1,
    'displayShowcaseFooterContent' => 0,
    'showcaseFooterContent' => 'string',
    'showcaseFooterContentDisplayType' => 1,
    'hasChildren' => 0,
    'pageTitle' => 'string',
    'metaDescription' => '',
    'metaKeywords' => '',
    'canonicalUrl' => '',
    'attachment' => 'string',
    'parent' => [
        'id' => $ideasoftidd2
    ]
  ];
  $curl3 = curl_init();
  curl_setopt_array($curl3, [
    CURLOPT_URL => $IdeaSoft["domain"]."/admin-api/categories",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data3),
    CURLOPT_HTTPHEADER => [
      "Accept: application/json",
      "Authorization: Bearer $token",
      "Content-Type: application/json"
    ],
  ]);
  $response3 = curl_exec($curl3);
  $err3 = curl_error($curl3);
  curl_close($curl3);
  $response3 = json_decode($response3,true);
  //print_r($response3);
  if($response3["id"] != ""){
    $name3 = $response3["name"];
    $ideasoftidd3 = $response3["id"];
    $dataadd3 = array(
        'Name' => (string)$name3,
        'Slug' => $response3["slug"],
        'IdeaSoftId'  =>  (int)$ideasoftidd3,
        'Status'  =>  1,
        'ParentId'  =>  (int)$ideasoftidd2
    );
    $result = $db->Add("IdeaSoftCategory", $dataadd3);
  }
}
print_r($result);

?>
