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





    public function ReturnProduct($url = '', $modelv = '', $istek = '', $SupplierId = '', $gettotal)
    {
        $jsonData = file_get_contents($url);
        $decodedData = json_decode($jsonData, true);
        $explode = explode(';', $modelv);

        if (count($explode) == 2) {
            $productValuesArray = [];

            $decodedDataList = array_slice($decodedData[$explode[0]], 0, 1);

            foreach ($decodedDataList[$explode[1]] as $keydecodedData => $valuedecodedData) {

                    // Tüm istekler için aynı işlemi gerçekleştir
                    $productValuesArray["UrunAdi"] = $valuedecodedData["UrunAdi"];

            }
            print_R($productValuesArray);

        }
    }

}
