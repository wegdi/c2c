<?php

for ($page = 1; $page <= 25; $page++) {
    $url = "https://c2c.wegdi.com/System/Cron/IdeaSoft/DoganOtoKategori.php?page=" . $page;
    file_get_contents($url);

}

 ?>