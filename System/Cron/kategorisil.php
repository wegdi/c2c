<?php

$start_id = 287;
$end_id = 3000;

$category_ids = range($start_id, $end_id);
$category_ids_str = implode('%2C', $category_ids);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://mfkoto.myideasoft.com/admin/category/multiple-delete',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'multiple_category_ids=' . $category_ids_str . '&anticsrf=a882cc065311c7cc62159f6be4df6f5202e23c48',
    CURLOPT_HTTPHEADER => array(
        'host: mfkoto.myideasoft.com',
        'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:121.0) Gecko/20100101 Firefox/121.0',
        'accept: application/json, text/javascript, */*; q=0.01',
        'accept-language: tr-TR,tr;q=0.8,en-US;q=0.5,en;q=0.3',
        'accept-encoding: gzip, deflate, br',
        'content-type: application/x-www-form-urlencoded; charset=UTF-8',
        'x-requested-with: XMLHttpRequest',
        'content-length: ' . strlen($category_ids_str),
        'origin: https://mfkoto.myideasoft.com',
        'referer: https://mfkoto.myideasoft.com/admin/category/list',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-origin',
        'pragma: no-cache',
        'cache-control: no-cache',
        'te: trailers',
        'cookie: dhtmlgoodies_expandedNodes=%2C0%2C; PHPSESSID=79f756529325fb1c3ef4c109c4ccff27; anticsrf=a882cc065311c7cc62159f6be4df6f5202e23c48; X-CSRF-TOKEN=7bbb071e182b349f053e91e17be692d0e0c951ba'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
