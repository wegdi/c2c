<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    $magaza = 'mfkoto';
    $token = $db->IdeaSoftToken();
echo 'test';

    $filter = ['GroupId' => '0'];
    $i = 1;
    $IdeaSoftCategory = $db->Query('IdeaSoftCategory', $filter, [], 'COK', '', '');
    foreach ($IdeaSoftCategory as $value) {
        $uniqid = uniqid();
        if($i == 1){
            //buraya
            echo $value["Name"];
        }
        $i = $i+1;
    }
?>