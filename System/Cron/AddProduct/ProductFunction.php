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
          $decodedDataList = array_slice($decodedData[$explode[0]],0, 10);
          foreach ($decodedDataList[$explode[1]] as $keydecodedData => $valuedecodedData) {

                foreach ($istek as $istekler => $exp) {
                  $giris=$this->firtDelete($exp);

                  $Toplam=count($this->firtDelete($exp));

                      if ($Toplam==1) {

                      //  $productValues[$istekler] = $valuedecodedData[$giris[0]];

                      }

                      if ($Toplam==2) {
                      //  echo "string";
                        //$productValues[$istekler] = $valuedecodedData[$giris[0]];

                      }

                      if ($Toplam==3) {
                        print_r($giris);
                          foreach ($valuedecodedData[$giris[0]] as $keyUc => $valueUc) {
                              echo $giris[1];
                              $productValues[$istekler] = $valueUc[$giris[1]];
                              //echo $valueUc[$giris[1]];
                                  //print_R($valueUc);
                          }

                        echo "<br>";
                        //$productValues[$istekler] = $valuedecodedData[$giris[0]];

                      }
                }
              }
              print_r($productValues);
        }


      //  print_r($productValues);
        /*if ($model == 2) {

            $explode = explode(';', $modelv);
            $one = $explode[0];
            $two = $explode[1];


            if ($gettotal == 1) {
              $start = 0;
              $part = ceil(count($decodedData[$one]) / 100);
            } else {
                $carpan=$gettotal-1;
                $start = ceil(count($decodedData[$one]) / 100)*$carpan;
                $part = ceil(count($decodedData[$one]) / 100)*$gettotal;
            }

            $decodedDataList = array_slice($decodedData[$one],$start, $part);
            foreach ($decodedDataList as $keydecodedData => $valuedecodedData) {
                $productValues = [];
                foreach ($istek as $istekler => $exp) {
                    $productValues[$istekler] = $valuedecodedData[$this->ProductJsonLoginEnd($exp)];
                }

                $SupplierAr = array('SupplierCode' => $SupplierId );
                $productValuesArray[] =array_merge($SupplierAr,$productValues);
            }
        } elseif ($model == 3) {
          $explode = explode(';', $modelv);
          $one = $explode[0];
          $two = $explode[1];
          $tree = $explode[2];


          if ($gettotal == 1) {
            $start = 0;
            $part = ceil(count($decodedData[$one]) / 200);
          } else {
              $carpan=$gettotal-1;
              $start = ceil(count($decodedData[$one]) / 200)*$carpan;
              $part = ceil(count($decodedData[$one]) / 200)*$gettotal;
          }

          $decodedDataList = array_slice($decodedData[$one][$two],$start, $part);
          foreach ($decodedDataList as $keydecodedData => $valuedecodedData) {
              $productValues = [];
              foreach ($istek as $istekler => $exp) {
                  $productValues[$istekler] = $valuedecodedData[$this->ProductJsonLoginEnd($exp)];
              }

              $SupplierAr = array('SupplierCode' => $SupplierId );
              $productValuesArray[] =array_merge($SupplierAr,$productValues);
          }
        } elseif ($model == 4) {
          $explode = explode(';', $modelv);
          $one = $explode[0];
          $two = $explode[1];
          $tree = $explode[2];
          $four = $explode[3];

          echo "string";

          if ($gettotal == 1) {
            $start = 0;
            $part = ceil(count($decodedData[$one]) / 200);
          } else {
              $carpan=$gettotal-1;
              $start = ceil(count($decodedData[$one]) / 200)*$carpan;
              $part = ceil(count($decodedData[$one]) / 200)*$gettotal;
          }

        //  $decodedDataList = array_slice($decodedData[$one],$start, $part);
          print_r(  $decodedData);
          foreach ($decodedDataList as $keydecodedData => $valuedecodedData) {
            print_r($valuedecodedData);
              $productValues = [];
              foreach ($istek as $istekler => $exp) {
                  $productValues[$istekler] = $valuedecodedData[$this->ProductJsonLoginEnd($exp)];
              }

              $SupplierAr = array('SupplierCode' => $SupplierId );
              $productValuesArray[] =array_merge($SupplierAr,$productValues);
          }
        }

        return $productValuesArray; */
    }
}
