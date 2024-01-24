<?php

for ($page = 1; $page <= 60; $page++) {
    $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/Category.php?page=" . $page;
    file_get_contents($url);

}

 ?>
