<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
?>



<div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1">
  <div class="col">
    <div class="card card-body">
      <div class="d-flex mb-4 align-items-center">
        <div class="flex-shrink-0">
          <img src="https://cdn-apgdb.nitrocdn.com/ZrRXIeVbbsFpLAHAdAsjAVgtOuQsjoPh/assets/images/optimized/rev-35bbf9a/vitalpbx.com/wp-content/uploads/2022/04/vitalpbx-logo-white-variant.png" alt="" class="avatar-sm rounded-circle">
        </div>
        <div class="flex-grow-1 ms-2">
          <h5 class="card-title mb-1">VitalPbx</h5>
          <p class="text-muted mb-0">Virtual Switchboard</p>
        </div>
      </div>
      <a href="/VitalPbx/Edit" class="btn btn-primary btn-sm">Go to Module</a>
    </div>
  </div>

  <div class="col">
    <div class="card card-body">
      <div class="d-flex mb-4 align-items-center">
        <div class="flex-shrink-0">
          <img class="avatar-sm rounded-circle" src="">

        </div>
        <div class="flex-grow-1 ms-2">
          <h5 class="card-title mb-1">Geo IP</h5>
          <p class="text-muted mb-0">Country blocking</p>
        </div>
      </div>
      <a href="/GeoIP/Edit" class="btn btn-primary btn-sm">Go to Module</a>
    </div>
  </div>

</div>
