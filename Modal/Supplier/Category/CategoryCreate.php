<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

/*
if (isset($_POST["selected"]) and isset($_POST["IdeaSoftId"])) {
  foreach ($_POST["selected"] as $key => $value) {

    $data = array(
      'IdeaSoftId' => (int)$_POST["IdeaSoftId"]
    );

  $response = $db->UpdateByObjectId("CategoryList",$value, $data);
  }
  echo $response;

}*/

echo $_POST["marka"];


?>
