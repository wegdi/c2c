<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
//require_once(SECURITY.'Security.php');
//$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
//require_once(SYSTEM.'Cron/IdeaSoft/IdeaSoftFunc.php');
$db=new General();
//$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
//$ideaSoftInstance = new IdeaSoft($IdeaSoft["domain"],$IdeaSoft["access_token"]);
$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
$domain = $IdeaSoft["domain"];
$token =$IdeaSoft["access_token"];
if(empty($token)){
  echo json_encode([
    'success' => false,
    'message' =>  'access_token null!'
  ]);
  exit;
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

function CategoryCreateCurl($domain, $token, $data) {
  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL => $domain."/admin-api/categories",
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
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}



$control = false;

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

  $response = CategoryCreateCurl($domain, $token, $data);
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
  $ideasoftidd2 = $Model["IdeaSoftId"];
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
  $response2 = CategoryCreateCurl($domain, $token, $data2);
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



$box1 = array('AYDINLATMA', 'FAR GRUBU');
$box1_grup = 'Dış Aydınlatma Ürünleri';
$box2 = array('YAĞ VE SU BİDONLARI');
$box2_grup = 'Motor ve Mekanik Parçaları';
$box3 = array('HAVA FİLİTRE KUTUSU');
$box3_grup = 'Periyodik Bakım Ürünleri';
$box4 = array('FAR YIKAMA ROBOTU');
$box4_grup = 'Sensör,Valf ve Elektrik Ürünleri';
$box5 = array('DAVLUMBAZ', 'RADYATÖR', 'TAMPON DEMİRİ VE TRAVERS', 'TORPİDO', 'KAPUT MENTEŞELERİ', 'FAN', 'FAN DAVLUMBAZI', 'KARTER VE ALT MUHAFAZA', 'MARŞBİYEL BAKALİTİ', 'PANEL', 'MOTOR ÜST KAPAĞI');
$box5_grup = 'Karoser İç Parçalar';
$box6 = array('AYNA', 'BAGAJ KAPAGI', 'BODY KİT', 'ETEK SAÇI', 'KAPI BANTLARI', 'KAPI KOLU', 'KAPI VE KAPI SAÇLARI', 'MOTOR KAPUTLARI', 'PANJUR', 'SPOYLER', 'TAMPON', 'TAMPON EK PARÇALARI', 'TUNİNG', 'ÇAMURLUK', 'ÖN CAM IZGARA');
$box6_grup = 'Karoser Dış Parçalar';
$tur_title = '';
$tur_type = $_POST["Tur"];
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

$tur_name = $tur_title;
$Tur = $db->Query('IdeaSoftCategory',[
  'Name' => (string)$tur_name,
  'ParentId'  =>(int)$ideasoftidd2
], [], 'TEK');
if($Tur["IdeaSoftId"] != ""){
  //Tur varsa
  $ideasoftidd3 = $Tur["IdeaSoftId"];
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
  $response3 = CategoryCreateCurl($domain, $token, $data3);
  $response3 = json_decode($response3,true);
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
    $control = true;
  }
}
if($control){
  echo $result;
}else{
  echo json_encode([
    'success' => false,
    'message' =>  'Bu Kategori Daha Önce Eklendi.',
    'data' => ['ParentId' =>$ideasoftidd3 ]
  ]);
}


$homepage = file_get_contents('https://c2c.wegdi.com/System/Cron/IdeaSoft/CategoryJsonInsertLast10.php');




?>
