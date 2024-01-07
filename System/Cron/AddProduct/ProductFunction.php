<?php

class ProductJsonDecoder {




  public function ProductJsonLoginCount($value = '')
  {

      $explode = explode(';', $value);
      if ($explode) {
        $count = count($explode);
        return $count;
      }else {
      return 0;
      }


  }

  public function ProductJsonLoginEnd($value = '')
  {

      $explode = explode(';', $value);
      if ($explode) {
        $count = end($explode);
        return $count;
      }else {
      return 0;
      }


  }


}


 ?>
