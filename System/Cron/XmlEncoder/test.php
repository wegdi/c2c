<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SECURITY.'Security.php');
    $security->LoginControl($guvenlik);
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    echo 'tests';

    $x = $db->Query('Category_Menu', [], [], 'COK', '', '');

    foreach ($x as $a) {
        echo 'aaa';
    }


?>