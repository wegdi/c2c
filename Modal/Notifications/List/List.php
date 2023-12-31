<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();
date_default_timezone_set($db->GetSystem("TimeZone"));


// DataTables sends filter parameters in the request
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];

$filter = [];
// Define your filtering criteria based on the DataTables search value ($searchValue)

$Notifications = $db->Query('Notifications', $filter, [], 'COK', $start, $length);

$Log = array();
foreach ($Notifications as $NotificationsGet) {
    // Initialize an empty string to store the authority names
    $Yaz = '';
    foreach ($NotificationsGet["Groups"] as $value) {
        $Yaz .= $db->QueryID("Groups", $value, "Name") . ",";
    }
    $Yaz = rtrim($Yaz, ',');

    $Log[] = array(
        $NotificationsGet["Message"],
        $db->QueryID("Users", $NotificationsGet["UserID"], "NameSurname"),
        $Yaz,
        date($db->GetSystem("DateFormat"),$NotificationsGet["Date"]),
        '<div class="hstack gap-2"><button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="'.$NotificationsGet['_id'].'"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
         <a href="/Notifications/Edit/'.$NotificationsGet['_id'].'" class="btn btn-sm btn-soft-info edit-list"><i class="ri-pencil-fill align-bottom"></i></a>
         </div>'
    );
}


$getir = array(
    "draw" => (int) $draw,
    "recordsTotal" => $db->Quantity('Notifications'),
    "recordsFiltered" => $db->Quantity('Notifications', $filter), // Here, we use the filtered data count
    "data" => $Log
);

echo json_encode($getir);

?>
