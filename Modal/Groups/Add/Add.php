<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

$Query=$db->Query('Authority',['Name' => $db->Guvenlik($_POST["Name"])],[], 'TEK');
if ($Query=="") {
$data = array(
    'Name' => $db->Guvenlik($_POST["Name"]),
    'Access' => $_POST["Access"]
);
echo $db->Add("Authority", $data); // `Add` fonksiyonunu düzgün şekilde çağırın
}else {
  $response = array(
    'title' => $Themes->Translate("TEXT_WARNING"),
    'message' => $Themes->Translate("TEXT_INSERT_ERROR_GROUP_USER")


  );
echo   json_encode($response);
}



?>
