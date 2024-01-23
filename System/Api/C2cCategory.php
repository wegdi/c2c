<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(SYSTEM.'General/General.php');
    $db = new General();
    $IdeaSoft = $db->Query('IdeaSoft',['_id' => $db->ObjectId("65a784f66b188048239f446c")], [], 'TEK');
    print_r($IdeaSoft);
?>
