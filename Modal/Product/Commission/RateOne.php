<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();


$pricelist=$_POST["pricelist"];
$commission=$_POST["artis"];


foreach ($pricelist as $key => $value) {


      $tutar=$value+$commission;

      $data = array('price_one' => $tutar );
      print_r($data);
      //$Sonuc= $db->UpdateByObjectId("Products",(string)$key, $data);

}
//echo $Sonuc;
 ?>
