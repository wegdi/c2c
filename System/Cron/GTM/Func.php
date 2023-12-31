<?php

class GoogleTagManagerAPI {
    private $api_key;
    private $access_token;

    public function __construct($api_key, $access_token) {
        $this->api_key = $api_key;
        $this->access_token = $access_token;
    }

    public function Accounts() {
        $url = 'https://tagmanager.googleapis.com/tagmanager/v2/accounts?key=' . $this->api_key;

        $headers = [
            'Authorization: Bearer ' . $this->access_token,
            'Accept: application/json',
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }


    public function ContainersList() {
        $url = 'https://tagmanager.googleapis.com/tagmanager/v2/accounts/6006940488/containers?key=' . $this->api_key;

        $headers = [
            'Authorization: Bearer ' . $this->access_token,
            'Accept: application/json',
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }


    public function CreateContainers($domain) {
        $url = 'https://tagmanager.googleapis.com/tagmanager/v2/accounts/6006940488/containers?key=' . $this->api_key;

        $headers = [
            'Authorization: Bearer ' . $this->access_token,
            'Accept: application/json',
            'Content-Type: application/json'

        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{"name":"'.$domain.'","usageContext":["web"],"domainName":["'.$domain.'"]}',
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
}




 ?>
