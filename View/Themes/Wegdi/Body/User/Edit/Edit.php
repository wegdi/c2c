<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
$Edit = $db->Query('Users',["_id" => $db->ObjectId($param2)], [], 'TEK');

if ($Edit["ProfilImage"]=="") {
  $col="12";
  $colstyle='style="display:none;"';

}else {
  $col="8";


}
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
  <div class="col-lg-<?php echo $col; ?>">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo $Themes->Translate("TEXT_USER_EDIT"); ?></h4>

      </div><!-- end card header -->
      <div class="card-body">
        <!-- Basic Input -->
        <form id="feg">
          <div>
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("TEXT_USER_NAME"); ?> </label>
            <input type="text" class="form-control" id="basiInput" name="NameSurname" required autocomplete="off" value="<?php echo $Edit["NameSurname"]; ?>">
          </div>

          <div  class="mt-3">
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("TEXT_USER_MAIL"); ?> </label>
            <input type="email" class="form-control" id="basiInput" name="UserMail" required autocomplete="off" value="<?php echo $Edit["UserMail"]; ?>">
          </div>

          <div  class="mt-3">
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("TEXT_USER_PASSWORD"); ?> </label>
            <input type="password" class="form-control" id="basiInput" name="Password"  autocomplete="off">
          </div>

          <div  class="mt-3">
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("TEXT_SETTING_PHONE"); ?> </label>
            <input type="text" class="form-control" id="basiInput" name="Phone"  autocomplete="off" value="<?php echo $Edit["Phone"]; ?>">
          </div>


          <div class="input-group mt-3">
            <label class="input-group-text" for="inputGroupFile02"><?php echo $Themes->Translate("TEXT_USER_IMAGE"); ?></label>
            <input type="file" class="form-control" id="inputGroupFile02" name="ProfilImage" >
          </div>

          <!-- Select -->
          <div class="input-group mt-3">
            <label class="input-group-text" for="inputGroupSelect01"><?php echo $Themes->Translate("TEXT_USER_STATUS"); ?></label>
            <select class="form-select" id="inputGroupSelect01" name="Status" required>

              <option  <?php if ($Edit["Status"]=="1") {echo "selected"; } ?> value="1"><?php echo $Themes->Translate("TEXT_STATUS_ON"); ?></option>

              <option  <?php if ($Edit["Status"]=="0") {echo "selected"; } ?> value="0"><?php echo $Themes->Translate("TEXT_STATUS_OFF"); ?></option>


            </select>
          </div>


          <!-- Select -->
          <div class="mt-4">
            <p><?php echo $Themes->Translate("TEXT_USER_AUTHORITY"); ?></p>
            <select required  class="form-select mb-3" name="Authority" >
              <?php $Authority = $db->Query('Authority', [], [], 'COK'); ?>
              <?php foreach ($Authority as $key => $AuthorityGet): ?>

                <option <?php if ($AuthorityGet['_id']==$Edit["Authority"]) { echo 'selected'; } ?>
                  value="<?php echo $AuthorityGet['_id']; ?>"><?php echo $AuthorityGet["Name"]; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mt-4">
            <p><?php echo $Themes->Translate("COMPANY_NAME"); ?></p>
            <select required  class="form-select mb-3" name="CompanyCode" >
              <?php $Groups = $db->Query('Companies', [], [], 'COK'); ?>
              <?php foreach ($Groups as $key => $GroupsGet): ?>
                <option  <?php if ($GroupsGet['CompanyCode']==$Edit["CompanyCode"]) { echo 'selected'; } ?> value="<?php echo $GroupsGet['CompanyCode']; ?>"><?php echo $GroupsGet["CompanyName"]; ?></option>
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
  <div class="col-xl-4" <?php echo $colstyle; ?>>
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo $Themes->Translate("TEXT_USER_IMAGE"); ?></h4>

      </div><!-- end card header -->

      <div class="card-body">

        <div class="live-preview">

          <div>
            <img src="<?php echo $Edit["ProfilImage"]; ?>" class="img-fluid" alt="Responsive image">
          </div>

        </div>
      </div><!-- end card-body -->
    </div><!-- end card -->
  </div>


</div>
<!--end col-->
