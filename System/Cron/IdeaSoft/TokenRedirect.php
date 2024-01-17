<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();


$state=$_GET["state"];
$code=$_GET["code"];
$domain=$_GET["domain"];


echo $code;
