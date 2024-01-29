<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();


function ideaSoftPost($post='')
{

  $IdeaSoft = $this->Query('IdeaSoft', [], [], 'TEK');
  $Domain=$IdeaSoft["domain"];


  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => $Domain."/admin-api/brands",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($post),
    CURLOPT_HTTPHEADER => [
      "Accept: application/json",
      "Authorization: Bearer ".$IdeaSoft["access_token"],
      "Content-Type: application/json"
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return $err;
  } else {
    return $response;
  }
}
