<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();


if ($_POST["selected"]!="" and $_POST["IdeaSoftId"]!="") {

  foreach ($$_POST["selected"] as $key => $value) {
    print_r($value);
    // code...
 /*
  $data = array(
    'IdeaSoftId' => (int)$_POST["IdeaSoftId"]
  );

  $response = $db->UpdateByObjectId("CategoryList",, $data);
  */
  }
//  echo $response;

}


?>
