<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

date_default_timezone_set($db->GetSystem("TimeZone"));
// Şu anki tarih ve saat
$now = time();
$data = array(
    'Message' => $db->Guvenlik($_POST["Message"]),
    'Groups' => $_POST["Groups"],
    'Date' => $now,
    'UserIDs' => '',
    'UserID' => $db->GetUser('_id')->__toString()
);

echo $db->Add("Notifications", $data); // `Add` fonksiyonunu düzgün şekilde çağırın




?>
