<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

$commission = $_POST['commission'];
$filter = [];

if($commission > 0){
    $Products = $db->Query('Products', $filter, [], 'COK');
    foreach ($Products as $ProductsGet) {
        $commissionTotal = $ProductsGet["price"] + ($ProductsGet["price"] * $commission);
        $data = array(
            'TotalPrice'  => (string)$commissionTotal
        );
       $db->UpdateByObjectId("Products",(string)$ProductsGet["_id"], $data);
    }
}

?>
