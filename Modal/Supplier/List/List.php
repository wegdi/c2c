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

$Supplier = $db->Query('Supplier', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Supplier as $SupplierGet) {
    // Initialize an empty string to store the authority names

    $Log[] = array(
        $SupplierGet["SupplierName"],
        $SupplierGet["SupplierUrl"],
        '<div class="hstack gap-2"><button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="'.$SupplierGet['_id'].'"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
         <a href="/Supplier/Edit/'.$SupplierGet['_id'].'" class="btn btn-sm btn-soft-info edit-list"><i class="ri-pencil-fill align-bottom"></i></a>
         <a href="/Supplier/Detail/'.$SupplierGet['SupplierCode'].'/1" class="btn btn-sm btn-soft-primary edit-list"><i class="ri-eye-2-line align-bottom"></i></a>
         </div>'
    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Supplier'),
    "recordsFiltered" => $db->Quantity('Supplier', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);


?>
