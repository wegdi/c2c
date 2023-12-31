<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

// General sınıfını kullanarak veritabanına bağlanın
$db = new General();

function GetUrl($CompanyCode)
{

  // URL'yi oluşturun
  $url = HTTPS_SERVER.'System/Cron/GoogleAds/Negatif.php?GoogleId='.$CompanyCode;
  echo $url;
  echo "<br>";
  // GET isteği yapın
  $response = file_get_contents($url);

  // Yanıtı kontrol edin ve işleyin
  if ($response !== false) {
      // Yanıtı işleyin
      echo "GET isteği başarıyla yapıldı. Hafta: $week\n";
      // $response ile ne yapmak istediğinizi burada işleyebilirsiniz.
  } else {
      // İstekte bir hata oluştu
      echo "GET isteği başarısız oldu. Hafta: $week\n";
  }
}





$Filtre = [

];

$Info = $db->Query('Companies', $Filtre, [], 'COK');

foreach ($Info as $key => $value) {
  // İşlemi 1 dakika aralıklarla yap
  GetUrl($value["GoogleId"]);


}

?>
