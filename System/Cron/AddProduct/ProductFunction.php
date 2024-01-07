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


            if ($gettotal==1) {
              $start=0;
              $part= floor(count($decodedData[$one])/10);
            }else {
              $start= floor(count($decodedData[$one])/10)*$gettotal;

              $part= $start*$gettotal;
            }
            echo $start;
            echo "<br>";
            echo $part;
            $bol = array_slice($decodedData[$one], 1, $part);
          //  print_r($bol);
            foreach ($decodedData[$one] as $keydecodedData => $valuedecodedData) {
                $productValues = [];
                foreach ($istek as $istekler => $exp) {
                    $productValues[$istekler] = $valuedecodedData[$this->ProductJsonLoginEnd($exp)];
                }

                $SupplierAr = array('SupplierCode' => $SupplierId );
                $productValuesArray[] =array_merge($SupplierAr,$productValues);
            }
        } elseif ($model == 3) {
            // Handle the case when $model is 3, if needed
        }

        return $productValuesArray;
    }
}
