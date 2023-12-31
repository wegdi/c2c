<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
$Edit = $db->Query('Settings',["Condition" => 'System'], [], 'TEK');
$timezone_identifiers = DateTimeZone::listIdentifiers();
$timezone_array = array();
foreach ($timezone_identifiers as $timezone) {
  $timezone_array[] = $timezone;
}
?>

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
  <h4 class="mb-sm-0"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></h4>

  <div class="page-title-right">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo $Themes->Translate("TEXT_MENU_BAR"); ?></a></li>
      <li class="breadcrumb-item active"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></li>
    </ol>
  </div>

</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">

      <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#genel" role="tab" aria-selected="false">
              <?php echo $Themes->Translate("TEXT_SETTING_GENERAL"); ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-bs-toggle="tab" href="#yerlestirme" role="tab" aria-selected="false">
              <?php echo $Themes->Translate("TEXT_SETTING_PLACEMENT"); ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#eposta" role="tab" aria-selected="false">
              <?php echo $Themes->Translate("EMAIL_SMTP"); ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#logoform" role="tab" aria-selected="true">
              <?php echo $Themes->Translate("LOGO"); ?>
            </a>
          </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content  text-muted">
          <div class="tab-pane active" id="genel" role="tabpanel">
            <!-- Burası Genel Ayarlar -->
            <form id="genelform">
              <input type="hidden" name="oid" value="<?php echo $security->Encrypt($Edit["_id"]->__toString(),"4") ; ?>">
              <input type="hidden" name="formtype" value="genel">

            <div class="row">
              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_COMPANY"); ?></label>
                  <input type="text" class="form-control" id="basiInput" name="CompanyName" required value="<?php echo $Edit["CompanyName"]; ?>">
                </div>
                <hr>
              </div>


              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_ADRESS"); ?></label>
                  <input type="text" class="form-control" id="basiInput" name="Adress" required value="<?php echo $Edit["Adress"]; ?>">
                </div>
                <hr>
              </div>



              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_CITY"); ?></label>
                  <input type="text" class="form-control" id="basiInput" name="City" required value="<?php echo $Edit["City"]; ?>">
                </div>
                <hr>
              </div>

              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_LOK"); ?></label>
                  <input type="text" class="form-control" id="basiInput" name="District" required value="<?php echo $Edit["District"]; ?>">
                </div>
                <hr>
              </div>

              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_CONTNRY"); ?></label>
                  <input type="text" class="form-control" id="basiInput" name="Country" required value="<?php echo $Edit["Country"]; ?>">
                </div>
                <hr>
              </div>

              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_POSTCODE"); ?></label>
                  <input type="number" class="form-control" id="basiInput"  name="PostCode" required value="<?php echo $Edit["PostCode"]; ?>">
                </div>
                <hr>
              </div>

              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_PHONE"); ?></label>
                  <input type="text" class="form-control" id="basiInput"  name="Phone" required value="<?php echo $Edit["Phone"]; ?>">
                </div>
                <hr>
              </div>

              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_TAX"); ?></label>
                  <input type="text" class="form-control" id="basiInput" name="TaxNumber" required value="<?php echo $Edit["TaxNumber"]; ?>">
                </div>
                <hr>
              </div>
            </div>
            </form>
            <div class="mt-3 float-end">
              <!-- Rounded with Label -->
              <button type="button" id="kaydet" onclick="FromSave('#genelform')" form="genelform" class="btn btn-primary btn-label waves-effect waves-light" onclick="ajaxFunction('/Modal/<?php echo $param0.'/'.$param1.'/'.$param1; ?>.php')">
                <i class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i>
                <?php echo $Themes->Translate("BUTTON_REGISTER"); ?>
              </button>
            </div>

          </div>
          <div class="tab-pane " id="yerlestirme" role="tabpanel">
            <form id="yer">
              <input type="hidden" name="oid" value="<?php echo $security->Encrypt($Edit["_id"]->__toString(),"4") ; ?>">
              <input type="hidden" name="formtype" value="sistem">

            <div class="row">
              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_DATE"); ?></label>
                  <select class="form-select mb-3" name="DateFormat">
                    <option <?php if ($Edit["DateFormat"]=="d-m-Y H:i:s") { echo "selected" ;} ?>  value="d-m-Y H:i:s">Gün-Ay-Yıl (dd-mm-yyyy)</option>
                    <option <?php if ($Edit["DateFormat"]=="d/m/Y H:i:s") { echo "selected" ;} ?>  value="d/m/Y H:i:s">Gün/Ay/Yıl (dd/mm/yyyy)</option>
                    <option <?php if ($Edit["DateFormat"]=="m-d-Y H:i:s") { echo "selected" ;} ?>  value="m-d-Y H:i:s">Ay-Gün-Yıl (mm-dd-yyyy)</option>
                    <option <?php if ($Edit["DateFormat"]=="m.d.Y H:i:s") { echo "selected" ;} ?> value="m.d.Y H:i:s">Ay.Gün.Yıl (mm.dd.yyyy)</option>
                    <option <?php if ($Edit["DateFormat"]=="m/d/Y H:i:s") { echo "selected" ;} ?>  value="m/d/Y H:i:s">Ay/Gün/Yıl (mm/dd/yyyy)</option>
                    <option <?php if ($Edit["DateFormat"]=="Y-m-d H:i:s") { echo "selected" ;} ?> value="Y-m-d H:i:s">Yıl-Ay-Gün (yyyy-mm-dd)</option>
                    <option <?php if ($Edit["DateFormat"]=="d.m.Y H:i:s") { echo "selected" ;} ?>  value="d.m.Y H:i:s">Gün.Ay.Yıl (dd.mm.yyyy)</option>

                  </select>
                </div>
              </div>

              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("TEXT_SETTING_DATETIME"); ?></label>
                  <select class="form-select mb-3" aria-label="Default select example" name="TimeFormat">
                    <option  <?php if ($Edit["TimeFormat"]=="12") { echo "selected" ;} ?> value="12">12 <?php echo $Themes->Translate("TEXT_SETTING_CLOCK"); ?></option>
                    <option   <?php if ($Edit["TimeFormat"]=="24") { echo "selected" ;} ?> value="24">24 <?php echo $Themes->Translate("TEXT_SETTING_CLOCK"); ?></option>
                  </select>
                </div>
              </div>


              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("DEFAULTTIMEZONE"); ?></label>

                  <select class="form-select mb-3" name="TimeZone">
                    <?php foreach ($timezone_array as $key => $value): ?>
                      <option  <?php if ($Edit["TimeZone"]==$value) { echo "selected";} ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-6">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("DEFAULTLANGUAGE"); ?></label>

                  <select class="form-select mb-3"  name="Language" required value="<?php echo $Edit["Language"]; ?>">
                    <option <?php if ($Edit["Language"]=="tr") { echo "selected" ;} ?>  value="tr">Turkish</option>
                    <option   <?php if ($Edit["Language"]=="en") { echo "selected" ;} ?> value="en">English</option>

                  </select>
                </div>
              </div>

            </div>
            </form>
            <div class="mt-3 float-end">
              <!-- Rounded with Label -->
              <button type="button" id="kaydet" onclick="FromSave('#yer')" form="yer" class="btn btn-primary btn-label waves-effect waves-light" onclick="ajaxFunction('/Modal/<?php echo $param0.'/'.$param1.'/'.$param1; ?>.php')">
                <i class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i>
                <?php echo $Themes->Translate("BUTTON_REGISTER"); ?>
              </button>
            </div>
          </div>
          <div class="tab-pane" id="eposta" role="tabpanel">
            <form id="apimail">
              <input type="hidden" name="oid" value="<?php echo $security->Encrypt($Edit["_id"]->__toString(),"4") ; ?>">
              <input type="hidden" name="formtype" value="api">
            <div class="row">
              <div class="col-12">
                <div class="mt-3">
                  <label for="basiInput" class="form-label"> <?php echo $Themes->Translate("EMAIL_API"); ?></label>
                  <input type="text" class="form-control" id="basiInput"  name="EmailApi"  value="<?php echo $Edit["EmailApi"]; ?>">
                </div>
                <hr>
              </div>

            </div>
            </form>
            <div class="mt-3 float-end">
              <!-- Rounded with Label -->
              <button type="button" id="kaydet" onclick="FromSave('#apimail')" form="apimail" class="btn btn-primary btn-label waves-effect waves-light" onclick="ajaxFunction('/Modal/<?php echo $param0.'/'.$param1.'/'.$param1; ?>.php')">
                <i class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i>
                <?php echo $Themes->Translate("BUTTON_REGISTER"); ?>
              </button>
            </div>
          </div>
          <div class="tab-pane" id="logoform" role="tabpanel">
            <form id="logoci">
              <input type="hidden" name="oid" value="<?php echo $security->Encrypt($Edit["_id"]->__toString(),"4") ; ?>">
              <input type="hidden" name="formtype" value="logois">
            <div class="row">
              <div class="col-12">
              <img src="<?php echo $Edit["Logo"]; ?>" class="img-fluid" alt="Logo">
              </div>
              <div class="col-12">
                <div class="input-group mt-3">
                  <label class="input-group-text" for="inputGroupFile02"><?php echo $Themes->Translate("LOGO"); ?></label>
                  <input type="file" class="form-control" id="inputGroupFile02" name="Logo" required  >
                </div>
              </div>
            </div>
            </form>
            <div class="mt-3 float-end">
              <!-- Rounded with Label -->
              <button type="button" id="kaydet" onclick="FromSave('#logoci')" form="logoci" class="btn btn-primary btn-label waves-effect waves-light" onclick="ajaxFunction('/Modal/<?php echo $param0.'/'.$param1.'/'.$param1; ?>.php')">
                <i class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i>
                <?php echo $Themes->Translate("BUTTON_REGISTER"); ?>
              </button>
            </div>

          </div>

        </div>


      </div>
    </div>
  </div>


</div>
<!--end col-->
