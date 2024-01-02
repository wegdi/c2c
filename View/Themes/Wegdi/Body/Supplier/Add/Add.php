<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
?>




<div class="row justify-content-center">
  <div class="col-xl-4">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0 text-center">Xml Tedarikçi Ekle</h4>
      </div><!-- end card header -->

      <div class="card-body">
        <div class="row">
          <div class="col-xxl-12 col-md-12 text-center mb-3">
            <label for="exampleInputrounded" class="form-label">Tedarikçi Adı</label>
            <input type="text" class="form-control rounded-pill" id="exampleInputrounded" placeholder="Tedarikçi Adı Giriniz">
          </div>
          <div class="col-xxl-12 col-md-12 text-center mb-3">
            <label for="exampleInputrounded" class="form-label">Tedarikçi Linki</label>
            <input type="text" class="form-control rounded-pill" id="exampleInputrounded" placeholder="Tedarikçi Linki Giriniz">
          </div>

          <div class="col-xxl-12 col-md-12 text-center mb-3">
            <button type="button" class="btn rounded-pill btn-primary waves-effect waves-light" id="xmlstart">Kaydet</button>
          </div>



          <!-- Rounded Buttons -->
        </div>

      </div><!-- end card-body -->
    </div><!-- end card -->
  </div>

  <div class="col-xl-4">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0 text-center">Api İle Tedarikçi Ekle</h4>

      </div><!-- end card header -->

      <div class="card-body">

        <div class="row">
          <div class="col-xxl-12 col-md-12 text-center mb-3">
            <label for="exampleInputrounded" class="form-label">Tedarikçi Adı</label>
            <input type="text" class="form-control rounded-pill" id="exampleInputrounded" placeholder="Tedarikçi Adı Giriniz">
          </div>

          <div class="col-xxl-12 col-md-12 text-center mb-3">
            <button type="button" class="btn rounded-pill btn-primary waves-effect waves-light" id="xmlstart">Kaydet</button>
          </div>

        </div>
      </div><!-- end card-body -->
    </div><!-- end card -->
  </div>

</div>
