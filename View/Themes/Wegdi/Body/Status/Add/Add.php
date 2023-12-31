<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
?>

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
  <h4 class="mb-sm-0"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></h4>

  <div class="page-title-right">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo $Themes->Translate("TEXT_USER_BAR"); ?></a></li>
      <li class="breadcrumb-item active"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></li>
    </ol>
  </div>

</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></h4>

      </div><!-- end card header -->
      <div class="card-body">
        <!-- Basic Input -->
        <form id="feg">
          <div>
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("STATUS_NAME"); ?> </label>
            <input type="text" class="form-control" id="basiInput" name="StatusName" required autocomplete="off">
          </div>


          <div  class="mt-3">
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("LEADS_ICON"); ?> </label>
            <input type="text" class="form-control" id="basiInput" name="Icon" required autocomplete="off">
          </div>
          <div  class="mt-3">
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("LEADS_COLOR"); ?> </label>
            <input type="color" class="form-control" id="basiInput" name="Color" required autocomplete="off">
          </div>



        </form>
        <div class="mt-3 float-end">
          <!-- Rounded with Label -->
          <button type="button" id="kaydet" onclick="FromSave('#feg')" form="feg" class="btn btn-primary btn-label waves-effect waves-light" onclick="ajaxFunction('/Modal/<?php echo $param0.'/'.$param1.'/'.$param1; ?>.php')">
            <i class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i>
            <?php echo $Themes->Translate("BUTTON_REGISTER"); ?>
          </button>
        </div>

      </div>
    </div>
  </div>


</div>
<!--end col-->
