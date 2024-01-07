<?php

for ($page = 0; $page <= 25; $page++) {
    $url = "https://c2c.wegdi.com/System/Cron/AddProduct/ProductDetail.php?page=" . $page;

    // Send a GET request to trigger the page
    file_get_contents($url);

    // Optionally, add a delay to avoid rate limiting (adjust as needed)
    sleep(1); // You can adjust the sleep duration as needed
}

 ?>
