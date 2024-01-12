<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SECURITY.'Security.php');
    $security->LoginControl($guvenlik);
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    echo 'test';

    $Menus = $db->Query('Category_Menu', $filter, [], 'COK', '', '');
    echo '<ul>';
    foreach ($Menus as $value) {
        echo '<li>'.$value["Title"].'</li>';
    }
    echo '</ul>';


?>