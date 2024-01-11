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
            // Metni noktalı virgül karakterine göre bölen dizi
            $explode = explode(';', $value);

            // İlk öğeyi sil
            array_shift($explode);

            // Sonuçları yazdır
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

                        $productValues[$istekler] = $valuedecodedData[$giris[0]];

                      }

                      if ($Toplam==2) {
                      //  echo "string";
                        //$productValues[$istekler] = $valuedecodedData[$giris[0]];

                      }

                      if ($Toplam==3) {


                        if (isset($valuedecodedData[$giris[0]]) && is_array($valuedecodedData[$giris[0]])) {
    foreach ($valuedecodedData[$giris[0]] as $keyUc => $valueUc) {
        // Döngü içindeki işlemler
    }
} else {
    // Dizinin belirtilen anahtarına sahip değeri bulunmuyor veya değer bir dizi değil.
    // Bu duruma uygun bir işlem yapılabilir.
}






                        echo "<br>";
                        //$productValues[$istekler] = $valuedecodedData[$giris[0]];

                      }
                }
              }
                print_r($productValues);
        }

    }
}
