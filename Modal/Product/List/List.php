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

$Products = $db->Query('Products', $filter, ['sort' => ['product_meta_description' => -1]], 'COK', $start, $length);


$ideaSoftCategoryItem = '';
$IdeaSoftCategory = $db->Query('IdeaSoftCategory', [], [], 'COK');
foreach ($IdeaSoftCategory as $value) {
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
        $status,
        ' <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-single-default" class="form-label text-muted">Default</label>
                                                        <p class="text-muted">Set <code>data-choices</code> attribute to set a default single select.</p>
                                                        <select class="form-control" data-choices name="choices-single-default" id="choices-single-default">
                                                            <option value="">This is a placeholder</option>
                                                            <option value="Choice 1">Choice 1</option>
                                                            <option value="Choice 2">Choice 2</option>
                                                            <option value="Choice 3">Choice 3</option>
                                                        </select>
                                                    </div>
                                                </div>',
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
