<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);



$Order = $db->Query('Order',['Status' => 1],[], 'COK');
$toplamfiyatx = 0;
foreach ($Order as $keyx => $valuex) {
  $toplamfiyatx = $toplamfiyatx+ $valuex['PaymentAmount'];
}
$kdvOrani = 35; // %35 KDV
$kdvHariçFiyat = $toplamfiyatx / (1 + ($kdvOrani / 100));

$Vergi=$toplamfiyatx-$kdvHariçFiyat;
$karlikik=floor($kdvHariçFiyat);
$KarHesapla = $karlikik / (1 + (60 / 100));


?>

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
  <h4 class="mb-sm-0"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></h4>

  <div class="page-title-right">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="javascript: void(0);">Ödeme Geçmişiniz</a></li>
      <li class="breadcrumb-item active"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-xl-3 col-md-6">
    <!-- card -->
    <div class="card card-animate">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-grow-1">
            <p class="text-uppercase fw-medium text-muted mb-0">Toplam Ödeme</p>
          </div>
          <div class="flex-shrink-0">
            <h5 class="text-success fs-14 mb-0">
              <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
            </h5>
          </div>
        </div>
        <div class="d-flex align-items-end justify-content-between mt-4">
          <div>
            <h4 class="fs-22 fw-semibold ff-secondary mb-4">₺<span class="counter-value" data-target="<?php echo floor($toplamfiyatx); ?>"></span></h4>
          </div>
          <div class="avatar-sm flex-shrink-0">
            <span class="avatar-title bg-light rounded fs-3">
              <i data-feather="file-text" class="text-success icon-dual-success"></i>
            </span>
          </div>
        </div>
      </div><!-- end card body -->
    </div><!-- end card -->
  </div><!-- end col -->

  <div class="col-xl-3 col-md-6">
    <!-- card -->
    <div class="card card-animate">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-grow-1">
            <p class="text-uppercase fw-medium text-muted mb-0">Vergiler Hariç</p>
          </div>
          <div class="flex-shrink-0">
            <h5 class="text-danger fs-14 mb-0">
              <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
            </h5>
          </div>
        </div>
        <div class="d-flex align-items-end justify-content-between mt-4">
          <div>
            <h4 class="fs-22 fw-semibold ff-secondary mb-4">₺<span class="counter-value" data-target="<?php echo floor($kdvHariçFiyat); ?>"></span></h4>
          </div>
          <div class="avatar-sm flex-shrink-0">
            <span class="avatar-title bg-light rounded fs-3">
              <i data-feather="check-square" class="text-success icon-dual-success"></i>
            </span>
          </div>
        </div>
      </div><!-- end card body -->
    </div><!-- end card -->
  </div><!-- end col -->


    <div class="col-xl-3 col-md-6">
      <!-- card -->
      <div class="card card-animate">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-grow-1">
              <p class="text-uppercase fw-medium text-muted mb-0">Toplam Vergi</p>
            </div>
            <div class="flex-shrink-0">
              <h5 class="text-success fs-14 mb-0">
                <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
              </h5>
            </div>
          </div>
          <div class="d-flex align-items-end justify-content-between mt-4">
            <div>
              <h4 class="fs-22 fw-semibold ff-secondary mb-4">₺<span class="counter-value" data-target="<?php echo floor($Vergi); ?>"></span></h4>


            </div>
            <div class="avatar-sm flex-shrink-0">
              <span class="avatar-title bg-light rounded fs-3">
                <i data-feather="x-octagon" class="text-success icon-dual-success"></i>
              </span>
            </div>
          </div>
        </div><!-- end card body -->
      </div><!-- end card -->
    </div><!-- end col -->
  <div class="col-xl-3 col-md-6">
    <!-- card -->
    <div class="card card-animate">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-grow-1">
            <p class="text-uppercase fw-medium text-muted mb-0">Ortalama Karlılık</p>
          </div>
          <div class="flex-shrink-0">
            <h5 class="text-danger fs-14 mb-0">
              <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
            </h5>
          </div>
        </div>
        <div class="d-flex align-items-end justify-content-between mt-4">
          <div>
            <h4 class="fs-22 fw-semibold ff-secondary mb-4">₺<span class="counter-value" data-target="<?php echo floor($kdvHariçFiyat)-floor($KarHesapla); ?>"></span></h4>

          </div>
          <div class="avatar-sm flex-shrink-0">
            <span class="avatar-title bg-light rounded fs-3">
              <i data-feather="clock" class="text-success icon-dual-success"></i>
            </span>
          </div>
        </div>
      </div><!-- end card body -->
    </div><!-- end card -->
  </div><!-- end col -->

</div> <!-- end row-->


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-lg-3 mt-1">
            <label for="exampleInputdate" class="form-label">Firma Ara</label>
            <input type="text" class="form-control" id="Company">
          </div>
          <div class="col-12 col-lg-3 mt-1">
            <label for="exampleInputdate" class="form-label">Ödeme No</label>
            <input type="text" class="form-control" id="OrderNo">
          </div>
          <div class="col-12 col-lg-3 mt-1">
            <label for="exampleInputdate" class="form-label">Başlangıç Tarihi</label>
            <input type="date" class="form-control" id="StartDate">
          </div>
          <div class="col-12 col-lg-3 mt-1">
            <label for="exampleInputdate" class="form-label">Bitiş Tarihi</label>
            <input type="date" class="form-control" id="EndDate">
          </div>
      </div>
      </div>
    </div>
  </div><!--end col-->

</div><!--end row-->


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></h5>
      </div>
      <div class="card-body">
        <table id="OrderList" class="display table table-bordered dt-responsive" style="width:100%">
          <thead>
            <tr class="bg-light">
              <th>Ödeme Türü</th>
              <th>Firma</th>
              <th>Ödeme ID</th>
              <th>Ödeme Tarihi</th>
              <th>Fatura Tutarı</th>
              <th>Ödeme Durumu</th>
              <th>Fatura Durumu</th>
            </tr>
          </thead>

        </table>

      </div>
    </div>
  </div><!--end col-->
</div><!--end row-->
