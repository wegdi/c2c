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

    public function ReturnProduct($url = '', $modelv = '', $istek = '',$SupplierId='',$gettotal)
    {
        $model = $this->ProductJsonLoginCount($modelv);

        $jsonData = file_get_contents($url);
        $decodedData = json_decode($jsonData, true);

        $productValuesArray = [];

        if ($model == 2) {

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



          if ($gettotal == 1) {
            $start = 0;
            $part = ceil(count($decodedData[$one]) / 200);
          } else {
              $carpan=$gettotal-1;
              $start = ceil(count($decodedData[$one]) / 200)*$carpan;
              $part = ceil(count($decodedData[$one]) / 200)*$gettotal;
          }

          $decodedDataList = array_slice($decodedData[$one][$two][$tree],$start, $part);
          foreach ($decodedDataList as $keydecodedData => $valuedecodedData) {
              $productValues = [];
              foreach ($istek as $istekler => $exp) {
                  $productValues[$istekler] = $valuedecodedData[$this->ProductJsonLoginEnd($exp)];
              }

              $SupplierAr = array('SupplierCode' => $SupplierId );
              $productValuesArray[] =array_merge($SupplierAr,$productValues);
          }
        }

        return $productValuesArray;
    }
}
