<?php
header('Content-Type: application/json; charset=utf-8');

function buildCategoryTree($categories, $parentId = 0, $parentNames = [])
{
    $branch = [];

    foreach ($categories as $category) {
        if ($category['ParentId'] == $parentId) {
            $currentCategory = [
                'Name' => implode(' -> ', array_merge($parentNames, [$category['Name']])),
                'Slug' => $category['Slug'],
                'IdeaSoftId' => $category['IdeaSoftId'],
            ];

            $branch[] = $currentCategory;

            // Alt kategorileri ekleyin
            $subcategories = buildCategoryTree($categories, $category['IdeaSoftId'], array_merge($parentNames, [$category['Name']]));
            $branch = array_merge($branch, $subcategories);
        }
    }

    return $branch;
}

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

$Search = (string)$_GET["search"];

if ($Search) {
    // Arama terimini içeren kategorileri filtrele
    $filteredCategories = array_filter($tree, function ($category) use ($Search) {
        return stripos($category['Name'], $Search) !== false;
    });

    // Filtrelenmiş kategorileri düzenle
    $formattedCategories = array_map(function ($category) {
        $formattedCategory = [
            'Name' => $category['Name'],
            'Slug' => $category['Slug'],
            'IdeaSoftId' => $category['IdeaSoftId'],
        ];

        return $formattedCategory;
    }, $filteredCategories);

    // Filtrelenmiş ve düzenlenmiş kategorileri JSON çıktısı olarak gönder
    echo json_encode(array_values($formattedCategories), JSON_PRETTY_PRINT);
} else {
    // Arama terimi yoksa, tüm kategorileri gönder
    echo json_encode($tree, JSON_PRETTY_PRINT);
}
?>
