<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();
$IdeaSoftCategory = $db->Query('IdeaSoftCategory', [], [], 'COK');

$categories = [];

// Ana kategorileri bul
foreach ($IdeaSoftCategory as $key => $value) {
    if ($value['GroupId'] == 0) {
        $categories[$value['IdeaSoftId']] = [
            'Name' => $value['Name'],
            'Slug' => $value['Slug'],
            'Subcategories' => getSubcategories($value['IdeaSoftId'], $IdeaSoftCategory)
        ];
    }
}

// JSON çıktısını ekrana yazdır
echo json_encode($categories, JSON_PRETTY_PRINT);

// Alt kategorileri özyinelemeli olarak bulan fonksiyon
function getSubcategories($categoryId, $categories)
{
    $subcategories = [];

    foreach ($categories as $category) {
        if ($category['GroupId'] == $categoryId) {
            $subcategories[$category['IdeaSoftId']] = [
                'Name' => $category['Name'],
                'Slug' => $category['Slug'],
                'Subcategories' => getSubcategories($category['IdeaSoftId'], $categories)
            ];
        }
    }

    return $subcategories;
}

?>
