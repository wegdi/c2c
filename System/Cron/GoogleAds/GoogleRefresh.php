<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once('Func.php');
require_once(SYSTEM.'General/General.php');
$db=new General();
$GoogleAds=new GoogleAds();


$GoogleSystem = $db->Query('Settings',['GoogleRefreshToken' => ['$ne' => null]], [], 'TEK');

echo $GoogleSystem["GoogleRefreshToken"];
$Ar=array(

  'client_id' => '1078336283991-4m5121moial6l9fnqb36b9ced0flneu0.apps.googleusercontent.com',
  'client_secret' => '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',
  'refresh_token' => $GoogleSystem["GoogleRefreshToken"],
  'grant_type' => 'refresh_token'
);

 $Guncelle=json_decode($GoogleAds->googleRefresh($Ar),true);

$data = array(
  'Expires' => $Guncelle["expires_in"],
  'AccessToken' => $Guncelle["access_token"]
);
$response = $db->UpdateByObjectId("Settings","64c64788ffc21632bef8fab5", $data);

 ?>
