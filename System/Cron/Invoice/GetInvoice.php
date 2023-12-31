<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

use furkankadioglu\eFatura\Models\Invoice;
use furkankadioglu\eFatura\InvoiceManager;
use furkankadioglu\eFatura\Models\Country;
use furkankadioglu\eFatura\Models\CurrencyType;
use furkankadioglu\eFatura\Models\InvoiceType;
use furkankadioglu\eFatura\Models\UnitType;
require_once(SYSTEM.'Invoice/vendor/autoload.php');
$db=new General();


$oldInvoice = new Invoice();
$client = new InvoiceManager();

// Production environment
$client->setUsername("95211471")->setPassword("124949");


// Test Environment
//$client->setDebugMode(true)->setTestCredentials();
$client->getCredentials();


$client->connect();
//2022
$oldInvoice->setUuid($_GET["id"]);

$FaturaDetay=$client->setInvoice($oldInvoice)->getInvoiceFromAPI();
$Link=$client->setInvoice($oldInvoice)->getInvoicePDF();

$client->logOutFromAPI();


 ?>
