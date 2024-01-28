<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

$db = new General();

$Search = (string)$_GET["search"];

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
$tree = buildCategoryTree($categories, $Search);

// JSON çıktısını ekrana yazdır
echo json_encode($tree, JSON_PRETTY_PRINT);

// Kategori ağacını oluşturan özyinelemeli fonksiyon
function buildCategoryTree($categories, $searchTerm, $parentId = 0, $parentNames = [])
{
    $branch = [];

    foreach ($categories as $category) {
        // Arama terimini içeren kategorileri filtrele
        if (stripos($category['Name'], $searchTerm) !== false) {
            $currentCategory = [
                'Name' => implode(' -> ', array_merge($parentNames, [$category['Name']])),
                'Slug' => $category['Slug'],
                'IdeaSoftId' => $category['IdeaSoftId'],
            ];

            $branch[] = $currentCategory;

            // Alt kategorileri ekleyin
            $subcategories = buildCategoryTree($categories, $searchTerm, $category['IdeaSoftId'], array_merge($parentNames, [$category['Name']]));
            $branch = array_merge($branch, $subcategories);
        }
    }

    return $branch;
}
?>
