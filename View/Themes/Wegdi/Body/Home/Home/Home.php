<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

?>
<div class="row">
  <div class="col">

    <div class="h-100">
      <div class="row mb-3 pb-1">
        <div class="col-12">
          <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
              <h4 class="fs-16 mb-1">Merhaba  <?php echo $db->GetUser("NameSurname"); ?></h4>
              <p class="text-muted mb-0">Keyifli satışlar dileriz.</p>
            </div>
            <div class="mt-3 mt-lg-0">
              <form action="javascript:void(0);">
                <div class="row g-3 mb-0 align-items-center">
                  <div class="col-sm-auto">
                    <div class="input-group">
                      <input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-input" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
                      <div class="input-group-text bg-primary border-primary text-white">
                        <i class="ri-calendar-2-line"></i>
                      </div>
                    </div>
                  </div>
                  <!--end col-->
                  <div class="col-auto">
                    <button type="button" class="btn btn-soft-success"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button>
                  </div>
                  <!--end col-->
                  <div class="col-auto">
                    <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
                  </div>
                  <!--end col-->
                </div>
                <!--end row-->
              </form>
            </div>
          </div><!-- end card header -->
        </div>
        <!--end col-->
      </div>
      <!--end row-->

      <div class="row">
        <div class="col-xl-3 col-md-6">
          <!-- card -->
          <div class="card card-animate">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 overflow-hidden">
                  <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tedarikçi Toplam Ürün Sayısı</p>
                </div>
                <div class="flex-shrink-0">
                  <h5 class="text-success fs-14 mb-0">
                  </h5>
                </div>
              </div>
              <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                  <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $db->Quantity('Products'); ?>"><?php echo $db->Quantity('Products'); ?></span> adet</h4>
                  <a href="/Products/List" class="text-decoration-underline">Ürünleri görüntüle</a>
                </div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-success-subtle rounded fs-3">
                    <i class="bx bx-dollar-circle text-success"></i>
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
                <div class="flex-grow-1 overflow-hidden">
                  <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Toplam Tedarikçi</p>
                </div>
                <div class="flex-shrink-0">
                  <h5 class="text-danger fs-14 mb-0">
                  </h5>
                </div>
              </div>
              <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                  <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $db->Quantity('Supplier'); ?>"><?php echo $db->Quantity('Supplier'); ?></span></h4>
                  <a href="/Supplier/List" class="text-decoration-underline">Tedarikçileri Görüntüle</a>
                </div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-info-subtle rounded fs-3">
                    <i class="bx bx-shopping-bag text-info"></i>
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
                <div class="flex-grow-1 overflow-hidden">
                  <p class="text-uppercase fw-medium text-muted text-truncate mb-0">İdeaSoft Gönderilen Ürün Sayısı</p>
                </div>
                <div class="flex-shrink-0">
                  <h5 class="text-success fs-14 mb-0">
                  </h5>
                </div>
              </div>
              <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                  <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $db->Quantity('Products',["IdeaSoft" => 1]); ?>"><?php echo $db->Quantity('Products',["IdeaSoft" => 1]); ?></span> </h4>
                  <a href="/Product/List" class="text-decoration-underline">Ürünleri Görüntüle</a>
                </div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-warning-subtle rounded fs-3">
                    <i class="bx bx-user-circle text-warning"></i>
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
                <div class="flex-grow-1 overflow-hidden">
                  <p class="text-uppercase fw-medium text-muted text-truncate mb-0">İdeaSoft Gönderilmeyi Bekleyen Ürünler</p>
                </div>
                <div class="flex-shrink-0">
                  <h5 class="text-muted fs-14 mb-0">

                  </h5>
                </div>
              </div>
              <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                  <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $db->Quantity('Products',["IdeaSoft" => 0]); ?>"><?php echo $db->Quantity('Products',["IdeaSoft" => 0]); ?></span> </h4>
                  <a href="/Product/List" class="text-decoration-underline">Ürünleri Görüntüle</a>
                </div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-primary-subtle rounded fs-3">
                    <i class="bx bx-wallet text-primary"></i>
                  </span>
                </div>
              </div>
            </div><!-- end card body -->
          </div><!-- end card -->
        </div><!-- end col -->
      </div> <!-- end row-->


    </div> <!-- end .rightbar-->

  </div> <!-- end col -->
</div>
