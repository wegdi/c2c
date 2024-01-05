<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

$SupplierTag = $db->Query('Supplier',["SupplierCode" => (string)$_POST["SupplierID"]], [], 'TEK');

if ($SupplierTag["_id"]!="") {

  $data = array(
      'Tag' => [
        'TagName' => $_POST["selectedValue"],
        'TagValue' => $_POST["tag"],

      ]
  );
  echo $db->UpdateByObjectId("Supplier",(string)$SupplierTag["_id"], $data);

}



?>
