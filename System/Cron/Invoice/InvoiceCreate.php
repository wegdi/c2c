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

$client = new InvoiceManager();
$client->setUsername("95211471")->setPassword("124949");
$client->getCredentials();


$client->connect();


// 1 ay önceki tarihi hesapla
$currentDate = strtotime(date('d/m/Y'));

for ($i = 1; $i <= 55; $i++) {
    $Start = strtotime("-{$i} month", $currentDate);
    $endArt = $i - 2; // End date'i hesaplamak için düzeltilen kısım
    $End = strtotime("-{$endArt} month", $currentDate);

    // Yılları başlangıç ve bitiş tarihinden alın
    $st = date('d/m/Y', $Start);
    $en = date('d/m/Y', $End);
    $fatura = $client->getInvoicesFromAPI($st, $en); // Başlangıç ve bitiş tarihleri ters sıralandı

    foreach ($fatura as $key => $value) {

        foreach ($value as $keyx => $valuex) {
          if (isset($valuex["onayDurumu"]) && $valuex["onayDurumu"] != "Silinmiş") {
            $Params= array(
              'belgeNumarasi' => $valuex["belgeNumarasi"],
              'aliciVknTckn' => (int)$valuex["aliciVknTckn"],
              'aliciUnvanAdSoyad' => $valuex["aliciUnvanAdSoyad"],
              'belgeTarihi' => strtotime($valuex["belgeTarihi"]),
              'onayDurumu' => $valuex["onayDurumu"],
              'ettn' => $valuex["ettn"]
            );


            $Invoice = $db->Query('Invoice',['ettn' => (string)$valuex["ettn"]], [], 'TEK');


            if ($Invoice["_id"]=="") {
              $db->Add("Invoice", $Params);

            }else {
              $db->UpdateByObjectId("Invoice",(string)$Invoice["_id"], $Params);
            }

            }

        }
    }

}
$client->logOutFromAPI();
