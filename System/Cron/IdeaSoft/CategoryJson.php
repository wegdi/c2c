<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();
$IdeaSoftCategory = $db->Query('IdeaSoftCategory', [], [], 'COK');

// Tüm kategorileri depolamak için bir dizi oluşturun
$categories = [];

// Ana kategorileri bulun
foreach ($IdeaSoftCategory as $key => $value) {
    $categories[] = [
        'Name' => $value['Name'],
        'Slug' => $value['Slug'],
        'IdeaSoftId' => $value['IdeaSoftId'],
        'ParentId' => $value['ParentId'],
    ];
}

// JSON çıktısı oluşturmak için ağaç yapısını oluşturun
$tree = buildCategoryTree($categories);

// JSON çıktısını ekrana yazdır
echo json_encode($tree, JSON_PRETTY_PRINT);

// Kategori ağacını oluşturan özyinelemeli fonksiyon
function buildCategoryTree($categories, $parentId = 0)
{
    $branch = [];

    foreach ($categories as $category) {
        if ($category['ParentId'] == $parentId) {
            $branch[] = $category['Name'];

            // Alt kategorileri ekleyin
            $subcategories = buildCategoryTree($categories, $category['IdeaSoftId']);
            $branch = array_merge($branch, $subcategories);
        }
    }

    return $branch;
}
?>
