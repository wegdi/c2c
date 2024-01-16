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

$filter = ['GroupId' => ['$lt' => 1]];
// Define your filtering criteria based on the DataTables search value ($searchValue)

$Products = $db->Query('Category_Menu', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Products as $ProductsGet) {


    $Log[] = array(
        $ProductsGet["Title"]
    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Category_Menu'),
    "recordsFiltered" => $db->Quantity('Category_Menu', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
