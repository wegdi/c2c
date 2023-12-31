<?php



class Meta
{



    public   function Commission($tutar, $oran) {
        $eklemeMiktari = $tutar * (165 / 100); // Verilen oranı kullanarak eklemeyi hesapla
        $yeniTutar = $tutar + $eklemeMiktari;
        return $yeniTutar;
    }






}





?>
