<?php
$clientId = '777726485505-cdgi66s5pv6trsoujqdummocqq7p4sgg.apps.googleusercontent.com';
$clientSecret = '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';

// Google API URL'leri
$authUrl = 'https://accounts.google.com/o/oauth2/auth';
$tokenUrl = 'https://accounts.google.com/o/oauth2/token';
$redirectUri = 'https://ads.akillipanda.com/System/Cron/GTM/redirectUri.php'; // OAuth 2.0 kimlik doğrulama ayarlarında belirlediğiniz yönlendirme URI

$scopes = [
    'https://www.googleapis.com/auth/tagmanager.delete.containers',
    'https://www.googleapis.com/auth/tagmanager.edit.containers',
    'https://www.googleapis.com/auth/tagmanager.edit.containerversions',
    'https://www.googleapis.com/auth/tagmanager.manage.accounts',
    'https://www.googleapis.com/auth/tagmanager.manage.users',
    'https://www.googleapis.com/auth/tagmanager.publish',
    'https://www.googleapis.com/auth/tagmanager.readonly',
    'https://www.googleapis.com/auth/analytics',
    'https://www.googleapis.com/auth/analytics.readonly',
    'https://www.googleapis.com/auth/analytics.edit'

];

// Kapsam değerlerini boşlukla ayrılmış bir dizeye dönüştürün
$scope = implode(' ', $scopes);



// İstek parametreleri
$params = array(
    'client_id' => $clientId,
    'redirect_uri' => $redirectUri,
    'scope' => $scope,
    'response_type' => 'code',
    'access_type' =>   'offline'
);
// Kimlik doğrulama sayfasına yönlendirme
$authUrl = $authUrl . '?' . http_build_query($params);
header('Location: ' . $authUrl);
exit;


?>
