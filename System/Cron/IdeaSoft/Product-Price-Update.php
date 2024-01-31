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

  $ProductPost = [
      'type' => 1,
      'value' => $price,

  ];

  $result = $ideaSoftInstance->put($ProductPost,'product_prices/'.$value["IdeaSoftProductId"]);
  $result = json_decode($result,1);
  print_r($result);
}
