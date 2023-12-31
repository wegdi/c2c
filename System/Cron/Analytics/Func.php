<?php

class Analytics {
    private $api_key;
    private $access_token;

    public function __construct($api_key, $access_token) {
        $this->api_key = $api_key;
        $this->access_token = $access_token;
    }

    public function Accounts() {
        $url = 'https://analyticsadmin.googleapis.com/v1beta/accountSummaries?key=' . $this->api_key;

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


    public function Properties($name) {

        $url = 'https://analyticsadmin.googleapis.com/v1beta/properties?key=' . $this->api_key;

        $headers = [
            'Authorization: Bearer ' . $this->access_token,
            'Accept: application/json',
            'Content-Type: application/json'
        ];

        $post = [
          "currencyCode" =>  "TRY",
          "displayName" =>  $name,
          "parent" =>  "accounts/291765780",
          "timeZone" =>  "Europe/Istanbul"
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
          CURLOPT_POSTFIELDS => json_encode($post),
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;




    }


    public function PropertiesDelete($name) {
      echo $name;
      $url = 'https://analyticsadmin.googleapis.com/v1beta/'.$name.'?key=' . $this->api_key;

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
          CURLOPT_CUSTOMREQUEST => 'DELETE',
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;




    }


    public function dataStreamsGet($properties) {
      $url = 'https://analyticsadmin.googleapis.com/v1beta/'.$properties.'/dataStreams?key=' . $this->api_key;

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
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;




    }




    public function RealTime($properties,$query,$nametwo) {
      $url = 'https://analyticsdata.googleapis.com/v1beta/'.$properties.':runRealtimeReport?key=' . $this->api_key;

        $headers = [
            'Authorization: Bearer ' . $this->access_token,
            'Accept: application/json',
            'Content-Type: application/json'
        ];

        $data = [
            'dimensions' => [
              'name' => $query
            ],
            'metrics' => [
              'name' => $nametwo
            ]
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
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

    }



    public function Raport360($properties,$name) {
      $url = 'https://analyticsdata.googleapis.com/v1beta/'.$properties.':runReport?key=' . $this->api_key;

        $headers = [
            'Authorization: Bearer ' . $this->access_token,
            'Accept: application/json',
            'Content-Type: application/json'
        ];

        $startDate = date('Y-m-d', strtotime('-1 year'));
        $endDate = date('Y-m-d');

        $data = [
          "dateRanges" => [["startDate" => $startDate, "endDate" => $endDate]],
          "dimensions" => [
            ["name" => $name]

        ],
          "metrics" => [
            ["name" => "activeUsers"],


          ],
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
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

    }

    public function dataStreamsPost($properties,$name,$urlx) {


      $url = 'https://analyticsadmin.googleapis.com/v1beta/'.$properties.'/dataStreams?key=' . $this->api_key;

        $headers = [
            'Authorization: Bearer ' . $this->access_token,
            'Accept: application/json',
            'Content-Type: application/json'
        ];

        $data = [
            'displayName' => $name,
            'type' => 'WEB_DATA_STREAM',
            'webStreamData' => [
              'defaultUri' => $urlx
            ]
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
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;


    }




    public function ProfileAdd($name,$urlx,$uacode,$eCommerce=0) {
      echo $uacode;
        $url = 'https://analytics.googleapis.com/analytics/v3/management/accounts/291765780/webproperties/'.$uacode.'/profiles?key=' . $this->api_key;

        $headers = [
            'Authorization: Bearer ' . $this->access_token,
            'Accept: application/json',
            'Content-Type: application/json'
        ];


        $curl = curl_init();


          $data = [
             'timezone' => 'Europe/Istanbul',
             'websiteUrl' => $urlx,
             'name' => $name,
             'accountId' => '291765780',
             'currency' => 'TRY',
             'eCommerceTracking' => false,
             'webPropertyId' => $uacode
          ];

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;




    }



}




 ?>
