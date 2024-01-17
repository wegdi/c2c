<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    echo $db->IdeaSoftToken();
    echo 'a';

    /*
    $filter = ['GroupId' => '0'];
    $Category_Menu = $db->Query('Category_Menu', $filter, [], 'COK');
    foreach ($Category_Menu as $Category_Menu_Item) {
        //$Category_Menu_Item["Title"];

        //2.kategori
        $filter = ['GroupId' => (string)$Category_Menu_Item["Uniqid"]];
        $Category_Menu2 = $db->Query('Category_Menu', $filter, [], 'COK');
        foreach ($Category_Menu2 as $Category_Menu_Item2) {
            //$Category_Menu_Item2["Title"];
            //3.kategori
            $filter = ['GroupId' => (string)$Category_Menu_Item2["Uniqid"]];
            $Category_Menu3 = $db->Query('Category_Menu', $filter, [], 'COK');
            foreach ($Category_Menu3 as $Category_Menu_Item3) {
                //$Category_Menu_Item3["Title"];

            }
        }
    } */
?>