<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
require_once('IdeaSoftFunc.php');

$db = new General();

$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
$ideaSoftInstance = new IdeaSoft($IdeaSoft["domain"],$IdeaSoft["access_token"]);


$Domain=$IdeaSoft["domain"];

$ProductId=$_GET["ProductId"];

$Products = $db->Query('Products', ['_id' => $db->ObjectId($ProductId)], [], 'TEK');

$Resault = $ideaSoftInstance->delete('products/'.$Products["IdeaSoftProductId"]);
