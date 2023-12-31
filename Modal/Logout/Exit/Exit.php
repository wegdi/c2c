<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

session_destroy();
header("Location: $panel/$logoutPage");
exit();
?>
