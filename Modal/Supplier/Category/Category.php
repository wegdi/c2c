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


if ($_POST['Marka']) {
    $filter["CategoryOne"] = $_POST['Marka'];
}

if ($_POST['Model']) {
    $filter["CategoryTwo"] = $_POST['Model'];
}

if ($_POST['Tur']) {
    $filter["CategoryTree"] = $_POST['Tur'];
}


$Supplier = $db->Query('CategoryList', $filter, ['sort' => ['CategoryOne' => 1] ], 'COK', $start, $length);

$Log = array();
foreach ($Supplier as $SupplierGet) {
    // Initialize an empty string to store the authority names

    if ($SupplierGet["IdeaSoftId"]!="") {
      $Category = $db->Query('Category',['IdeaSoftId' => $SupplierGet["IdeaSoftId"]], [], 'TEK');

      if ($Category["_id"]!="") {
        $bas=$Category["Name"];
      }else {
        $bas='';
      }
    }else {
      $bas='';
    }


    $Log[] = array(
        '<input type="checkbox" name="selected[]" value="'.$SupplierGet["_id"].'">',
        $SupplierGet["CategoryOne"],
        $SupplierGet["CategoryTwo"],
        $SupplierGet["CategoryTree"],
      $bas

    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('CategoryList'),
    "recordsFiltered" => $db->Quantity('CategoryList', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);


?>
