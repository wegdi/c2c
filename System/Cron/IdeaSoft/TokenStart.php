<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();


$IdeaSoft = $db->Query('IdeaSoft',["_id" => $db->ObjectId('65a784f66b188048239f446c')], [], 'TEK');
// Parametreleri bir dizi olarak oluştur
$parameters = array(
    'client_id' => $IdeaSoft["client_id"],
    'response_type' => 'code',
    'state' => $IdeaSoft["state"],
    'redirect_uri' => $IdeaSoft["redirect_uri"]
);

// Parametreleri URL'ye eklemek için http_build_query kullan
$url = 'https://mfkoto.myideasoft.com/panel/auth?' . http_build_query($parameters);

// Yönlendirme
header('Location: ' . $url);
exit;

?>
