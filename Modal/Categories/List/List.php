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



if($_GET["Params"]){
    $filter = ['GroupId' => (string)$_GET["Params"]];
}else{
    $filter = ['GroupId' => '0'];
}


// Define your filtering criteria based on the DataTables search value ($searchValue)

$Category_Menu = $db->Query('IdeaSoftCategory', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Category_Menu as $Category_Menu_Item) {


    $Log[] = array(
        $Category_Menu_Item["Name"],
        '<div class="hstack gap-2">
            <a href="/Categories/List/'.$Category_Menu_Item['GroupId'].'" class="btn btn-sm btn-soft-info edit-list"><i class="ri-eye-2-line align-bottom"></i></a>
         </div>'
    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('IdeaSoftCategory'),
    "recordsFiltered" => $db->Quantity('IdeaSoftCategory', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
