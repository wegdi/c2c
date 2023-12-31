<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

if ($_POST["Password"] != "") {
    $data = array(
        'UserMail' => $db->Guvenlik($_POST["UserMail"]),
        'Password' => $db->Guvenlik(md5($_POST["Password"])),
        'Phone' =>  $db->Guvenlik($_POST["Phone"]),
        'Authority' => $db->Guvenlik($_POST["Authority"]),
        'Status' => $db->Guvenlik($_POST["Status"]),
        'Status' => $db->Guvenlik($_POST["Status"]),
        'CompanyCode' => $db->Guvenlik($_POST["CompanyCode"]),
        'NameSurname' => $db->Guvenlik($_POST["NameSurname"]),
        'LiveStatus' => 0,
    );

    if (isset($_FILES["ProfilImage"]) && !empty($_FILES["ProfilImage"]["name"])) {
        $data['ProfilImage'] = $db->Base64File("ProfilImage");
    }
} else {
    $data = array(
        'UserMail' => $db->Guvenlik($_POST["UserMail"]),
        'Authority' => $db->Guvenlik($_POST["Authority"]),
        'Phone' =>  $db->Guvenlik($_POST["Phone"]),
        'Status' => $db->Guvenlik($_POST["Status"]),
        'Status' => $db->Guvenlik($_POST["Status"]),
        'CompanyCode' => $db->Guvenlik($_POST["CompanyCode"]),
        'NameSurname' => $db->Guvenlik($_POST["NameSurname"]),
        'LiveStatus' => 0,
    );

    if (isset($_FILES["ProfilImage"]) && !empty($_FILES["ProfilImage"]["name"])) {
        $data['ProfilImage'] = $db->Base64File("ProfilImage");
    }
}

$response = $db->UpdateByObjectId("Users", $security->Decrypt($_POST["oid"], "4"), $data);
echo $response;

?>
