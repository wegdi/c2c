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

$Products = $db->Query('Products', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Products as $ProductsGet) {


    if (isset($ProductsGet["IdeaSoft"]) or $ProductsGet["IdeaSoft"]==1) {
      $status='<span class="badge bg-primary">Mevcut</span>';
    }else {
      $status='<span class="badge bg-danger">Mevcut Değil</span>';

    }
    $Log[] = array(
        '<div class="flex-shrink-0 me-3">
        <div class="avatar-sm bg-light rounded p-1">
        <img src="'.$ProductsGet["main_image"].'" alt="" class="img-fluid d-block">
        </div>
        </div>
        ',
        $ProductsGet["product_name"],
        $ProductsGet["model"],
        $ProductsGet["quantity"],
        $status

    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Products'),
    "recordsFiltered" => $db->Quantity('Products', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
