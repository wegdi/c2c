<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');

$db = new General();

// Kategori listesini al
$categories = $db->Query('CategoryList', [], [], 'COK');

// Her bir kategori için işlem yap
foreach ($categories as $category) {
    $ideaSoftId = $category["IdeaSoftId"];

    // Eğer IdeaSoftId boş değilse işleme devam et
    if (!empty($ideaSoftId)) {
        // Kategorinin ürünlerini al
        $products = $db->Query('Products', ['CategoryFull' => $category["CategoryFull"]], [], 'COK');

        // Her bir ürün için işlem yap
        foreach ($products as $product) {
            // Ürünün IdeaSoftId alanını güncelle
            $db->UpdateByObjectId("Products", (string)$product["_id"], ['CategoryId' => $ideaSoftId]);
        }
    }
}
?>
