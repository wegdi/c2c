<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

$Query=$db->Query('Users',['UserMail' => $db->Guvenlik($_POST["UserMail"])],[], 'TEK');
if ($Query=="") {
  // code...

$data = array(
    'UserMail' => $db->Guvenlik($_POST["UserMail"]),
    'Authority' => $db->Guvenlik($_POST["Authority"]),
    'Status' => $db->Guvenlik($_POST["Status"]),
    'NameSurname' => $db->Guvenlik($_POST["NameSurname"]),
    'Password' =>  $db->Guvenlik(md5($_POST["Password"])),
    'Phone' =>  $db->Guvenlik($_POST["Phone"]),
    'CompanyCode' => $db->Guvenlik($_POST["CompanyCode"]),
    'LiveStatus' => 0,
    'token' => '',
    'Groups' => $db->Guvenlik($_POST["Groups"]),
    'ProfilImage' => $db->Base64File("ProfilImage")
);



$response =  $db->Add("Users", $data); // `Add` fonksiyonunu düzgün şekilde çağırın

echo $response;
}else {
  $response = array(
    'title' => $Themes->Translate("TEXT_WARNING"),
    'message' => $Themes->Translate("TEXT_INSERT_ERROR_MAIL")


  );
echo   json_encode($response);
}

?>
