<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
require_once(SYSTEM.'Cron/IdeaSoft/IdeaSoftFunc.php');
$db=new General();
$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
$ideaSoftInstance = new IdeaSoft($IdeaSoft["domain"],$IdeaSoft["access_token"]);

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
    'showcaseContentDisplayType' => 1,
    'displayShowcaseFooterContent' => 0,
    'showcaseFooterContent' => 'string',
    'showcaseFooterContentDisplayType' => 1,
    'hasChildren' => 0,
    'isCombine' => 0
  ];
  $response = $ideaSoftInstance->post($data,'categories');
  $response = json_decode($response,true);
  if($response["id"] != ""){
    $ideasoftidd = $response["id"];
    $dataadd = array(
        'Name' => $response["name"],
        'Slug' => $response["slug"],
        'IdeaSoftId'  =>  $ideasoftidd
    );
    $result = $db->Add("IdeaSoftCategory", $dataadd);
  }
}

$model_name = $_POST["Marka"]." -> ".$_POST["Model"];
$Model = $db->Query('IdeaSoftCategory',['Name' => $model_name], [], 'TEK');
if($Model["IdeaSoftId"] != ""){
  //model varsa
  $ideasoftidd = $Model["IdeaSoftId"];
}else{
  //model yok ideasoft ekle
  $data = [
    'name' => $_POST["Model"],
    'sortOrder' => 999,
    'status' => 1,
    'distributor' => '',
    'percent' => 1,
    'displayShowcaseContent' => 0,
    'showcaseContentDisplayType' => 1,
    'displayShowcaseFooterContent' => 0,
    'showcaseFooterContent' => 'string',
    'showcaseFooterContentDisplayType' => 1,
    'hasChildren' => 0,
    'isCombine' => 0,
    'parent' => [
      'id' => [
        $ideasoftidd
      ]
    ]
  ];
  $response = $ideaSoftInstance->post($data,'categories');
  $response = json_decode($response,true);
  if($response["id"] != ""){
    $dataadd = array(
        'Name' => $_POST["Marka"]." -> ".$response["name"],
        'Slug' => $response["slug"],
        'IdeaSoftId'  =>  $ideasoftidd
    );
    $result = $db->Add("IdeaSoftCategory", $dataadd);
  }
}
echo $result;

/*
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
$box6 = array('Ayna', 'Bagaj Kapagı', 'Body Kit', 'Etek Sacı', 'Kapı Bantları', 'Kapı Kolu', 'Kapı ve Kapı Sacları', 'Motor Kaputları', 'Panjur', 'Spoyler', 'Tampon', 'Tampon ek Parçalar', 'Tuning', 'Çamurluk', 'Ön Cam Izgara');
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

$tur_name = $_POST["Marka"]." -> ".$_POST["Model"]." -> ".$tur_title;
$Tur = $db->Query('Category',['Name' => $tur_name], [], 'TEK');
if($Tur["IdeaSoftId"] != ""){
  //Tur varsa
}else{
  //Tur yok ideasoft ekle
}*/


?>
