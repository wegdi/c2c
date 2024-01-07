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

  public function ReturnProduct($url='',$value='')
  {
    $model = $this->ProductJsonLoginCount($value["model"]);

    $jsonData = file_get_contents($url);
    $decodedData = json_decode($jsonData, true);

    $ProductData = [];

    if ($model == 2) {
        $explode = explode(';', $value["model"]);
        $one = $explode[0];
        $two = $explode[1];

        foreach ($decodedData[$one] as $keydecodedData => $valuedecodedData) {
            // Ekrana sıralı bir şekilde yazdırma
            $modelValue = $valuedecodedData[$this->ProductJsonLoginEnd($value["model"])];
            $product_nameValue = $valuedecodedData[$this->ProductJsonLoginEnd($value["product_name"])];

            // $ProductData dizisine ekleme
            $ProductData[] = array('model' => $modelValue, 'product_name' => $product_nameValue);
        }
    }
  }


}


 ?>
