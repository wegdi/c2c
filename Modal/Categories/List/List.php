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

$filter = ['GroupId' => '0'];
// Define your filtering criteria based on the DataTables search value ($searchValue)

$Category_Menu = $db->Query('Category_Menu', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Category_Menu as $Category_Menu_Item) {


    $Log[] = array(
        $Category_Menu_Item["Title"]
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
