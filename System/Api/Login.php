<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();

header('Content-Type: application/json');

$params = array(
"session" => "adminlogin",
"tablo" => DB_EK."Users",
"tblUser" => "UserMail",
"tblPass" => "Password",
"userValue" => $_POST["email"],
"passValue" => $_POST["password"],
"homePage" => "Home",
"loginPage" => "login",
"logoutPage" => "exit",
"panel" => URL
);

echo $db->Login($params);
?>
