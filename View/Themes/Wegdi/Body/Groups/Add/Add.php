<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
?>

<style media="screen">
.well-sm {
  padding: 9px;
  border-radius: 2px;
}
.well {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
  border-radius: 3px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
}
</style>
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
  <h4 class="mb-sm-0"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></h4>

  <div class="page-title-right">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo $Themes->Translate("TEXT_GROUPS_BAR"); ?></a></li>
      <li class="breadcrumb-item active"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></li>
    </ol>
  </div>

</div>



<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></h5>
      </div>
      <div class="card-body">
        <form id="feg">

        <div  class="mt-3">
          <label for="basiInput" class="form-label"><?php echo $Themes->Translate("TEXT_GROUPS_NAME"); ?> </label>
          <input type="text" class="form-control" id="basiInput" name="Name" required>
        </div>
        <div class="form-group mt-3">
          <label class="col-sm-2 control-label"><?php echo $Themes->Translate("TEXT_GROUPS_ACCESS"); ?></label>
          <div class="col-sm-12">
            <div class="well well-sm" style="height: 150px; overflow: auto;">
              <div class="checkbox">
                <!-- Custom Checkboxes Color -->
                <?php
                $Number=0;
              foreach ($ThemesConf as $ModalGet => $ModalIcGet) {
                  if (is_array($ModalIcGet)) {
                      // $ModalIcGet bir array ise, içindeki her bir değer için ayrı bir döngü yapalım.
                      foreach ($ModalIcGet as $value) {
                          ?>
                          <div class="form-check mb-3">
                              <input class="form-check-input" type="checkbox" id="formCheck<?php echo  $Number++; ?>" name="Access[]" value="<?php echo $ModalGet.'/'.$value; ?>">
                              <label class="form-check-label" for="formCheck<?php echo  $Number++; ?>">
                                  <?php echo $ModalGet; ?>/<?php echo $value; ?>
                              </label>
                          </div>
                          <?php
                      }
                  } else {
                      // $ModalIcGet bir array değilse, normal şekilde döngüyü devam ettirelim.
                      ?>
                      <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" id="formCheck<?php echo  $Number++; ?>" name="Access[]"  value="<?php echo $ModalGet.'/'.$value; ?>">
                          <label class="form-check-label" for="formCheck<?php echo  $Number++; ?>">
                              <?php echo $ModalGet; ?> <?php echo $ModalIcGet; ?>
                          </label>
                      </div>
                      <?php
                  }
              }
              ?>



              </div>
            </div>
          </div>
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
  </div><!--end col-->
</div><!--end row-->
