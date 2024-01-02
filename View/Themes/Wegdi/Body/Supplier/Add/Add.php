<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
?>




<div class="row justify-content-center">
  <div class="col-xl-3">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Xml Tedarikçi Ekle</h4>
      </div><!-- end card header -->

      <div class="card-body">
        <p class="text-muted">Use <code>data-simplebar</code> attribute and add <code>max-height: **px</code> to set default scrollbar.</p>


      </div><!-- end card-body -->
    </div><!-- end card -->
  </div>

  <div class="col-xl-3">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Api İle Tedarikçi Ekle</h4>

      </div><!-- end card header -->

      <div class="card-body">
        <p class="text-muted">Use <code>data-simplebar</code> attribute and add <code>max-height: **px</code> to set default scrollbar.</p>


      </div><!-- end card-body -->
    </div><!-- end card -->
  </div>

</div>
