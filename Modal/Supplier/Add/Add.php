<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();


$data = array(
    'Name' => $db->Guvenlik($_POST["tedarikciadi"]),
    'Link' => $db->Guvenlik($_POST["tedarkcilink"]),
);

echo $db->Add("Supplier", $data); // `Add` fonksiyonunu düzgün şekilde çağırın
