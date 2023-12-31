<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
$CompanyCode=$db->Company("CompanyCode");



?>
<style>
.scrollable-container {
max-height: 200px; /* Belirli bir yükseklik için gerektiğinde kaydırma çubuğu eklenecek */
overflow-y: auto; /* Yatay kaydırma çubuğunu etkinleştir */
border: 1px solid #ccc; /* İsteğe bağlı: çerçeve ekleyebilirsiniz */
padding: 10px; /* İsteğe bağlı: içerikle daha iyi bir görünüm için boşluk ekleyebilirsiniz */
}
</style>
<script src="https://api-maps.yandex.ru/2.1/?apikey=YOUR_API_KEY&lang=tr_TR" type="text/javascript"></script>
<style>
    #harita {
        width: 100%;
        height: 300px;
    }
    #dunya {
        width: 100%;
        height: 500px;
    }
</style>
<div class="row">
  <div class="col-xl-12">
    <div class="card crm-widget">
      <div class="card-body p-0">
        <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
          <div class="col">
            <div class="py-4 px-3">
              <h5 class="text-muted text-uppercase fs-13">Toplam Dönüşüm <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <i class="ri-space-ship-line display-6 text-muted"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h2 class="mb-0"><span class="counter-value" data-target="<?php echo floor($db->TotatlConversion()); ?>"><?php echo floor($db->TotatlConversion()); ?></span></h2>
                </div>
              </div>
            </div>
          </div><!-- end col -->
          <div class="col">
            <div class="py-4 px-3">
              <h5 class="text-muted text-uppercase fs-13">Son 30 Gün Dönüşüm <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <i class="ri-space-ship-line display-6 text-muted"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h2 class="mb-0"><span class="counter-value" data-target="<?php echo floor($db->Conversion30()); ?>"><?php echo floor($db->Conversion30()); ?></span></h2>
                </div>
              </div>
            </div>
          </div><!-- end col -->
          <div class="col">
            <div class="mt-3 mt-md-0 py-4 px-3">
              <h5 class="text-muted text-uppercase fs-13">Toplam Harcanan <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h2 class="mb-0">₺
                    <span class="" data-target="<?php echo number_format($db->TotatlBuget(), 2, ',', '.'); ?>"><?php echo number_format($db->TotatlBuget(), 2, ',', '.'); ?></span></h2>
                  </div>
                </div>
              </div>
            </div><!-- end col -->
            <div class="col">
              <div class="mt-3 mt-md-0 py-4 px-3">
                <h5 class="text-muted text-uppercase fs-13">Son 30 Gün <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0">
                    <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h2 class="mb-0">₺<span class="" data-target="<?php echo number_format($db->Last30(), 2, ',', '.'); ?>"><?php echo number_format($db->Last30(), 2, ',', '.'); ?></span></h2>
                  </div>
                </div>
              </div>
            </div><!-- end col -->

            <div class="col">
              <div class="mt-3 mt-lg-0 py-4 px-3">
                <h5 class="text-muted text-uppercase fs-13">Bu Gün Harcanan <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0">
                    <i class="ri-service-line display-6 text-muted"></i>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h2 class="mb-0"><span class="" data-target="<?php echo number_format($db->DailyBudgetBar(), 2, ',', '.'); ?>"><?php echo number_format($db->DailyBudgetBar(), 2, ',', '.');; ?></span></h2>
                  </div>
                </div>
              </div>
            </div><!-- end col -->
          </div><!-- end row -->
        </div><!-- end card body -->
      </div><!-- end card -->
    </div><!-- end col -->
  </div>

  <div class="row">

    <div class="col-xl-5">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title mb-0">Promosyon Kampanyası</h4>
        </div><!-- end card header -->



        <div class="card-body mt-4">
          <div class="card bg-light overflow-hidden">
            <div class="card sidebar-alert  text-center mx-4 mb-0 mt-3">
              <div class="card-body">
                <img src="<?php echo $Themes->ThemeUrl(); ?>/assets/images/giftbox.png" alt="">
                <div class="mt-4">
                  <?php if (floor($db->TotatlBuget())>100000): ?>
                    <h5> 6000₺ Reklam Bakiyesi Kazandınız</h5>
                    <p class="text-muted lh-base">Kazanılan Tutar Otomatik Olarak Hesabınıza Tanımlanır</p>

                  <?php else: ?>
                    <h5>100,000₺ de 6000₺ Reklam Bakiyesi Bizden!</h5>

                    <p class="text-muted lh-base">Kazanmak İçin : <b>₺<?php echo  number_format(100000-floor($db->TotatlBuget()), 2, ',', '.'); ?></b></p>
                    <a href="/Order/Add" class="btn btn-danger btn-label rounded-pill"><i class="ri-money-dollar-box-line  label-icon align-middle rounded-pill fs-16 me-2"></i> Bakiye Yükle</a>

                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-grow-1">
                </div>


                </div>
              </div>
              <?php
              $budget = $db->TotatlBuget();
              $progressPercentage = ($budget / 100000) * 100;

              ?>
              <div class="progress bg-secondary-subtle rounded-0">
                <div class="progress-bar bg-secondary" role="progressbar" style="width: <?php echo $progressPercentage; ?>%" aria-valuenow="<?php echo $progressPercentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div><!-- end card-body -->
        </div><!-- end card -->
      </div>

    <div class="col-7">
      <div class="row">

        <div class="col-xl-12" >
          <div class="card">
              <div class="card-header">
                  <h5 class="card-title mb-0">İllere Göre Kullanıcıların Toplamı</h5>
              </div>
              <div class="card-body">
                  <div id="harita" style="height: 330px;"></div>
              </div>
          </div>
        </div>
      </div>
    </div>



    </div>


    <div class="row">


      <div class="col-xl-5 col-md-6">
        <div class="card card-height-100">
          <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">AkıllıPandanın Tespit Ettiği Negatif Terimler</h4>
            <button type="button" class="btn btn-success waves-effect" data-bs-toggle="modal" data-bs-target="#myModal">Engelle</button>

          </div>

          <div class="card-body">

            <div class="row align-items-center">
              <div class="col-6">
                <h6 class="text-muted text-uppercase fw-semibold text-truncate fs-12 mb-3">Toplam Negatif Kelimeler</h6>
                <h4 class="mb-0"><?php echo $db->NegativeWords(); ?></h4>
              </div><!-- end col -->
              <div class="col-6">
                <div class="text-center">
                  <img src="<?php echo $Themes->ThemeUrl(); ?>/assets/images/illustrator-1.png" class="img-fluid" alt="">
                </div>
              </div><!-- end col -->
            </div><!-- end row -->


            <div class="mt-3 pt-2">
              <table id="NegatifeGoogle" class="display table table-bordered dt-responsive" style="width:100%">
                <thead >
                  <tr >
                    <th>Kelime</th>
                    <th>Durum</th>
                  </tr>
                </thead>

              </table>
            </div><!-- end -->



          </div><!-- end card body -->
        </div><!-- end card -->
      </div><!-- end col -->

      <div class="col-xl-7">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Aylık Raporlar</h4>
          </div><!-- end card header -->

          <div class="card-body mt-4">
            <canvas id="myChart"></canvas>
          </div><!-- end card-body -->
        </div><!-- end card -->
      </div>


    </div>




    <!-- Default Modals -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Negatif Anahtar Kelimeler</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form id="DonusumPostx">
                <!-- Basic Input -->



                <div class="mb-3">
                  <label class="form-label" for="inputGroupSelect01">Kampanya Seçin</label>
                  <select class="form-select" id="inputGroupSelect01" name="CampaignId" required>
                    <option selected>Seçiniz...</option>
                    <?php
                    $filter['CompaniesCode'] = (int)$db->GetUser('CompanyCode');

                    $Date = date('Y-m-d');
                    $singleDate = strtotime($Date);
                    $filter['Date'] = $singleDate;
                    $sort = ['CampaignView' => -1]; // Set the sort criteria

                    $GoogleCampaign = $db->Query('GoogleCampaign', $filter, $sort, 'COK');
                    ?>
                    <?php foreach ($GoogleCampaign as $key => $value): ?>
                      <?php

                      $GoogleAdGroup = $db->Query('GoogleAdGroup',['CampaignId' => (string)$value["CampaignId"]],[], 'TEK');
                      ?>
                      <option value="<?php echo  $GoogleAdGroup["Id"]; ?>"><?php echo  $value["CampaignName"]; ?></option>

                    <?php endforeach; ?>


                  </select>
                </div>

              </form>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kapat</button>
            <button type="button" class="btn btn-success"  onclick="FromSaveGlobal('#DonusumPostx','/System/Cron/GoogleAds/NegativeKeywordsAdd.php',1)">Kaydet</button>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->





    <?php
    $turkiyeBolgeler = [];

    $city = $db->Query('AnalyticsRaport', ["CompanyCode" => (string) $CompanyCode, "Type" => "city"], [], 'COK');

    foreach ($city as $keycity => $valuecity) {
    //  echo $valuecity["Name"];
      //echo "<br>";
        $GeoTurkey = $db->Query('GeoTurkey', ["name" => (string) $valuecity["Name"]], [], 'TEK');

        if (!empty($GeoTurkey) && isset($GeoTurkey["lat"]) && isset($GeoTurkey["long"])) {
            $lat = $GeoTurkey["lat"];
            $long = $GeoTurkey["long"];
            $Kisi=$valuecity["Total"];
            $turkiyeBolgeler[$valuecity["Name"]] = [
                'merkez' => [$lat, $long],
                'kullanici' => ["$Kisi Kullanıcı"]
            ];
        }
    }


    $DunyaBolgeler = [];

    $country = $db->Query('AnalyticsRaport', ["CompanyCode" => (string) $CompanyCode, "Type" => "countryId"], [], 'COK');

    foreach ($country as $keycountry => $valucountry) {
    //  echo $valucountry["Name"];
      //echo "<br>";
        $GeoCountry = $db->Query('GeoCountry', ["country" => (string)$valucountry["Name"]], [], 'TEK');

        if (!empty($GeoCountry) && isset($GeoCountry["latitude"]) && isset($GeoCountry["longitude"])) {
            $latx = $GeoCountry["latitude"];
            $longx = $GeoCountry["longitude"];
            $KisiC=$valucountry["Total"];
            $DunyaBolgeler[$GeoCountry["name"]] = [
                'merkez' => [$latx, $longx],
                'kullanici' => ["$KisiC Kullanıcı"]
            ];
        }
    }
    ?>



    <script>
        ymaps.ready(function () {
            var harita = new ymaps.Map('harita', {
                center: [39.9334, 32.8597], // Türkiye'nin ortasında
                zoom: 5
            });

            // Türkiye'nin illeri ve ilçelerini temsil eden bir dizi oluşturun
            var turkiyeBolgeler = <?php echo json_encode($turkiyeBolgeler, JSON_PRETTY_PRINT); ?>;

            // Her bir il için işaretçi (marker) ekleyin
            for (var il in turkiyeBolgeler) {
                if (turkiyeBolgeler.hasOwnProperty(il)) {
                    var ilBilgisi = turkiyeBolgeler[il];
                    var marker = new ymaps.Placemark(ilBilgisi.merkez, {
                        hintContent: il + ': ' + ilBilgisi.kullanici.join(', ')
                    });

                    harita.geoObjects.add(marker);
                }
            }
        });

        ymaps.ready(function () {
            var dunya = new ymaps.Map('dunya', {
                center: [30, 0], // Dünya'nın ortasında bir nokta (örneğin, 30 derece enlem, 0 derece boylam)
                zoom: 2
            });

            // Dünya ülkelerini temsil eden bir dizi oluşturun
            var DunyaBolgeler = <?php echo json_encode($DunyaBolgeler, JSON_PRETTY_PRINT); ?>;

            // Her bir ülke için işaretçi (marker) ekleyin
            for (var ulke in DunyaBolgeler) {
                if (DunyaBolgeler.hasOwnProperty(ulke)) {
                    var ulkeBilgisi = DunyaBolgeler[ulke];
                    var marker = new ymaps.Placemark(ulkeBilgisi.merkez, {
                        hintContent: ulke + ': ' + ulkeBilgisi.kullanici.join(', ')
                    });

                    dunya.geoObjects.add(marker);
                }
            }
        });
    </script>
