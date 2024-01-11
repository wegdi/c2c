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


        public function ReturnProduct($url = '', $modelv = '', $istek = '', $SupplierId = '', $gettotal)
        {
            $model = $this->ProductJsonLoginCount($modelv);

            $jsonData = file_get_contents($url);
            $decodedData = json_decode($jsonData, true);
            $explode = explode(';', $modelv);

            if (count($explode) == 2) {
                $productValuesArray = [];
                $decodedDataList = isset($decodedData[$explode[0]]) ? array_slice($decodedData[$explode[0]], 0, 1) : [];

                if (!empty($decodedDataList) && is_array($decodedDataList)) {
                    foreach ($decodedDataList[$explode[1]] as $keydecodedData => $valuedecodedData) {
                        if (is_array($valuedecodedData) && !empty($valuedecodedData)) {
                            foreach ($istek as $istekler => $exp) {
                                $giris = $this->firtDelete($exp);
                                $Toplam = count($this->firtDelete($exp));

                                if ($Toplam == 1) {
                                    if (isset($valuedecodedData[$giris[0]])) {
                                        $productValues[$istekler] = $valuedecodedData[$giris[0]];
                                    }
                                }

                                // Diğer durumlar için gerekli işlemleri ekleyebilirsiniz
                            }
                        }
                    }
                    print_r($productValues);
                }
            }
        }

}
