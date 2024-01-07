<?php

class ProductJsonDecoder {




  public function ProductJsonLoginCount($value = '')
  {
      $explode = explode(';', $value);
      $count = count($explode);
      return $count;

  }


}


 ?>
