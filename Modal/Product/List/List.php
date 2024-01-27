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



if ($_POST["ProductName"]) {
  $filter["product_name"] = new MongoDB\BSON\Regex($_POST["ProductName"], 'i');
}

if ($_POST["Model"]) {
  $filter["model"] = new MongoDB\BSON\Regex($_POST["Model"], 'i');
}


if ($_POST["C2cCode"]) {
  $filter["C2Cmodel"] = new MongoDB\BSON\Regex($_POST["C2cCode"], 'i');
}

if ($_POST["Brand"]) {
  $filter["manufacturer_name"] = new MongoDB\BSON\Regex($_POST["Brand"], 'i');
}


if ($_POST["IdeaSoftSatatus"]) {
  $filter["IdeaSoft"] = (int)$_POST["IdeaSoftSatatus"];
}


if ($_POST["IdeaSoftCategory"]) {
  $filter["IdeaSoftCategory"] = (int)$_POST["IdeaSoftCategory"];
}




$sortOptions = ['quantity' => -1]; // Sort by "quantity" in descending order

$Products = $db->Query('Products', $filter, ['sort' => $sortOptions], 'COK', $start, $length);


$url = 'https://c2c.wegdi.com/System/Cron/IdeaSoft/CategoryJson.php';

// JSON verilerini çekin
$jsonData = file_get_contents($url);
$jsonData= json_decode($jsonData,1);
$ideaSoftCategoryItem = '';
foreach ($jsonData as $value) {
  $ideaSoftCategoryItem .= '<option value="'.$value["IdeaSoftId"].'">'.$value["Name"].'</option>';
}

$Log = array();
foreach ($Products as $ProductsGet) {


    if ($ProductsGet["IdeaSoft"]==1) {
      $status='<span class="badge bg-primary">Mevcut</span>';
    }elseif($ProductsGet["IdeaSoft"]==0) {
      $status='<span class="badge bg-danger">Mevcut Değil</span>';

    }
    $metaDescriptionWarning = '';
    if (empty($ProductsGet["product_meta_description"]) || is_null($ProductsGet["product_meta_description"])) {
        $metaDescriptionWarning = '<span class="badge bg-warning"><i class="ri-error-warning-fill"></i></span>';
    }

    $Supplier = $db->Query('Supplier',['SupplierCode' => $ProductsGet["SupplierCode"]], [], 'TEK',);


    $Log[] = array(
        '<input type="checkbox" name="selected['.(string)$ProductsGet["_id"].']" value="'.$ProductsGet["price"].'">',
        '<div class="flex-shrink-0 me-3">
        <div class="avatar-sm bg-light rounded p-1">
        <img src="'.$ProductsGet["main_image"].'" alt="" class="img-fluid d-block">
        </div>
        </div>
        ',
        $ProductsGet["product_name"].' '.$metaDescriptionWarning,
        $ProductsGet["manufacturer_name"],
        $ProductsGet["model"],
        empty($ProductsGet["C2Cmodel"]) ? '' : $ProductsGet["C2Cmodel"],
        $ProductsGet["quantity"],
        $ProductsGet["price"],
        $status,
        '<input type="text" id="remove-id-input" class="form-control" name="price_one[]" value="'.$ProductsGet["TotalPrice"].'">',
        '<select class="js-example-basic-single" data-product-selecet-id="'.(string)$ProductsGet["_id"].'"></select>',
        $Supplier["SupplierName"]

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
