<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();

$Params = $_GET['Params'];

// DataTables sends filter parameters in the request
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];

$filter = [];
// Define your filtering criteria based on the DataTables search value ($searchValue)

if ($Params!="") {
  $filter = ['CompanyCode' => $Params];

}

$Users = $db->Query('Users', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Users as $MenuGet) {

      if ($MenuGet["Status"]=="1") {
        $spna='<button type="button" class="btn btn-success btn-sm">'.$Themes->Translate("TEXT_STATUS_ON").'</button>';
      }else {
        $spna='<button type="button" class="btn btn-danger btn-sm">'.$Themes->Translate("TEXT_STATUS_OFF").'</button>';

      }

    $Log[] = array(
        '<img  loading="lazy" class="rounded-circle header-profile-user" src="'.$MenuGet['ProfilImage'].'" alt="Header Avatar">',
        $MenuGet["NameSurname"],
        $MenuGet["UserMail"],
        $spna,
        $db->QueryID("Authority", $MenuGet["Authority"], "Name"),
        '<div class="hstack gap-2"><button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="'.$MenuGet['_id'].'"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
         <a href="/User/Edit/'.$MenuGet['_id'].'" class="btn btn-sm btn-soft-info edit-list"><i class="ri-pencil-fill align-bottom"></i></a>
         </div>'
    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Users'),
    "recordsFiltered" => $db->Quantity('Users', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
