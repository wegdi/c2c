<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$SGuvenlik=$security->LoginControl($guvenlik);
require_once(SYSTEM.'Module/GeoIP/GeoIP.php');



include_once(CONTROLLER.'index.php');
include_once(CONTROLLER.'UrlControl/UrlControl.php');
include_once(CONTROLLER.'AppControl/ThemesControl/ThemesControl.php');
require_once(SYSTEM.'General/General.php');
$db = new General();
$GeoIP = new GeoIP();
$GeoIP = $GeoIP->UserControlGeo();
$GeoIPGet = $db->Query('GeoIP', ['Xm' => '0'], [], 'TEK');
if (!in_array($GeoIP, $GeoIPGet["Country"])) {
  echo "Bu ülkeden giremezsin!";
exit();
}

$param3 = $UrlControl->UrlGet("3");
$param2 = $UrlControl->UrlGet("2");
$param1 = $UrlControl->UrlGet("1");
$param0 = $UrlControl->UrlGet("0");

if (!empty($param1) && !empty($param0)) {
     $Authority=$db->GetUser('Authority');

     $AuthorityQuery=$db->Query('Authority',['_id' => $db->ObjectId($Authority)],[], 'TEK');

    $themesWay = $Themes->ThemesWay($param0, $param1);
    if (is_file($themesWay)) {
        require_once(THEMES.'Header/Header.php');
        include_once(THEMES.'Menu/Menu.php');
        if (in_array($param0.'/'.$param1,$AuthorityQuery["Access"])) {
          require_once($themesWay);
        }else {
          require_once(THEMES.'/Body/Unauthorized/Unauthorized/Unauthorized.php');
        }
        require_once(THEMES.'Footer/Footer.php');
    } else {
        exit();
    }
} else {
  include_once(THEMES.'Header/Header.php');
  include_once(THEMES.'Menu/Menu.php');
  include_once(THEMES.'Body/Home/Home/Home.php');
  include_once(THEMES.'Footer/Footer.php');
}
