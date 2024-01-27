<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();


$pricelist=$_POST["pricelist"];
$commission=$_POST["Oran"];


foreach ($pricelist as $key => $value) {


      $commissionTotal = $value + ($value * ($commission / 100));
      echo $commissionTotal;

}

 ?>
