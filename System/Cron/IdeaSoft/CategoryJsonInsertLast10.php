<?php
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

$IdeaSoftCategory = $db->Query('IdeaSoftCategory', [],['sort' => ['_id' => -1]], 'COK',1,20);
print_r($IdeaSoftCategory);
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


foreach ($tree as $key => $value) {

  $Category = $db->Query('Category', ["IdeaSoftId" => (int)$value["IdeaSoftId"]], [], 'TEK');

  if ($Category["_id"] == "") {

      $db->Add("Category", $value);
  } else {
      $db->UpdateByObjectId("Category", (string)$Category["_id"], $value);
  }


}
?>
