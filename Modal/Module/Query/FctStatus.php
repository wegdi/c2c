<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
require_once(SYSTEM.'Module/VitalPbx/Call.php');
$db = new General();
$VitalPbx = new VitalPbx();
date_default_timezone_set($db->GetSystem("TimeZone"));

echo $VitalPbx->FctStatus("194.30.137.93");

?>
