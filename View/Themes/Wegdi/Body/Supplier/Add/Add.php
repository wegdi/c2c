<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
?>




<div class="row">
  <div class="col-xl-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Default Scroll</h4>
      </div><!-- end card header -->

      <div class="card-body">
        <p class="text-muted">Use <code>data-simplebar</code> attribute and add <code>max-height: **px</code> to set default scrollbar.</p>


      </div><!-- end card-body -->
    </div><!-- end card -->
  </div>
</div>
