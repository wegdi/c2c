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
// Define your filtering criteria based on the DataTables search value ($searchValue)

$Status = $db->Query('Status', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Status as $MenuGet) {



    $Log[] = array(

        $MenuGet["StatusName"],
        '<i class="'.$MenuGet["Icon"].' text-dark"></i>',
        '#'.$MenuGet["Color"],
        '<div class="hstack gap-2"><button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="'.$MenuGet['_id'].'"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
         <a href="/Status/Edit/'.$MenuGet['_id'].'" class="btn btn-sm btn-soft-info edit-list"><i class="ri-pencil-fill align-bottom"></i></a>
         </div>'
    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Status'),
    "recordsFiltered" => $db->Quantity('Status', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
