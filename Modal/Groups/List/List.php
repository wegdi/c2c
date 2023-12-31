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

$Groups = $db->Query('Authority', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Groups as $GroupsGet) {
    // Initialize an empty string to store the authority names

    $Log[] = array(
        $GroupsGet["Name"],
        '<div class="hstack gap-2"><button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="'.$GroupsGet['_id'].'"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
         <a href="/Groups/Edit/'.$GroupsGet['_id'].'" class="btn btn-sm btn-soft-info edit-list"><i class="ri-pencil-fill align-bottom"></i></a>
         </div>'
    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Authority'),
    "recordsFiltered" => $db->Quantity('Authority', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
