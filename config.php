<?php

$host = $_SERVER['HTTP_HOST'];
// HTTP
define('HTTP_SERVER', 'https://'.$host.'/');

// HTTPS
define('HTTPS_SERVER', 'https://'.$host.'/');

$dir = dirname(__FILE__);
//Firma Bilgileri

define('URL', 'https://ads.akillipanda.com');


define('GET_TOKEN', 'SCvsETFFMlIj17h8H3OoIGEk277FpMka9yf4K6kbuC1uGbcKeX');

define('SYSTEM', $dir.'/System/');
define('VIEW', $dir.'/View/');
define('THEMES_DIR', $dir.'/View/Themes/');
define('THEMES', $dir.'/View/Themes/Wegdi/');
define('THEM', '/View/Themes/Wegdi/');

define('FILE', $dir.'/File/Excel/');
////Facebook ve GoogleId
define('Access_Token', 'EAASHUCBV8TQBOxWftymj0ZAya1975VLcPbB4EgGWmEYbkDm22nAs8hlBsshCMzTIXuJAqYfw6wLAp1ZAuJ3Tr9ywVZAlHPF4fGReVxPJbP2MZCLX5HL6BuUqXVroviJODjlI8NtqMUoXnwRcBolK6o44ZA8ZBJ08TiZBZB3hN12U6L5eBCs1HZAOGX5yRkoIpZBk5EAiaXSK4XGtoVZBpZBmxxytYIZA0wUZAZCs6WvvmAcl9lY6PsZD');
define('App_Secret', '6a061c959506f6b04e4067411314f4ba');
define('App_ID', '1274678116479284');


define('Google_ID', '4991963711');
define('Google_DEVELOPER_TOKEN', 'BBqEPurVyEVubgKnD8bGYQ');

define('MODAL', $dir.'/Modal/');
define('CONTROLLER', $dir.'/Controller/');
define('LANGUAGES', $dir.'/View/Languages/');
define('LANGUAGES_GET', $dir.'/View/Languages/Languages.php');

define('LANGUAGES_GET_DIL', 'tr');


//Security

define('SECURITY', $dir.'/System/Security/General/');

define('INFO', 'Bu Sistem Wegdi IT Tarafından Yazılmıştır.');


define('TOKEN', 'YYC1dDYLQ6hD56ehPg2rGATcfRktOnAE7RaGfpt5CNxauk9B');

define('DB_DRIVER', 'mongodb');
define('DB_HOSTNAME', '176.9.98.123');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Omur1996a');
define('DB_DATABASE', 'ads_wegdi');
define('DB_PORT', '3306');
define('DB_EK', 'ads_wegdi.');


$guvenlik =
array(
  "session" => "adminlogin",
  "homePage" => "Home",
  "loginPage" => "login",
  "logoutPage" => "exit",
  "panel" => URL
);


 ?>
