<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

/*
if (isset($_POST["selected"]) and isset($_POST["IdeaSoftId"])) {
  foreach ($_POST["selected"] as $key => $value) {

    $data = array(
      'IdeaSoftId' => (int)$_POST["IdeaSoftId"]
    );

  $response = $db->UpdateByObjectId("CategoryList",$value, $data);
  }
  echo $response;

}*/

$Category1 = $db->Query('Category',['Name' => $_POST["Marka"]], [], 'TEK');
if($Category1["IdeaSoftId"] != ""){
  //kategori1 var ise
}else{
  // kategori 1 ideasoft ekle
}

$model_name = $_POST["Marka"]." -> ".$_POST["Model"];
$Model = $db->Query('Category',['Name' => $model_name], [], 'TEK');
if($Model["IdeaSoftId"] != ""){
  //model varsa
  
}else{
  //model yok ideasoft ekle
  
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
}


?>
