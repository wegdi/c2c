<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();


$curl_handle = curl_init();
$url = 'https://www.onlineyedekparca.com';
$proxy_url = 'http://p.webshare.io:80'; // Rotalı Proxy Adresi ve Portu
$proxy_userpwd = 'ubqgmkhp-rotate:4rwa8h2thidt'; // Proxy Kullanıcı Adı ve Şifresi

$headers = array(
    'X-Requested-With: XMLHttpRequest',
    'User-Agent: Google/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,/;q=0.8',
    'Accept-Language: en-US,en;q=0.5',
);

curl_setopt($curl_handle, CURLOPT_URL, $url);
curl_setopt($curl_handle, CURLOPT_PROXY, $proxy_url);
curl_setopt($curl_handle, CURLOPT_PROXYUSERPWD, $proxy_userpwd);
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($curl_handle, CURLOPT_TIMEOUT, 15); // Timeout in seconds
curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($curl_handle);
$http_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);

if ($response === false) {
    // Hata durumunda işlemler
    die('Error occurred while fetching data: ' . curl_error($curl_handle));
}

//1. kategori bilgileri
$domain = 'https://www.onlineyedekparca.com';
preg_match_all('/data-selector="first-level-navigation".*?<a\s+href="(.*?)".*?title="(.*?)"/s', file_get_contents($domain), $kategori);
$r = 0;
$uniqid = uniqid();
$data = array(
    'Uniqid' => $uniqid,
    'GroupId'=> '0',
    'Title' => $db->Guvenlik($kategori[2][$r])
);
$db->Add("Category_Menu", $data);
//2. kategori bilgileri
$domain2 = $domain.$kategori[1][$r];
$dom = new DOMDocument();
$dom->loadHTML(file_get_contents("$domain2"));
$finder = new DomXPath($dom);
$classname = "filter-menu-category-content";
$kategori2 = $finder->query("//*[contains(@class, '$classname')]//a");
foreach ($kategori2 as $kategori2_item) {
    $uniqid2 = uniqid();
    $data2 = array(
        'Uniqid' => $uniqid2,
        'GroupId'=> $uniqid,
        'Title' => $db->Guvenlik($kategori2_item->getAttribute('title'))
    );
    $db->Add("Category_Menu", $data2);
    //son kategori bilgileri
    $domain3 = $domain.$kategori2_item->getAttribute('href');
    $dom3 = new DOMDocument();
    $dom3->loadHTML(file_get_contents("$domain3"));
    $finder3 = new DomXPath($dom3);
    $classname = "filter-menu-category-content";
    $kategori3 = $finder3->query("//*[contains(@class, '$classname')]//a");
    if($kategori3->length > 0){
        foreach ($kategori3 as $kategori3_item) {
            $uniqid3 = uniqid();
            $data3 = array(
                'Uniqid' => $uniqid3,
                'GroupId'=> $uniqid2,
                'Title' => $db->Guvenlik($kategori3_item->getAttribute('title'))
            );
            $db->Add("Category_Menu", $data3);
        }
    }
}
echo ' bitti ';


curl_close($curl_handle);
exit;
?>
