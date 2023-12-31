<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);


$Authority=$db->GetUser("Authority");
$Home = $db->Query('Authority',["_id" => $db->ObjectId($Authority)], [], 'TEK');
$dosyaYolu = THEMES . 'Body/Home/Home/' . $Home["Name"] . '.php';
if (is_file($dosyaYolu)) {
    require_once($dosyaYolu);
} else {
    // Dosya bulunamadı, burada bir şey yapabilirsiniz veya hiçbir şey yapmayabilirsiniz.
}



?>
