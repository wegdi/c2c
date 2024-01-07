<?php

class ProductJsonDecoder {




  public function  ProductJsonLogin($value='',$SupplierFilePath='')
  {
    $explode= explode(';',$value);
    $count=count($explode);
    return   $count;

    if ($count==2) {
      $jsonData = file_get_contents("https://c2c.wegdi.com".$SupplierFilePath);

      foreach ($jsonData as $key => $value) {

      }
    }

  }

}


 ?>
