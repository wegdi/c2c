<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();

$PageUrl=$_POST["PageUrl"];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url='.$PageUrl.'&category=PERFORMANCE&strategy=DESKTOP&locale=tr&key=AIzaSyDvBnp_Y3wmbcLWgW6cJfPLfaqWESdqU3U',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);
$response=json_decode($response,1);

?>

<div class="row justify-content-center">
  <div class="col-xxl-12">
    <div class="card" id="demo">
      <div class="row">
        <div class="col-lg-12">
          <div class="card-header border-bottom-dashed p-4">
            <div class="d-flex">
              <div class="flex-grow-1">
                <img src="<?php echo $db->GetSystem("Logo"); ?>" class="card-logo card-logo-dark" alt="logo dark" height="50">
                <img src="<?php echo $db->GetSystem("Logo"); ?>" class="card-logo card-logo-light" alt="logo light" height="50">
                <div class="mt-sm-5 mt-4">
                  <h6 class="text-muted text-uppercase fw-semibold">Alan Adı Bilgileriniz</h6>
                  <p class="text-muted mb-1" id="address-details"><?php echo $response["lighthouseResult"]["finalDisplayedUrl"]; ?></p>
                  <h6 class="text-muted text-uppercase fw-semibold">Test Zamanı</h6>

                  <p class="text-muted mb-1" id="address-details"><?php echo $response["lighthouseResult"]["fetchTime"]; ?></p>

                </div>
              </div>
              <div class="flex-shrink-0 mt-sm-0 mt-3">
                <h6><span class="text-muted fw-normal">AkıllıPanda Dijital Pazarlama Ajansı</span></h6>
                <h6><span class="text-muted fw-normal">Mail Adresimiz:</span><span id="email">info@akillipanda.com</span></h6>
                <h6><span class="text-muted fw-normal">Web Site:</span> <a href="https://akillipanda.com/" class="link-primary" target="_blank" id="website">https://akillipanda.com</a></h6>
                <h6 class="mb-0"><span class="text-muted fw-normal">Müşteri Hizmetleri: </span><span id="contact-no"> 0850 302 29 99</span></h6>
              </div>
            </div>
          </div>
          <!--end card-header-->
        </div><!--end col-->
        <div class="col-lg-12">
          <div class="card-body p-4">
            <div class="row g-3">





              <!-- Accordions Bordered -->
              <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-secondary" id="accordionBordered">

                <?php foreach ($response["lighthouseResult"]["audits"] as $key => $value): ?>
                  <?php if ($value["displayValue"]): ?>


                  <div class="accordion-item mt-2">
                    <h2 class="accordion-header" id="accordionborderedExample2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo trim($key); ?>" aria-expanded="false" aria-controls="<?php echo trim($key); ?>">
                        <?php echo $value["title"]; ?>
                        <?php if ($value["displayValue"]): ?>
                            - <b>(<?php echo $value["displayValue"]; ?>)</b>
                        <?php endif; ?>

                      </button>
                    </h2>
                    <div id="<?php echo trim($key); ?>" class="accordion-collapse collapse" aria-labelledby="accordionborderedExample2" data-bs-parent="#accordionBordered">
                      <div class="accordion-body">            <div class="mt-4">
                          <div class="alert alert-info">
                            <p class="mb-0"><span class="fw-semibold">Nasıl Çözerim:</span>
                              <span id="note">
                                <?php echo $value["description"]; ?>
                              </span>
                            </p>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                    <?php endif; ?>
                <?php endforeach; ?>


              </div>





            </div>
            <!--end row-->
          </div>
          <!--end card-body-->
        </div><!--end col-->


      </div><!--end row-->
    </div>
    <!--end card-->
  </div>
  <!--end col-->
</div>
<pre>
  <?php //print_R($response["lighthouseResult"]["audits"]);
  ?>
</pre>
