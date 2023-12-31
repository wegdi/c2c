<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();
date_default_timezone_set('Europe/London');
header('Content-Type: application/json');



$filter = array();





$Token = $_POST["token"];
$UserControl = $db->Query('Users', ['mobiltoken' => (string)$Token], [], 'TEK');
$Companies = $db->Query('Companies', ['CompanyCode' => (int)$UserControl["CompanyCode"]], [], 'TEK');


if ($_POST["startDate"] && $_POST["endDate"]) {
  $filter['Date'] = [
    '$gte' => (int)$_POST["startDate"], // Büyük eşit (greater than or equal)
    '$lte' => (int)$_POST["endDate"]    // Küçük eşit (less than or equal)
  ];
  $filter['CompanyCode'] =(int)$Companies["CompanyCode"];
} else {
  $filter['CompanyCode'] =(int)$Companies["CompanyCode"];

}
$Order = $db->Query('Order',$filter, [], 'COK');

foreach ($Order as $key => $value) {

    if ($value["Status"]==1) {
      $status="Onaylandı";
    }else {
      $status="Başarısız";

    }

    $data[] = array(
      'OrderID' => $value["OrderID"],
      'Date' => date('d-m-Y',$value["Date"]),
      'status' =>   $status,
      'tutar' => '₺'.number_format($value["PaymentAmount"], 2, ',', '.'),
      'type' => $value["Condition"]



    );
}
echo json_encode($data);
?>
