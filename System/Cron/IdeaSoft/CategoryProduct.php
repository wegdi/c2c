<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

$CategoryList = $db->Query('CategoryList', ['IdeaSoftId' => ['$ne' => null]], [], 'COK');
print_r($CategoryList);
