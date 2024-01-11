<?php

class ProductJsonDecoder {

    public function ProductJsonLoginCount($value = '')
    {
        $explode = explode(';', $value);
        if ($explode) {
            $count = count($explode);
            return $count;
        } else {
            return 0;
        }
    }

    public function ProductJsonLoginEnd($value = '')
    {
        $explode = explode(';', $value);
        if ($explode) {
            $count = end($explode);
            return $count;
        } else {
            return 0;
        }
    }

    public function firtDelete($value = '')
  {
      $explode = [];

      if (isset($value)) {
          $explode = explode(';', $value);

          if (count($explode) > 2) {
              array_shift($explode);
          }
      }

      return $explode;
  }



    public function ReturnProduct($url = '', $modelv = '', $istek = '',$SupplierId='',$gettotal)
    {
        $model = $this->ProductJsonLoginCount($modelv);

        $jsonData = file_get_contents($url);
        $decodedData = json_decode($jsonData, true);
        $explode = explode(';', $modelv);

        if (count($explode)==2) {
          $productValuesArray = [];
          $decodedDataList = array_slice($decodedData[$explode[0]],0, 1);
          foreach ($decodedDataList[$explode[1]] as $keydecodedData => $valuedecodedData) {

                foreach ($istek as $istekler => $exp) {
                  $giris=$this->firtDelete($exp);

                  $Toplam=count($this->firtDelete($exp));

                      if ($Toplam==1) {

                        if (isset($valuedecodedData[$giris[0]])) {
                        $productValues[$istekler] = $valuedecodedData[$giris[0]];
                        }



                      }

                      if ($Toplam==2) {
                      //  echo "string";
                        //$productValues[$istekler] = $valuedecodedData[$giris[0]];

                      }

                      if ($Toplam==3) {



                      }
                }
              }
                print_r($productValues);
        }

    }
}
