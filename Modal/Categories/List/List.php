<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();


// DataTables sends filter parameters in the request
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];

$filter = [];

if ($searchValue) {
  $filtre["Name"] = new MongoDB\BSON\Regex($searchValue, 'i');

}

$Category = $db->Query('Category', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Category as $CategoryGet) {

    $Log[] = array(
        $CategoryGet["Name"],
        ''

    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Category'),
    "recordsFiltered" => $db->Quantity('Category', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
