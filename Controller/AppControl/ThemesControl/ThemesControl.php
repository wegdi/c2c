<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
include(LANGUAGES_GET);
//$security->LoginControl($guvenlik);

class Themes
{
    public function ThemesWay($parms1,$parms2)
    {
      $Way= THEMES.'Body/'.$parms1.'/'.$parms2.'/'.$parms2.'.php';
      return $Way;
    }


    public function ThemeUrl()
    {
      $Way= THEM.'Src';
        echo $Way;
    }


    public function Translate($key)
    {
      global $LANGUAGE;
      if (isset($LANGUAGE[LANGUAGES_GET_DIL][$key])) {
          return $LANGUAGE[LANGUAGES_GET_DIL][$key];
      }
      return $key; // Anahtar bulunamazsa anahtarı geri döndürün
    }



}

$Themes = new Themes();





?>
