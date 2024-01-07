<?php

for ($page = 0; $page <= 201; $page++) {
    $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductDetail.php?page=" . $page;

    // Send a GET request to trigger the page
    file_get_contents($url);


}

 ?>
