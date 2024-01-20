<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'Datebase/Mongo/Mongo.php');
require_once(CONTROLLER.'AppControl/ThemesControl/ThemesControl.php');



class General
{
  private $mongo;

  public function __construct()
  {
    $this->mongo = new MongoDBConnection(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
    $this->Themes = new Themes(); // Instantiate the Themes object

  }

  public function Seconds($Duration="0"){
    $seconds = $Duration; // $Duration değişkeni saniye cinsinden bir süreyi temsil ediyor
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;

    $formattedDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    return $formattedDuration;
  }

  public function SecondsJS($Duration="0"){
    $seconds = $Duration; // $Duration değişkeni saniye cinsinden bir süreyi temsil ediyor
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;

    $formattedDuration = sprintf('%02d,%02d', $hours, $minutes);
    return $formattedDuration;
  }


  public function Seflink($text)
  {
    $find = array("/Ğ/", "/Ü/", "/Ş/", "/İ/", "/Ö/", "/Ç/", "/ğ/", "/ü/", "/ş/", "/ı/", "/ö/", "/ç/");
    $degis = array("G", "U", "S", "I", "O", "C", "g", "u", "s", "i", "o", "c");
    $text = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/", " ", $text);
    $text = preg_replace($find, $degis, $text);
    $text = preg_replace("/ +/", " ", $text);
    $text = preg_replace("/ /", "-", $text);
    $text = preg_replace("/\s/", "", $text);
    $text = strtolower($text);
    $text = preg_replace("/^-/", "", $text);
    $text = preg_replace("/-$/", "", $text);

    // İlk harfleri büyük yap
    $words = explode("-", $text);
    $result = array_map(function ($word) {
      return ucfirst($word);
    }, $words);
    $text = implode("-", $result);
    $text = str_replace("-","/", $text);
    return $text;
  }


  public function generateRandomNumber($length=10) {
      if ($length < 1 || $length > 10) {
          throw new Exception("Uzunluk 1 ile 10 arasında olmalıdır.");
      }

      $minValue = pow(10, $length - 1); // 10 basamaklı sayının minimum değeri
      $maxValue = pow(10, $length) - 1; // 10 basamaklı sayının maksimum değeri

      return mt_rand($minValue, $maxValue);
  }
  public function Base64File($fileInputName) {
      if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
          $tempFile = $_FILES[$fileInputName]['tmp_name'];
          $imageInfo = getimagesize($tempFile);

          $sourceWidth = $imageInfo[0];
          $sourceHeight = $imageInfo[1];
          $maxSize = 200; // Maksimum boyutu 200x200 piksel olarak ayarlıyoruz

          // Yüklenen resmin boyutunu ayarlıyoruz
          if ($sourceWidth > $maxSize || $sourceHeight > $maxSize) {
              if ($sourceWidth > $sourceHeight) {
                  $newWidth = $maxSize;
                  $newHeight = intval($sourceHeight * ($maxSize / $sourceWidth));
              } else {
                  $newHeight = $maxSize;
                  $newWidth = intval($sourceWidth * ($maxSize / $sourceHeight));
              }

              // Yeni boyutlarda resmi yeniden örnekleme (resize) ediyoruz
              $tempImage = imagecreatetruecolor($newWidth, $newHeight);

              // Yüklenen resim dosyasının uzantısına göre uygun imagecreatefrom... fonksiyonunu kullanıyoruz
              if ($imageInfo[2] == IMAGETYPE_JPEG) {
                  $sourceImage = imagecreatefromjpeg($tempFile);
              } elseif ($imageInfo[2] == IMAGETYPE_PNG) {
                  $sourceImage = imagecreatefrompng($tempFile);

                  // PNG resimlerinin arka planını saydam yapmak için alpha kanalını etkinleştiriyoruz
                  imagealphablending($tempImage, false);
                  imagesavealpha($tempImage, true);
              } elseif ($imageInfo[2] == IMAGETYPE_GIF) {
                  $sourceImage = imagecreatefromgif($tempFile);
              } else {
                  // Desteklenmeyen resim türü
                  return null;
              }

              // PNG resimlerinin arka planını saydam yapmak için alpha kanalını etkinleştiriyoruz
              if ($imageInfo[2] == IMAGETYPE_PNG) {
                  imagealphablending($tempImage, false);
                  imagesavealpha($tempImage, true);
              }

              imagecopyresampled($tempImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);

              // Yeniden boyutlandırılmış resmi base64 formatına dönüştürüyoruz
              ob_start();
              imagepng($tempImage); // PNG resimlerini imagepng() fonksiyonuyla kaydediyoruz
              $fileData = ob_get_clean();
          } else {
              // Yüklenen resim boyutları zaten istenen boyutlardsa, direkt olarak kullanıyoruz
              $fileData = file_get_contents($tempFile);
          }

          $base64Data = base64_encode($fileData);

          // Dosya türüne göre uygun başlık (header) belirleyin
          $fileType = $_FILES[$fileInputName]['type'];
          $base64DataWithHeader = 'data:' . $fileType . ';base64,' . $base64Data;

          return $base64DataWithHeader;
      } else {
          return null; // No file uploaded or error occurred
      }
  }



  public function PlatformStatus($statu="")
  {

    if ($statu==0) {
      $status='<span class="badge border border-primary text-primary">Yeni Sipariş</span>';
    }elseif ($statu==1) {
      $status='<span class="badge border border-secondary text-secondary">İşlemde</span>';
    }elseif ($statu==2) {
      $status='<span class="badge border border-warning text-warning">Kargoda</span>';
    }elseif ($statu==3) {
      $status='<span class="badge border border-danger text-danger">İptal Edildi</span>';
    }elseif ($statu==4) {
      $status='<span class="badge border border-success text-success">Teslim Edildi</span>';
    }
    return $status;
  }



  public function uploadXLSFile($file)
  {
      // İzin verilen dosya uzantıları
      $allowedExtensions = array('xlsx', 'xls');

      // Dosyanın yüklendiği geçici konumu al
      $tempFilePath = $file['tmp_name'];

      // Dosya adını al
      $fileName = $file['name'];

      // Dosya uzantısını al
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      // Uzantıyı kontrol et
      if (!in_array($fileExtension, $allowedExtensions)) {
          // İzin verilmeyen uzantı
          return false;
      }

      // Yeni dosya adı oluştur (isteğe bağlı)
      $newFileName = uniqid('uploaded_', true) . '.' . $fileExtension;

      // Dosyayı belirlediğiniz bir klasöre taşıyın veya kaydedin (örneğin: uploads/)
      $targetDirectory = FILE;
      $targetFilePath = $targetDirectory . $newFileName;
      if (!move_uploaded_file($tempFilePath, $targetFilePath)) {
      // Dosya taşıma başarısız oldu
      return false;
  }

  // Dosya başarıyla yüklendi ve kaydedildi
  return $newFileName;
  }

  public function Add($tablo,$data)
  {
    // MongoDB bağlantısını alın
    $connection = $this->mongo->getConnection();

    // Veriyi eklemek için MongoDB'ye bir komut oluştur
    $bulk = new MongoDB\Driver\BulkWrite;
    // Veriyi ekle
    $bulk->insert($data);

    try {
      // MongoDB'ye veriyi gönder
      $connection->executeBulkWrite(DB_DATABASE.'.'.$tablo, $bulk);
      // Başarılı durumda JSON sonucunu oluştur ve döndür
      $result = array(
        'success' => true,
        'message' => $this->Themes->Translate("TEXT_INSERT"),
        'data' => $data // Eklendi veriyi de JSON'a ekleyebilirsiniz
      );
      return json_encode($result);
    } catch (Exception $e) {
      // Hatalı durumda JSON sonucunu oluştur ve döndür
      $result = array(
        'success' => false,
        'message' =>  $this->Themes->Translate("TEXT_INSERT_ERROR")
      );
      return json_encode($result);
    }
  }


  public function Query($tablo, $filter = [], $projection = [], $mode = 'TEK', $start = 0, $length = 0)
  {
      // Get the MongoDB collection
      $connection = $this->mongo->getConnection();

      // Create the MongoDB\Driver\Query object with the provided filter and projection
      $query = new MongoDB\Driver\Query($filter, $projection);

      // Perform the query
      $queryResult = $connection->executeQuery(DB_DATABASE . '.' . $tablo, $query);

      // Initialize the result array
      $resultArray = [];

      foreach ($queryResult as $index => $document) {
          // Convert each document to an associative array
          $documentArray = (array)$document;

          if ($index >= $start && ($length === 0 || $index < $start + $length)) {
              // Add the whole document (with the _id field) to the result array
              $resultArray[] = $documentArray;
          }
      }

      switch ($mode) {
          case 'TEK':
              // Return the first document (single result) if exists, otherwise null
              return $resultArray[0] ?? null;
              break;

          case 'COK':
              // Return the modified result array for multiple documents
              return $resultArray;
              break;

          default:
              // Return the first document (single result) if exists, otherwise null
              return $resultArray[0] ?? null;
              break;
      }
  }


    public function ObjectId($value='')
    {
      $objectId = new MongoDB\BSON\ObjectId("$value");
      return $objectId;
    }


    public function IdeaSoftToken()
    {
      $IdeaSoft = $this->Query('IdeaSoft',['_id' => $this->ObjectId("65a784f66b188048239f446c")], [], 'TEK');

      $token='Bearer '.$IdeaSoft["access_token"];
      return $token;
    }

    public function IdeaSoftRefreshToken()
    {
      $IdeaSoft = $this->Query('IdeaSoft',['_id' => $this->ObjectId("65a784f66b188048239f446c")], [], 'TEK');

      $token=$IdeaSoft["refresh_token"];
      return $token;
    }


    public function GoogleRemainingBudget()
    {
      date_default_timezone_set('Europe/London');

      $date=strtotime(date('Y-m-d'));

      $filt=['Date' => (int)$date,'CompaniesCode' => (int)$this->GetUser('CompanyCode')];
      $GoogleCampaign = $this->Query('GoogleCampaign',$filt,[], 'COK');
      $Remaining_Budget=0;
      foreach ($GoogleCampaign as $key => $value) {
        $Remaining_Budget =$Remaining_Budget + $value["Remaining_Budget"];
      }

      return number_format($Remaining_Budget, 2, ',', '.');
    }

    public function QueryID($tablo, $Id, $Request = "" , $metod="TEK")
    {

        // ObjectId formatı kontrol ediliyor
        if ($Id>10) {
            $objectId = new MongoDB\BSON\ObjectId($Id);
            $Authorisssty = $this->Query($tablo, ["_id" => $objectId], [], $metod);
            return $Authorisssty[$Request];
        } else {
            // Hatalı ObjectId formatı için uygun işlemler yapılabilir veya hata döndürebilirsiniz.
            return null;
        }
    }


  public function Quantity($tablo, $filter = [])
  {
    // Get the MongoDB collection
    $connection = $this->mongo->getConnection();

    // Create the MongoDB\Driver\Query object with the provided filter
    $query = new MongoDB\Driver\Query($filter);

    // Perform the count query
    $queryResult = $connection->executeQuery(DB_DATABASE . '.' . $tablo, $query);

    // Get the total count of rows
    $totalRows = count($queryResult->toArray());

    return $totalRows;
  }

  public function Company($value)
  {
    // Get the MongoDB collection
    $CompanyCode = $this->GetUser("CompanyCode");
    $Company=$this->Query('Companies',['CompanyCode' => (int)$CompanyCode],[], 'TEK');
    return $Company[$value];
  }


  public function CompanyAdmin($value,$CompanyCode='')
  {
    // Get the MongoDB collection
    $Company=$this->Query('Companies',['CompanyCode' => (int)$CompanyCode],[], 'TEK');
    return $Company[$value];
  }




  public function DeleteByObjectId($tablo, $objectId)
  {
      // Get the MongoDB collection
      $connection = $this->mongo->getConnection();

      // Create the MongoDB\Driver\BulkWrite object to perform bulk operations
      $bulkWrite = new MongoDB\Driver\BulkWrite;

      // Add the delete operation to the BulkWrite object
      $bulkWrite->delete(['_id' => new MongoDB\BSON\ObjectID($objectId)]);

      try {
          // Perform the delete operation
          $connection->executeBulkWrite(DB_DATABASE . '.' . $tablo, $bulkWrite);

          // Return success response as JSON
          return json_encode(['success' => true]);
      } catch (Exception $e) {
          // Return error response as JSON
          return json_encode(['success' => false, 'error' => $e->getMessage()]);
      }
  }


  public function UpdateGenereal($tablo, $filter, $updateData)
  {
      // Get the MongoDB collection
      $connection = $this->mongo->getConnection();

      // Create the MongoDB\Driver\BulkWrite object to perform bulk operations
      $bulkWrite = new MongoDB\Driver\BulkWrite;

        $filter = [$columnName => $columnValue];
      // Add the update operation to the BulkWrite object
      $bulkWrite->update(
          $filter,
          ['$set' => $updateData], // The new data to update the document with
          ['multi' => false, 'upsert' => false] // Options: multi allows updating multiple documents, upsert creates the document if not found
      );

      try {
          // Perform the update operation
          $result = $connection->executeBulkWrite(DB_DATABASE . '.' . $tablo, $bulkWrite);

          // Check if any documents were modified
          if ($result->getModifiedCount() > 0) {
              // Return success response as JSON
              return json_encode(['success' => true]);
          } else {
              // Return error response as JSON (document not found)
              return json_encode(['success' => false, 'error' => 'Document not found']);
          }
      } catch (Exception $e) {
          // Return error response as JSON
          return json_encode(['success' => false, 'error' => $e->getMessage()]);
      }
  }

  public function UpdateByObjectId($tablo, $objectId, $updateData)
  {
      // Get the MongoDB collection
      $connection = $this->mongo->getConnection();

      // Create the MongoDB\Driver\BulkWrite object to perform bulk operations
      $bulkWrite = new MongoDB\Driver\BulkWrite;

      // Add the update operation to the BulkWrite object
      $bulkWrite->update(
          ['_id' => new MongoDB\BSON\ObjectID($objectId)],
          ['$set' => $updateData], // The new data to update the document with
          ['multi' => false, 'upsert' => false] // Options: multi allows updating multiple documents, upsert creates the document if not found
      );

      try {
          // Perform the update operation
          $result = $connection->executeBulkWrite(DB_DATABASE . '.' . $tablo, $bulkWrite);

          // Check if any documents were modified
          if ($result->getModifiedCount() > 0) {
              // Return success response as JSON
              return json_encode(['success' => true]);
          } else {
              // Return error response as JSON (document not found)
              return json_encode(['success' => false, 'error' => 'Document not found']);
          }
      } catch (Exception $e) {
          // Return error response as JSON
          return json_encode(['success' => false, 'error' => $e->getMessage()]);
      }
  }



    public function DailyBudgetBar($mobilCompanyCode='')
    {
      date_default_timezone_set('Europe/London');


      $filter = array();
      $sort = array();


      if (empty($mobilCompanyCode)) {
        $filter['CompaniesCode'] = (int)$this->GetUser('CompanyCode');

      }else {
        $filter['CompaniesCode'] = (int)$mobilCompanyCode;

      }

      $Date = date('Y-m-d');
      $singleDate = strtotime($Date);
      $filter['Date'] = $singleDate;

      $GoogleCampaign = $this->Query('GoogleCampaign', $filter,[], 'COK');
      $total=0;
      foreach ($GoogleCampaign as $key => $value) {
        $total =$total + $value["Remaining_Budget"];

      }
      return $total;

    }


    public function DailyBudgetBarAdmin($CompanyCode='')
    {
      date_default_timezone_set('Europe/London');


      $filter = array();
      $sort = array();

      $filter['CompaniesCode'] = (int)$CompanyCode;
      $Date = date('Y-m-d');
      $singleDate = strtotime($Date);
      $filter['Date'] = $singleDate;

      $GoogleCampaign = $this->Query('GoogleCampaign', $filter,[], 'COK');
      $total=0;
      foreach ($GoogleCampaign as $key => $value) {
        $total =$total + $value["Remaining_Budget"];

      }
      return $total;

    }


    public function NegativeWords()
    {
      date_default_timezone_set('Europe/London');


      $filter = array();
      $sort = array();

      $filter['CompanyCode'] = (int)$this->GetUser('CompanyCode');


      $GoogleCampaign = $this->Query('GoogleNegativeWords', $filter,[], 'COK');
      return count($GoogleCampaign);

    }


    public function Last30($mobilCompanyCode='')
  {
    $filter = array();
    $sort = array();

    // 30 gün önceki tarihi hesapla
    $startDate = strtotime("-30 days");
    $endDate = time(); // Şu anki tarih

    // Create a Date range filter
    $filter['Date'] = [
      '$gte' => $startDate, // Büyük eşit (greater than or equal)
      '$lte' => $endDate    // Küçük eşit (less than or equal)
    ];

    if (empty($mobilCompanyCode)) {
      $filter['CompaniesCode'] = (int)$this->GetUser('CompanyCode');

    }else {
      $filter['CompaniesCode'] = (int)$mobilCompanyCode;

    }

    $GoogleCampaign = $this->Query('GoogleCampaign', $filter, [], 'COK');
    $total = 0;

    foreach ($GoogleCampaign as $key => $value) {
      $total = $total + $value["Remaining_Budget"];
    }

    return $total;
  }



    public function TotatlBuget($mobilCompanyCode='')
    {
      $filter = array();
      $sort = array();

      if (empty($mobilCompanyCode)) {
        $filter['CompaniesCode'] = (int)$this->GetUser('CompanyCode');

      }else {
        $filter['CompaniesCode'] = (int)$mobilCompanyCode;

      }
      $GoogleCampaign = $this->Query('GoogleCampaign', $filter,[], 'COK');
      $total=0;
      foreach ($GoogleCampaign as $key => $value) {
        $total =$total + $value["Remaining_Budget"];

      }
      return $total;

    }

    public function TotatlConversion($mobilCompanyCode='')
    {

      $filter = array();
      $sort = array();

      if (empty($mobilCompanyCode)) {
        $filter['CompaniesCode'] = (int)$this->GetUser('CompanyCode');

      }else {
        $filter['CompaniesCode'] = (int)$mobilCompanyCode;

      }

      $GoogleCampaign = $this->Query('GoogleCampaign', $filter,[], 'COK');
      $total=0;
      foreach ($GoogleCampaign as $key => $value) {
        $total =$total + $value["CampaignConversion"];

      }
      return $total;

    }

    public function Conversion30($mobilCompanyCode='')
  {
    $filter = array();
    $sort = array();

    // 30 gün önceki tarihi hesapla
    $startDate = strtotime("-30 days");
    $endDate = time(); // Şu anki tarih

    // Create a Date range filter
    $filter['Date'] = [
      '$gte' => $startDate, // Büyük eşit (greater than or equal)
      '$lte' => $endDate    // Küçük eşit (less than or equal)
    ];
    if (empty($mobilCompanyCode)) {
      $filter['CompaniesCode'] = (int)$this->GetUser('CompanyCode');

    }else {
      $filter['CompaniesCode'] = (int)$mobilCompanyCode;

    }

    $GoogleCampaign = $this->Query('GoogleCampaign', $filter, [], 'COK');
    $total = 0;

    foreach ($GoogleCampaign as $key => $value) {
      $total = $total + $value["CampaignConversion"];
    }

    return $total;
  }

  public function ResimPost($base64,$CompanyCode){

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://cdn.wegdi.com/image.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('Token' => 'EZ24y17C7L6Zt9R','image' =>$base64,'CompanyCode' => $CompanyCode),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  return $response;
  }

  public function resimleriBase64eCevirVaryant($dosyaIsim) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES[$dosyaIsim])) {
          $dosyalar = $_FILES[$dosyaIsim];
          $base64Resimler = array();

          // Dosya sayısına göre dön
          $dosyaSayisi = count($dosyalar['name']);
          for ($i = 0; $i < $dosyaSayisi; $i++) {
              $dosyaAdi = $dosyalar['name'][$i];
              $dosyaUzantisi = pathinfo($dosyaAdi, PATHINFO_EXTENSION);
              $desteklenenFormatlar = array('jpg', 'jpeg', 'png');

              // Dosya yükleme hatası kontrolü
              if ($dosyalar['error'][$i] === UPLOAD_ERR_OK) {

                  // Desteklenen formatları kontrol et
                  if (in_array($dosyaUzantisi, $desteklenenFormatlar)) {
                      // Resmi base64'e dönüştür
                      $resimVerisi = file_get_contents($dosyalar['tmp_name'][$i]);
                      $base64Resim = base64_encode($resimVerisi);
                      $base64Resimler[] = 'data:image/' . $dosyaUzantisi . ';base64,' . $base64Resim;
                  } else {
                      return "Geçersiz dosya formatı. Yalnızca JPG, JPEG ve PNG kabul edilir.";
                  }
              } else {
                  return 'Dosya yükleme hatası: ' . $dosyalar['error'][$i];
              }
          }

          return $base64Resimler;
      } else {
          return 'Resim dosyaları POST verileri içinde bulunamadı.';
      }
  }


public  function customShortHash($input, $length = 10) {
    $hash = md5($input);
    return substr($hash, 0, $length);
}





  public function resimleriBase64eCevir($dosyaIsim) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES[$dosyaIsim])) {
          $dosyalar = $_FILES[$dosyaIsim];
          $base64Resimler = array();

          // Dosya sayısına göre dön
          $dosyaSayisi = count($dosyalar['name']);
          for ($i = 0; $i < $dosyaSayisi; $i++) {
              $dosyaAdi = $dosyalar['name'][$i]['image'];
              $dosyaUzantisi = pathinfo($dosyaAdi, PATHINFO_EXTENSION);
              $desteklenenFormatlar = array('jpg', 'jpeg', 'png');

              // Dosya yükleme hatası kontrolü
              if ($dosyalar['error'][$i]['image'] === UPLOAD_ERR_OK) {

                  // Desteklenen formatları kontrol et
                  if (in_array($dosyaUzantisi, $desteklenenFormatlar)) {
                      // Resmi base64'e dönüştür
                      $resimVerisi = file_get_contents($dosyalar['tmp_name'][$i]['image']);
                      $base64Resim = base64_encode($resimVerisi);
                      $base64Resimler[] = 'data:image/' . $dosyaUzantisi . ';base64,' . $base64Resim;
                  } else {
                      return "Geçersiz dosya formatı. Yalnızca JPG, JPEG ve PNG kabul edilir.";
                  }
              } else {
                  return 'Dosya yükleme hatası: ' . $dosyalar['error'][$i]['image'];
              }
          }

          return $base64Resimler;
      } else {
          return 'Resim dosyaları POST verileri içinde bulunamadı.';
      }
  }



  public function resmiBase64eCevir($dosyaIsim) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES[$dosyaIsim])) {
          $dosya = $_FILES[$dosyaIsim];

          if ($dosya['error'] === UPLOAD_ERR_OK) {
              $resimDosyasi = $dosya['tmp_name'];
              $resimDosyasiname = $dosya['name'];



              $desteklenenFormatlar = array('jpg', 'jpeg','png');
              $dosyaUzantisi = pathinfo($resimDosyasiname, PATHINFO_EXTENSION);
              // Desteklenen formatları kontrol et
              if (in_array($dosyaUzantisi, $desteklenenFormatlar)) {
                  // Resmi base64'e dönüştür
                  $resimVerisi = file_get_contents($resimDosyasi);
                  $base64Resim = base64_encode($resimVerisi);

                  return 'data:image/' . $dosyaUzantisi . ';base64,' . $base64Resim;
              } else {
                  return "Geçersiz dosya formatı. Yalnızca JPG, JPEG ve PNG kabul edilir.";
              }
          } else {
              return 'Dosya yükleme hatası: ' . $dosya['error'];
          }
      } else {
          return 'Resim dosyası POST verileri içinde bulunamadı.';
      }
  }




  public function Guvenlik($tr1)
  {
    $turkce=array("mysql","select","from","*","<?php","php","<?","","+","union","database","concat","substring","limit","column","ascii","'","<",">",";","/","?","=","&","#","%","{","}","|","union","exec","select","insert", "update","delete","drop","sp","xp");
    $duzgun=array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
    $tr1=str_replace($turkce,$duzgun,$tr1);
    return $tr1;
  }

  public function GetUser($value='')
  {
    $token=$_SESSION["token"];
    $UserGet=$this->Query('Users',['token' => $token],[], 'TEK');
    return $UserGet[$value];
  }


  public function getParentCategories($Companies, $categoryId)
  {
      $parentCategories = [];

      while ($categoryId !== "0") {
          $categoryInfo = $this->Query($Companies . '_Category', ['_id' => new MongoDB\BSON\ObjectId($categoryId)], [], 'TEK');

          if (!empty($categoryInfo)) {
              array_unshift($parentCategories, $categoryInfo["CategoryName"]);
              $categoryId = $categoryInfo["ParentId"];
          } else {
              break;
          }
      }

      return implode(' > ', $parentCategories);
  }



  public function processSubCategories($categories, $parentCategoryName = '')
  {
      $result = []; // Sonuç dizisi

      foreach ($categories as $category) {
          $categoryName = $category["name"];
          $categoryId = $category["id"];

          $fullCategoryName = $parentCategoryName . ($parentCategoryName ? ' > ' : '') . $categoryName;

          // Diziye ekle
          $result[] = [
              'id' => $categoryId,
              'name' => $fullCategoryName,
          ];

          if (!empty($category["subCategories"])) {
              // Alt kategorileri işlemek için rekürsif olarak çağırın
              $subCategoriesResult = $this->processSubCategories($category["subCategories"], $fullCategoryName);

              // Alt kategorilerin sonuçlarını sonuç dizisine birleştirin
              $result = array_merge($result, $subCategoriesResult);
          }
      }

      return $result; // Sonuç dizisini döndür
  }



  public function turkishToEnglish($text) {
      $search = array('ç', 'ğ', 'ı', 'i', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'I', 'İ', 'Ö', 'Ş', 'Ü');
      $replace = array('c', 'g', 'i', 'i', 'o', 's', 'u', 'C', 'G', 'I', 'I', 'O', 'S', 'U');

      $englishText = strtr($text, array_combine($search, $replace));

      return $englishText;
  }

  public function GetStatus($value='')
  {
    $UserGet=$this->Query('Status',['_id' => $value],[], 'TEK');
    return $UserGet["StatusName"];
  }
  public function GetSource($value='')
  {
    $UserGet=$this->Query('Source',['_id' => $value],[], 'TEK');
    return $UserGet["SourceName"];
  }

  public function GetUserLead($value='')
  {
    $UserGet=$this->Query('Users',['_id' => $value],[], 'TEK');
    return $UserGet["NameSurname"];
  }

  public function GetSystem($value='')
  {
    $GetSystem=$this->Query('Settings',["Condition" => 'System'],[], 'TEK');
    return $GetSystem[$value];
  }

  public function Authority($value='',$Request='')
  {

    $Authority=$this->Query('Authority',['Authority' => (int)$value],[], 'TEK');
    return $Authority[$Request];
  }

  public function BarMainGet($value='',$Request='')
  {
    $Authority=$this->Query('Menus',['_id' => (string)$value],[], 'TEK');
    return $Authority[$Request];
  }


  public function BarGet($value='',$Request='')
  {

    $Authority=$this->Query('Menus',['Seo_Url' => (string)$value],[], 'TEK');
    return $Authority[$Request];
  }

  public function Get_Client_Ip() {
    // IP adresini almak için HTTP_X_FORWARDED_FOR, HTTP_CLIENT_IP veya REMOTE_ADDR değişkenlerini kullanabiliriz.

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Eğer IP adresi HTTP_X_FORWARDED_FOR değişkeninde mevcutsa bu değeri alıyoruz
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
        // Eğer IP adresi HTTP_CLIENT_IP değişkeninde mevcutsa bu değeri alıyoruz
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        // Eğer yukarıdaki değişkenlerde IP adresi yoksa, IP adresini REMOTE_ADDR değişkeninden alıyoruz
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Birden fazla IP adresi gönderilmişse ilk IP adresini alıyoruz
    $ip = explode(',', $ip);
    $ip = trim($ip[0]);

    // IP adresini döndürüyoruz
    return $ip;
}

    public  function getBrowserInfo() {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            return $_SERVER['HTTP_USER_AGENT'];
        } else {
            return "Tarayıcı bilgileri bulunamadı.";
        }
    }


    public function PaymentsOne($table="") {
      $Payments = $this->Query('Payments', [], [], 'COK');
      $Response = [];

      foreach ($Payments as $key => $value) {
          if (!in_array($value["$table"], $Response)) {
              $Response[] = $value["$table"];
          }
      }

      return $Response;
    }


    public function RemoveRenewed($st,$table="") {
      $Payments = $this->Query($st, [], [], 'COK');
      $Response = [];

      foreach ($Payments as $key => $value) {
          if (!in_array($value["$table"], $Response)) {
              $Response[] = $value["$table"];
          }
      }

      return $Response;
    }

    public function PaymentsStatus($param="") {

      switch ($param) {
        case '1':
          return '<button type="button" class="btn btn-sm btn-success btn-label waves-effect right waves-light rounded-pill"><i class="ri-check-double-line label-icon align-middle rounded-pill fs-16 ms-2"></i>'.$this->Themes->Translate("BUTTON_SUCCESS").'</button>';
          break;
        case '2':
          return '<button type="button" class="btn btn-sm btn-danger btn-label waves-effect right waves-light rounded-pill"><i class="ri-error-warning-line label-icon align-middle rounded-pill fs-16 me-2 "></i>'.$this->Themes->Translate("BUTTON_WARNING").'</button>';
          break;

        default:
          // code...
          break;
      }
    }


    public function AgentGet()
    {
      $Agent = $this->Query('Authority',['Name' => 'Agent'], [], 'TEK');
      $Management = $this->Query('Authority',['Name' => 'Management'], [], 'TEK');
      $Administrator = $this->Query('Authority',['Name' => 'Administrator'], [], 'TEK');

      if ((string)$Management["_id"]==$this->GetUser("Authority") || (string)$Administrator["_id"]==$this->GetUser("Authority")) {
      }else {
        $filter['Groups'] =$this->GetUser("Groups");
      }
      $filter['Authority'] =(string)$Agent["_id"];


      $Users=$this->Query('Users',$filter, ['sort' => ['_id' => 1]], 'COK');
      return $Users;
    }

    public   function KdvHesapla($tutar,$komsiyon){ //Fonksiyon Başlangıcı
      $KdvHesap=$tutar/(1+$komsiyon/100);
      return $KdvHesap;

    }



  public function Login($deger)
  {
    session_start();

    $session = $deger["session"];
    $tablo = $deger["tablo"];
    $tblUser = $deger["tblUser"];
    $tblPass = $deger["tblPass"];
    $userValue = $this->Guvenlik($deger["userValue"]);
    $passValue = md5($deger["passValue"]);
    $homePage = $deger["homePage"];
    $loginPage = $deger["loginPage"];
    $logoutPage = $deger["logoutPage"];
    $panel = $deger["panel"];

    // MongoDB bağlantısını alın
    $connection = $this->mongo->getConnection();


    // MongoDB'de kullanıcı sorgusu
    $filter = [
      $tblUser => $userValue,
      $tblPass => $passValue,
      'Status' => '1'
    ];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $connection->executeQuery($tablo, $query);
    $islem = $cursor->toArray();

    if (!empty($islem)) {
      $_SESSION[$session] = true;
      $_SESSION['timeout'] = time();

      $token = md5(uniqid(time()));
      $tokenmobil = md5(md5(uniqid(time())));

      date_default_timezone_set($this->GetSystem("TimeZone"));
      $now = time();


      $Log = array(
        'Condition' => 'Login',
        'Message' => 'Login Success',
        'UserMail' => $userValue,
        'Date' => $now,
        'TimeZone' =>  $this->GetSystem("TimeZone"),
        'IpAdress' => $this->Get_Client_Ip(),
        'Browser' => $this->getBrowserInfo()
        );
        $this->Add("Log", $Log);

      // MongoDB'de token güncelleme işlemi
      $newData = [
        '$set' => ['token' => $token,'IpAdress' => $this->Get_Client_Ip(),'mobiltoken' => $tokenmobil],
      ];
      $options = [
        'multi' => false,
        'upsert' => false,
      ];
      $bulk = new MongoDB\Driver\BulkWrite;
      $bulk->update($filter, $newData, $options);
      $connection->executeBulkWrite($tablo, $bulk);

      if ($_SESSION[$session] == true) {
        if (isset($_SESSION['timeout'])) {
          $session_life = time() - $_SESSION['timeout'];

          if ($session_life > $this->inactive) {
            session_destroy();
            $response = [
              'status' => 'error',
              'message' => 'Session timeout',
            ];
          } else {
            setcookie("token", $token);
            $_SESSION['token'] = $token;
            $response = [
              'status' => $this->Themes->Translate("TEXT_SUCCESS"),
              'message' => $this->Themes->Translate("TEXT_LOGIN_SUCCESS"),
              'url' => $panel.'/'.$homePage,
              'token' => $tokenmobil,
              'success' => true

            ];
          }
        }
      }
    } else {
      $response = [
        'status' => $this->Themes->Translate("TEXT_ERROR"),
        'message' => $this->Themes->Translate("TEXT_LOGIN_ERROR"),
      ];
      $Log = array(
        'Condition' => 'Login',
        'Message' => 'Login Error',
        'UserMail' => $userValue,
        'Date' => $now,
        'TimeZone' =>  $this->GetSystem("TimeZone"),
        'IpAdress' => $this->Get_Client_Ip(),
        'Browser' => $this->getBrowserInfo()

        );
        $this->Add("Log", $Log);
    }

    // Output the response as JSON
    return json_encode($response);
  }


}


?>
