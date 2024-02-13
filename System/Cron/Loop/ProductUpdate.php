<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
$db = new General();


$Products = $db->Quantity('Products', ['IdeaSoft' => 1]);
echo $Products;
