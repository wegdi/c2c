<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();


if ($_POST["formtype"]=="genel") {
  $data = array(
      'CompanyName' => $db->Guvenlik($_POST["CompanyName"]),
      'Adress' => $db->Guvenlik($_POST["Adress"]),
      'City' => $db->Guvenlik($_POST["City"]),
      'District' => $db->Guvenlik($_POST["District"]),
      'Country' => $db->Guvenlik($_POST["Country"]),
      'PostCode' => $db->Guvenlik($_POST["PostCode"]),
      'Phone' => $db->Guvenlik($_POST["Phone"]),
      'TaxNumber' => $db->Guvenlik($_POST["TaxNumber"]),
  );
  $response = $db->UpdateByObjectId("Settings", $security->Decrypt($_POST["oid"],"4"), $data);
  echo $response;
}elseif ($_POST["formtype"]=="sistem") {
  $data = array(
      'DateFormat' =>$_POST["DateFormat"],
      'TimeFormat' =>$_POST["TimeFormat"],
      'TimeZone' =>$_POST["TimeZone"],
      'Language' =>$_POST["Language"],
      'Language' =>$_POST["Language"],

  );
  $response = $db->UpdateByObjectId("Settings", $security->Decrypt($_POST["oid"],"4"), $data);
  echo $response;
}elseif ($_POST["formtype"]=="api") {
  $data = array(
      'EmailApi' =>$_POST["EmailApi"]
  );
  $response = $db->UpdateByObjectId("Settings", $security->Decrypt($_POST["oid"],"4"), $data);
  echo $response;
}elseif ($_POST["formtype"]=="logois") {
  $data = array(
      'Logo' => $db->Base64File("Logo")
  );
  $response = $db->UpdateByObjectId("Settings", $security->Decrypt($_POST["oid"],"4"), $data);
  echo $response;
}




?>
