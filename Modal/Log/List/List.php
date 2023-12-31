<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();
date_default_timezone_set($db->GetSystem("TimeZone"));


// DataTables sends filter parameters in the request
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];

$filter = [];
// Define your filtering criteria based on the DataTables search value ($searchValue)

$Logc = $db->Query('Log', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Logc as $LogGet) {


    $Log[] = array(
        $LogGet["Condition"],
        $LogGet["Message"].' ('.$LogGet["UserMail"].') '.$LogGet["Browser"] ,
        $LogGet["IpAdress"],
        date($db->GetSystem("DateFormat"),$LogGet["Date"]),



    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Log'),
    "recordsFiltered" => $db->Quantity('Log', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
