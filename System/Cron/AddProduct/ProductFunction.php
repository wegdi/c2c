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

  public function ReturnProduct($url='',$modelv='',$istek='')
  {
    $model = $this->ProductJsonLoginCount($modelv);

    $jsonData = file_get_contents($url);
    $decodedData = json_decode($jsonData, true);

    $ProductData = [];
    if ($model == 2) {
        $explode = explode(';', $modelv);
        $one = $explode[0];
        $two = $explode[1];

        foreach ($decodedData[$one] as $keydecodedData => $valuedecodedData) {
          $productValues = [];
          foreach ($istek as $istekler => $exp) {
            $productValues[$istekler] = $valuedecodedData[$this->ProductJsonLoginEnd($exp)];

          }



        }

        return   $productValues;

    }elseif ($model == 3) {

    }
  //  print_R(  $productValues);

  }


}


 ?>
