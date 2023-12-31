<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();


if ($_POST["Token"]=="3m0kGwlrP5NneHg47w9wdY1Vr49gcrNUXhPO3vPa") {
  $data = array(
    'Url' => $_POST["PageUrl"],
    'Mail' => $_POST["PageMail"],
    'Status' => 0
  );
  echo $db->Add("WebReport", $data);
}
