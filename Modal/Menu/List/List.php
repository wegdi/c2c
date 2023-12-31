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

$Menus = $db->Query('Menus', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Menus as $MenuGet) {
    // Initialize an empty string to store the authority names
    $Yaz = '';
    foreach ($MenuGet["Authority"] as $value) {
        $Yaz .= $db->QueryID("Authority", $value, "Name") . ",";
    }
    // Remove the last comma, if present
    $Yaz = rtrim($Yaz, ',');

    $Log[] = array(
        $MenuGet["tr"],
        $MenuGet["en"],
        $MenuGet["Order"],
        $Yaz,
        $db->QueryID("Menus", $MenuGet["Parent_ID"], "tr"),
        '<div class="hstack gap-2"><button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="'.$MenuGet['_id'].'"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
         <a href="/Menu/Edit/'.$MenuGet['_id'].'" class="btn btn-sm btn-soft-info edit-list"><i class="ri-pencil-fill align-bottom"></i></a>
         </div>'
    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Menus'),
    "recordsFiltered" => $db->Quantity('Menus', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
