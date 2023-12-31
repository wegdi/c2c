<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
$Edit = $db->Query('Notifications',["_id" => $db->ObjectId($param2)], [], 'TEK');

?>

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
  <h4 class="mb-sm-0"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></h4>

  <div class="page-title-right">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo $Themes->Translate("NOTIFICATIONS"); ?></a></li>
      <li class="breadcrumb-item active"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></li>
    </ol>
  </div>

</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo $Themes->Translate("NOTIFICATIONS"); ?></h4>

      </div><!-- end card header -->
      <div class="card-body">
        <!-- Basic Input -->
        <form id="feg">
          <div class="mt-4">
            <div class="input-group">
                <span class="input-group-text"><?php echo $Themes->Translate("NOTIFICATIONS_TEXT"); ?> </span>
                <textarea class="form-control" aria-label="With textarea" rows="10" name="Message"><?php echo $Edit["Message"]; ?></textarea>
            </div>
          </div>
          <div class="mt-4">
            <p><?php echo $Themes->Translate("NOTIFICATIONS_TEXT_GOURP"); ?></p>
            <select required multiple="multiple" name="Groups[]" id="multiselect-header">
              <?php $Groups = $db->Query('Groups', [], [], 'COK'); ?>
              <?php foreach ($Groups as $key => $GroupsGet): ?>

                <?php if (is_array($Edit["Groups"])): ?>
                  <option  <?php if (in_array($GroupsGet['_id'], $Edit["Groups"])) { echo 'selected';}else {} ?> value="<?php echo $GroupsGet['_id']->__toString(); ?>"><?php echo $GroupsGet["Name"]; ?></option>
                  <?php else: ?>
                    <option  value="<?php echo $GroupsGet['_id'];?>"><?php echo $GroupsGet["Name"]; ?></option>

                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <input type="hidden" name="oid" value="<?php echo $security->Encrypt($Edit["_id"]->__toString(),"4") ; ?>">


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
