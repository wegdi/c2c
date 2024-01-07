<?php

class ProductJsonDecoder {




  public function ProductJsonLogin($value = '', $SupplierFilePath = '')
  {
      $explode = explode(';', $value);
      $count = count($explode);

      if ($count == 2) {
          $jsonData = file_get_contents("https://c2c.wegdi.com" . $SupplierFilePath);
          $one = $explode[0];
          $two = $explode[1];
          $array = [];

          $decodedData = json_decode($jsonData, true);

          if (isset($decodedData[$one])) {
              foreach ($decodedData[$one] as $key => $value) {
                  if (isset($value[$two])) {
                      $array[] = $value[$two];
                  }
              }
          }

          return $array;
      }
  }


}


 ?>
