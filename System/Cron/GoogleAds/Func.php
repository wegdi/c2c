<?php



class GoogleAds
{



    public   function Commission($tutar, $oran) {
        $eklemeMiktari = $tutar * (165 / 100); // Verilen oranı kullanarak eklemeyi hesapla
        $yeniTutar = $tutar + $eklemeMiktari;
        return $yeniTutar;
    }



  public function googleistek($GoogleToken,$YoneticiId,$GoogleBearer,$MusteriId,$Sorgu){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://googleads.googleapis.com/v15/customers/'.$MusteriId.'/googleAds:search',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $Sorgu,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'developer-token:'.$GoogleToken,
        'login-customer-id: '.$YoneticiId,
        'Authorization: Bearer '.$GoogleBearer
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response,true);

  }




    public function GoogleGenelSorgu($url,$GoogleToken,$YoneticiId,$GoogleBearer,$MusteriId,$Sorgu){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $Sorgu,
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'developer-token:'.$GoogleToken,
          'login-customer-id: '.$YoneticiId,
          'Authorization: Bearer '.$GoogleBearer
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return json_decode($response,true);

    }

  public  function addKeywordToPlanAdGroup($GoogleToken,$YoneticiId,$GoogleBearer,$MusteriId,$Sorgu) {


    // Google Ads API'ye HTTP POST isteği gönderme
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://googleads.googleapis.com/v15/customers/{$MusteriId}/keywordPlanAdGroupKeywords:mutate");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $Sorgu);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'developer-token:'.$GoogleToken,
      'login-customer-id: '.$YoneticiId,
      'Authorization: Bearer '.$GoogleBearer
    ));
    $result = curl_exec($ch);
    curl_close($ch);

    // Yanıtı döndürme
    return $result;
  }








  public  function googlev4($client_id,$clientsecret,$code,$redirect_uri){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/oauth2/v4/token");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=".urlencode($client_id)."&client_secret=".urlencode($clientsecret)."&code=".urlencode($code)."&grant_type=authorization_code&redirect_uri=". urlencode($redirect_uri));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);

    return $server_output = json_decode($server_output);


  }


  public function googleRefresh($Array)
  {


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://www.googleapis.com/oauth2/v4/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $Array,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;


  }



  public  function googleanahesap($developer,$Bearer,$url=null){
    if (isset($url)) {
      $url='https://googleads.googleapis.com/v15/'.$url;
    }else {
      $url='https://googleads.googleapis.com/v15/customers:listAccessibleCustomers';
    }
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'developer-token:'.$developer,
        'Authorization: Bearer '.$Bearer
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;


  }

  public function  GoogleGuncelle($developer,$yoneticiid,$musteri_id,$auth,$istek){

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://googleads.googleapis.com/v15/customers/'.$musteri_id.'/campaigns:mutate',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $istek,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'developer-token: '.$developer,
        'login-customer-id: '.$yoneticiid,
        'Authorization: Bearer '.$auth
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;


  }


  public function  GoogleAnahtarKelimeEkle($developer,$yoneticiid,$musteri_id,$auth,$istek){

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://googleads.googleapis.com/v15/customers/'.$musteri_id.'/adGroupCriteria:mutate',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $istek,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'developer-token: '.$developer,
        'login-customer-id: '.$yoneticiid,
        'Authorization: Bearer '.$auth
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;


  }


  public function  GoogleKampanyaButce($developer,$yoneticiid,$musteri_id,$auth,$istek){

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://googleads.googleapis.com/v15/customers/'.$musteri_id.'/campaignBudgets:mutate',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $istek,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'developer-token: '.$developer,
        'login-customer-id: '.$yoneticiid,
        'Authorization: Bearer '.$auth
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;


  }








  public function GoogleDurumlar($Metin){

    $Bul = array(
      "COMMISSION",
      "ENHANCED_CPC",
      "INVALID",
      "MANUAL_CPA",
      "MANUAL_CPC",
      "MANUAL_CPM",
      "MANUAL_CPV",
      "MAXIMIZE_CONVERSIONS",
      "MAXIMIZE_CONVERSION_VALUE",
      "PAGE_ONE_PROMOTED",
      "PERCENT_CPC",
      "TARGET_CPA",
      "TARGET_CPM",
      "TARGET_IMPRESSION_SHARE",
      "TARGET_OUTRANK_SHARE",
      "TARGET_ROAS",
      "TARGET_SPEND",
      "UNKNOWN",
      "UNSPECIFIED",
      "MAXIMIZE_CONVERSIONS",
      "TARGET_SPEND",
      "DISPLAY_STANDARD",
      "HOTEL_ADS",
      "PROMOTED_HOTEL_ADS",
      "SEARCH_DYNAMIC_ADS",
      "SEARCH_STANDARD",
      "SHOPPING_COMPARISON_LISTING_ADS",
      "SHOPPING_PRODUCT_ADS",
      "SHOPPING_SMART_ADS",
      "SMART_CAMPAIGN_ADS",
      "UNKNOWN",
      "UNSPECIFIED",
      "VIDEO_BUMPER",
      "VIDEO_EFFICIENT_REACH",
      "VIDEO_NON_SKIPPABLE_IN_STREAM",
      "VIDEO_OUTSTREAM",
      "VIDEO_RESPONSIVE",
      "VIDEO_TRUE_VIEW_IN_DISPLAY",
      "VIDEO_TRUE_VIEW_IN_STREAM",
    );

    $Degistir= array(
      "KOMİSYON",
      "GELİŞTİRİLMİŞ TBM",
      "GEÇERSİZ",
      "MANUEL EBM",
      "MANUEL TBM",
      "MANUEL BGBM",
      "MANUEL GBM",
      "DÖNÜŞÜMLERİ MAKSİMİZE ET",
      "DÖNÜŞÜM DEĞERİNİ MAKSİMİZE ET",
      "BİRİNCİ SAYFA TANITILDI",
      "YÜZDE TBM",
      "HEDEF EBM",
      "HEDEF BGBM",
      "HEDEF GÖSTERİM PAYI",
      "HEDEF GEÇİŞ PAYI",
      "HEDEF ROAS",
      "HEDEF HARCAMA",
      "BİLİNMEYEN",
      "BELİRTİLMEYEN",
      "MAKSİMUM DÖNÜŞÜM",
      "HEDEF HARCAMA",
      "EKRAN STANDARTI",
      "OTEL İLANLARI",
      "TANITIMLI OTEL REKLAMLARI",
      "ARAMA DİNAMİK REKLAMLARI",
      "ARAMA STANDART",
      "ALIŞVERİŞ KARŞILAŞTIRMA İLANLARI",
      "ALIŞVERİŞ ÜRÜN REKLAMLARI",
      "ALIŞVERİŞ AKILLI REKLAMLARI",
      "AKILLI KAMPANYA REKLAMLARI",
      "BİLİNMEYEN",
      "BELİRTİLMEYEN",
      "VİDEO TAMPONU",
      "VİDEO VERİMLİ ERİŞİM",
      "AKIŞTA VİDEO ATLANMAZ",
      "VİDEO DIŞ AKIŞI",
      "DUYARLI VİDEO",
      "EKRANDA VİDEO GERÇEK GÖRÜNTÜ",
      "AKIŞTA VİDEO GERÇEK GÖRÜNTÜLEME"

    );
    $Sonuc=str_replace($Bul,$Degistir,$Metin);
    return $Sonuc;
  }



  public function GoogleKeywordStatus($Metin){
    $Bul = array(
      "BROAD",
      "EXACT",
      "PHRASE",
      "UNKNOWN",
      "UNSPECIFIED"
    );

    $Degistir= array(
      "GENİŞ EŞLEŞME",
      "TAM EŞLEŞME",
      "SIRALI EŞLEŞME",
      "BİLİNMİYOR",
      "BELİRTİLMEMİŞ",

    );
    $Sonuc=str_replace($Bul,$Degistir,$Metin);
    return $Sonuc;
  }

    public function GoogleKeywordQuality($Metin) {
    if ($Metin == "UNSPECIFIED") {
        return "BELİRTİLMEMİŞ";
    } elseif ($Metin == "UNKNOWN") {
        return "BİLİNMEYEN";
    } elseif ($Metin == "PHRASE") {
        return "İFADE ETMEK";
    } elseif ($Metin == "BELOW_AVERAGE") {
        return "ORTALAMANIN ALTINDA";
    } elseif ($Metin == "AVERAGE") {
        return "ORTALAMA";
    } elseif ($Metin == "ABOVE_AVERAGE") {
        return "ORTALAMANIN ÜSTÜ";
    } else {
        return $Metin; // Eğer hiçbir koşul uymazsa gelen metni olduğu gibi döndür
    }

  }

  public function GoogleKeywordApprovalStatus($Metin) {
    if ($Metin == "APPROVED") {
        return "ONAYLI";
    } elseif ($Metin == "DISAPPROVED") {
        return "ONAYLANMADI";
    } elseif ($Metin == "PENDING_REVIEW") {
        return "İNCELEME BEKLENİYOR";
    } elseif ($Metin == "UNDER_REVIEW") {
        return "İNCELEMEDE";
    } elseif ($Metin == "UNKNOWN") {
        return "BİLİNMEYEN";
    } elseif ($Metin == "UNSPECIFIED") {
        return "BELİRTİLMEMİŞ";
    } else {
        return $Metin; // Eğer hiçbir koşul uymazsa gelen metni olduğu gibi döndür
    }
}


public function GoogleAdsPost($CustomerId='',$LoginID='',$Token='',$Bearer='',$Params,$urlfind)
{

$urlp='https://googleads.googleapis.com/v15/customers/'.$CustomerId.'/'.$urlfind;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlp,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($Params),
  CURLOPT_HTTPHEADER => array(
    'developer-token: '.$Token,
    'login-customer-id: '.$LoginID,
    'Authorization: Bearer '.$Bearer,
    'Accept: application/json',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}





  }






    ?>
