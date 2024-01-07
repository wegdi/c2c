<?php

class ProductJsonDecoder {

  public function  ProductJsonLogin($value='')
  {
    $explode= explode(';',$value);
    $count=count($explode);
    return   $count;
  }

}


 ?>
