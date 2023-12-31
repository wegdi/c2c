<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once(SYSTEM.'Invoice/vendor/autoload.php');
$db=new General();


use furkankadioglu\eFatura\Models\Invoice;
use furkankadioglu\eFatura\InvoiceManager;
use furkankadioglu\eFatura\Models\Country;
use furkankadioglu\eFatura\Models\CurrencyType;
use furkankadioglu\eFatura\Models\InvoiceType;
use furkankadioglu\eFatura\Models\UnitType;


$oldInvoice = new Invoice();
$client = new InvoiceManager();
$client->setUsername("95211471")->setPassword("124949");
$client->getCredentials();


$client->connect();



$fatura = $client->getInvoicesFromAPI(date('d/m/Y', strtotime('-3 months')), date('d/m/Y'));

foreach ($fatura as $key => $value) {

    foreach ($value as $keyx => $valuex) {
      if (isset($valuex["onayDurumu"]) && $valuex["onayDurumu"] != "Silinmiş") {

        $oldInvoice->setUuid($valuex["ettn"]);

        $FaturaDetay=$client->setInvoice($oldInvoice)->getInvoiceFromAPI();

        $Params= array(
          'belgeNumarasi' => $valuex["belgeNumarasi"],
          'aliciVknTckn' => (int)$valuex["aliciVknTckn"],
          'aliciUnvanAdSoyad' => $valuex["aliciUnvanAdSoyad"],
          'belgeTarihi' => strtotime($valuex["belgeTarihi"]),
          'onayDurumu' => $valuex["onayDurumu"],
          'ettn' => $valuex["ettn"]
        );

        $pars=array_merge($Params,$FaturaDetay);
        $Invoice = $db->Query('Invoice',['ettn' => (string)$valuex["ettn"]], [], 'TEK');


        if ($Invoice["_id"]=="") {
          $db->Add("Invoice", $pars);

        }else {
          $db->UpdateByObjectId("Invoice",(string)$Invoice["_id"], $pars);
        }

        }

    }
}
$client->logOutFromAPI();
