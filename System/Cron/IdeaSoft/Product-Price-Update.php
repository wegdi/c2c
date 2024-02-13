<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(SYSTEM . 'General/General.php');
require_once('IdeaSoftFunc.php');

$db = new General();

$IdeaSoft = $db->Query('IdeaSoft', [], [], 'TEK');
$ideaSoftInstance = new IdeaSoft($IdeaSoft["domain"],$IdeaSoft["access_token"]);


$Domain=$IdeaSoft["domain"];

$ProductId=$_GET["ProductId"];

$Products = $db->Query('Products', ['IdeaSoft' => 1], [], 'COK');


foreach ($Products as $key => $value) {


  if ($value["price_one"]=="") {
    $price=$value["price_one"];

  }else {
    $price=$value["price"];

  }


if ($value["quantity"]!=0) {
  $status=1;
}else {
  $status=0;

}



 $ProductPost=[
   'name' => $value["product_name"],
   'slug' => $db->Seflink($value["product_name"]),
   'sku' => $value["C2Cmodel"],
   'barcode' => $value["C2Cmodel"],
   'stockAmount' => $value["quantity"],
   'price1' => $price,
   'currency' => [
       'id' => 3

   ],
   'discount' => 0,
   'discountType' => 1,
   'moneyOrderDiscount' => '',
   'buyingPrice' => '',
   'marketPriceDetail' => '',
   'taxIncluded' => 1,
   'tax' => $value["kdv"],
   'warranty' => 24,
   'volumetricWeight' => 1,
   'stockTypeLabel' => 'Piece',
   'customShippingDisabled' => 0,
   'customShippingCost' => 5,
   'distributor' => 'superTedarik',
   'hasGift' => 0,
   'gift' => '',
   'status' => $status,
   'hasOption' => 0,
   'shortDetails' => $value["product_name"],
   'searchKeywords' => '',
   'installmentThreshold' => '-',
   'categoryShowcaseStatus' => 1,
   'midblockSortOrder' => -2147483648,
   'pageTitle' => $value["product_name"],
   'metaDescription' => $value["product_name"].' '.$value["product_meta_keyword"],
   'metaKeywords' => '',
   'canonicalUrl' => '',
   'detail' => [
     'details' => $value["product_name"].' '.$value["product_description_1"].' '.$value["product_description_2"].' <br><br><br><br><br><br><a href="https://www.wegdi.com/" title="Dijital Ajans">Entegrasyon hizmeti wegdi.com tarafından sağlanmaktadır.</a>'

   ],




 ];





  $result = $ideaSoftInstance->put($ProductPost,'products/'.$value["IdeaSoftProductId"]);
  $result = json_decode($result,1);
}
