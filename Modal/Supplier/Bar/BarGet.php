<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

$jsonUrl = $db->Query('Supplier',["SupplierCode" => (string)$_GET["SupplierCode"]], [], 'TEK');

$options = [
    "product_name" => "Ürün Adı",
    "product_description" => "Açıklama",
    "product_meta_description" => "Meta description",
    "product_meta_keyword" => "Meta keyword",
    "model" => "Ürün Kodu",
    "sku" => "SKU",
    "quantity" => "Stok",
    "main_image" => "Ana Resim",
    "image_1" => "Ürün resmi 1",
    "image_2" => "Ürün resmi 2",
    "image_3" => "Ürün resmi 3",
    "image_4" => "Ürün resmi 4",
    "image_5" => "Ürün resmi 5",
    "image_6" => "Ürün resmi 6",
    "image_7" => "Ürün resmi 7",
    "image_8" => "Ürün resmi 8",
    "image_9" => "Ürün resmi 9",
    "image_10" => "Ürün resmi 10",
    "manufacturer_name" => "Marka",
    "price" => "Fiyat",
    "product_option_price" => "Seçenek Fiyatı",
    "product_option_quantity" => "Seçenek Stok",
    "product_option_name" => "Seçenek Adı ",
    "product_option_value" => "Seçenek Değeri ",
    "product_attribute_group" => "Özellik Grubu ",
    "product_attribute_name" => "Özellik Adı ",
    "product_attribute_value" => "Özellik Değer "
];
?>


<table class="display table table-bordered dt-responsive">
  <?php foreach ($options as $key => $value): ?>
    <tr>
      <th><?php echo $value; ?></th>
      <th>
        <?php if ($jsonUrl["$key"]!=""): ?>
          <i class="ri-checkbox-circle-line"></i>
            <?php else: ?>
          <i class="ri-close-circle-line"></i>
        <?php endif; ?>

      </th>
    </tr>
  <?php endforeach; ?>

</table>
