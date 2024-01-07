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

  public function ReturnProduct($url='',$modelv='',$istek='',$tagname='')
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
            // Ekrana sıralı bir şekilde yazdırma
            $modelValue = $valuedecodedData[$this->ProductJsonLoginEnd($modelv)];
            $product_nameValue = $valuedecodedData[$this->ProductJsonLoginEnd($istek)];

            if ($product_nameValue=="") {
              $deger="";
            }else {
              $deger=$product_nameValue;
            }

            // $ProductData dizisine ekleme
            $ProductData[] = array('model' => $modelValue, $tagname => $deger);
        }
    }elseif ($model == 3) {
      $explode = explode(';', $modelv);
      $one = $explode[0];
      $two = $explode[1];

      foreach ($decodedData[$one][$two] as $keydecodedData => $valuedecodedData) {
          // Ekrana sıralı bir şekilde yazdırma
          $modelValue = $valuedecodedData[$this->ProductJsonLoginEnd($modelv)];
          $product_nameValue = $valuedecodedData[$this->ProductJsonLoginEnd($istek)];

          // $ProductData dizisine ekleme
          $ProductData[] = array('model' => $modelValue, $tagname => $product_nameValue);
      }
    }
    return   $ProductData;
  }


}


 ?>
