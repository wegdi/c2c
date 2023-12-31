<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

class GeoIP
{
    public function getGeoInfo()
    {

      $userIP = $_SERVER['REMOTE_ADDR'];

      if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
        $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } elseif (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
        $userIP = $_SERVER['HTTP_CLIENT_IP'];
      }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://tools.keycdn.com/geo.json?host=' . $userIP,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'User-Agent: keycdn-tools:'.HTTPS_SERVER
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json=json_decode($response,true);
        return $json;
    }
    public function UserControlGeo()
    {
      $getGeoInfo=$this->getGeoInfo();
      $Code=$getGeoInfo["data"]["geo"]["country_code"];
      return $Code;
    }
}



 ?>
