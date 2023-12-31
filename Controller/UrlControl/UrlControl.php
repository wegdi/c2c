<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);


class UrlControl
{
    public function UrlGet($indis)
    {
        $path = parse_url($_GET['url'], PHP_URL_PATH);
        $segments = explode('/', trim($path, '/'));

        if (count($segments) > $indis) {
            return $segments[$indis];
        } else {
            return null; // Varsa dizin değerini, yoksa null döndürür
        }
    }
}

$UrlControl = new UrlControl();




?>
