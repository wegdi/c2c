<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SECURITY.'Security.php');
    $security->LoginControl($guvenlik);
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    echo 'test';

    $Supplier = $db->Query('Category_Menu', $filter, [], 'COK', $start, $length);

    foreach ($Supplier as $SupplierGet) {
        // Initialize an empty string to store the authority names
        echo 'aaa';
    }


?>