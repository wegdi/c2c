<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(CONTROLLER.'FolderControl/Control.php');
require_once(SYSTEM.'General/General.php');
$db=new General();

//Tema İşlemleri
//$ThemesAdd = array('Wegdi' => array('Body', 'Header', 'Footer','Src','Menu'));
//$FolderAdd->FolderAdd($ThemesAdd,THEMES_DIR);


//Yapı
$ModalAdd = array(
    'Home' => array('Add', 'Edit', 'Query', 'Remove','Call'),
    'Menu' => array('Add', 'Edit', 'Query', 'Remove'),
    'User' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Groups' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Groupsalt' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Log' => array('List'),
    'System' => array('Settings'),
    'Notifications' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Status' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Module' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Companies' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Google' => array('Add', 'Edit', 'Query', 'Remove','List','AdGroup','Keyword','Search','Conversion','Preview'),
    'Googleadmin' => array('Add', 'Edit', 'Query', 'Remove','List','AdGroup','Keyword','Search','Conversion','Preview'),
    'Mycustomers' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Accountingcustomer' => array('Order', 'Earnings'),
    'Kyc' => array('Kyc','Verification'),
    'Order' => array('Add', 'Edit', 'Query', 'Remove','List','Successful','Fail'),
    'Adminorder' => array('Add', 'Edit', 'Query', 'Remove','List','Successful','Fail'),
    'Meta' => array('Add', 'Edit', 'Query', 'Remove','List','Successful','Fail','AdGroup','Ads'),
    'Invoice' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Tools' => array('Add', 'Edit', 'Query', 'Remove','List','Technical'),
    'Analytics' => array('Report','List'),
    'GeoIP' => array('Edit'),
    'Profile' => array('Edit'),
    'Logout' => array('Exit'),
);

$ThemesConf = array(
    'Menu' => array('Add', 'Edit','List'),
    'User' => array('Add', 'Edit','List'),
    'Groups' => array('Add', 'Edit','List'),
    'Groupsalt' => array('Add', 'Edit','List'),
    'Log' => array('List'),
    'System' =>  array('Settings'),
    'Profile' => array('Edit'),
    'Notifications' => array('Add', 'Edit','List'),
    'Module' => array('Add', 'Edit','List'),
    'GeoIP' => array('Edit'),
    'Companies' => array('Add', 'Edit', 'Remove','List'),
    'Status' => array('Add', 'Edit','List'),
    'Google' => array('Add', 'Edit', 'Query', 'Remove','List','AdGroup','Keyword','Search','Conversion','Preview'),
    'Googleadmin' => array('Add', 'Edit', 'Query', 'Remove','List','AdGroup','Keyword','Search','Conversion','Preview'),
    'Mycustomers' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Order' => array('Add', 'Edit', 'Query', 'Remove','List','Successful','Fail'),
    'Adminorder' => array('Add', 'Edit', 'Query', 'Remove','List','Successful','Fail'),
    'Accountingcustomer' => array('Order', 'Earnings'),
    'Kyc' => array('Kyc'),
    'Meta' => array('Add', 'Edit', 'Query', 'Remove','List','Successful','Fail','AdGroup','Ads'),
    'Invoice' => array('Add', 'Edit', 'Query', 'Remove','List'),
    'Tools' => array('Add', 'Edit', 'Query', 'Remove','List','Technical'),
    'Analytics' => array('Report','List'),
    'Home' => ''
);

$FolderAdd->FolderAdd($ModalAdd, MODAL);
$FolderAdd->FolderAdd($ThemesConf, THEMES.'Body/');




//Dil Dosyaları
//$Languages = array('Turkish' => array('tr'));
//$Languages = array('English' => array('en'));
//$FolderAdd->FolderAdd($Languages, LANGUAGES);

 ?>
