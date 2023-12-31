<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();


if ($_POST["Token"]=="3m0kGwlrP5NneHg47w9wdY1Vr49gcrNUXhPO3vPa") {
  $data = array(
    'NameSurname' => (string)$_POST["NameSurname"],
    'Phone' => (int)$_POST["Phone"],
    'Email' => (string)$_POST["Email"],
    'WebContent' => (string)$_POST["WebContent"],
    'Status' => 0,
  );
  echo $db->Add("Leads", $data);
}
