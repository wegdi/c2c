<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    $IdeaSoftCategory = $db->Query('IdeaSoftCategory', [], [], 'COK');
    foreach ($IdeaSoftCategory as $key => $value) {
        print_r($value);
        s
    }

?>
