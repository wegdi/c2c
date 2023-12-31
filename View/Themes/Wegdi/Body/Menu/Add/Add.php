<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
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
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo $Themes->Translate("TEXT_MENU_CARD"); ?></h4>

      </div><!-- end card header -->
      <div class="card-body">
        <!-- Basic Input -->
        <form id="feg">
          <div>
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("TEXT_MENU_NAME_TR"); ?> </label>
            <input type="text" class="form-control" id="basiInput" name="tr" required>
          </div>

          <div  class="mt-3">
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("TEXT_MENU_NAME_EN"); ?> </label>
            <input type="text" class="form-control" id="basiInput" name="en" required>
          </div>

          <div  class="mt-3">
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("TEXT_MENU_ORDER"); ?> </label>
            <input type="number" class="form-control" id="basiInput" name="order" required>
          </div>

          <div  class="mt-3">
            <label for="basiInput" class="form-label"><?php echo $Themes->Translate("TEXT_MENU_ICON"); ?> </label>
            <input type="text" class="form-control" id="basiInput" name="icon" >
          </div>


          <!-- Select -->
          <div class="input-group mt-3">
            <label class="input-group-text" for="inputGroupSelect01"><?php echo $Themes->Translate("TEXT_MENU_TOP"); ?></label>
            <select class="form-select" id="inputGroupSelect01" name="parent_id" required>
              <option selected value="0"></option>
              <?php $Menus = $db->Query('Menus',['Parent_ID' => '0'],[], 'COK'); ?>
              <?php foreach ($Menus as $key => $MenusGet): ?>
                <option value="<?php  echo $MenusGet['_id']->__toString(); ?>"><?php echo $MenusGet[LANGUAGES_GET_DIL]; ?></option>
              <?php endforeach; ?>
            </select>
          </div>


          <!-- Select -->
          <div class="mt-4">
            <p><?php echo $Themes->Translate("TEXT_MENU_AUTHORITY"); ?></p>
            <select required multiple="multiple" name="authority[]" id="multiselect-header">
              <?php $Authority = $db->Query('Authority', [], [], 'COK'); ?>
              <?php foreach ($Authority as $key => $AuthorityGet): ?>
                <option value="<?php echo $AuthorityGet['_id']->__toString(); ?>"><?php echo $AuthorityGet["Name"]; ?></option>
              <?php endforeach; ?>
            </select>
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

  <div class="col-lg-4">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo $Themes->Translate("TEXT_MENU_LIST"); ?></h4>

      </div><!-- end card header -->
      <div class="card-body">


        <ul class="list-group">
          <?php $Menusc = $db->Query('Menus',[],[], 'COK'); ?>
          <?php foreach ($Menusc as $key => $MensGetSide): ?>
            <?php if ($MensGetSide["Parent_ID"]=="0"): ?>
              <?php $active="active"; $icon='<i class="'.$MensGetSide["Icon"].'"></i>';?>
            <?php else: ?>
              <?php $active=""; $icon='<i class="ri-arrow-drop-right-line"></i>';?>


            <?php endif; ?>
            <li class="list-group-item <?php echo $active; ?>" aria-current="true"><?php echo $icon; ?> <?php  echo $MensGetSide[LANGUAGES_GET_DIL]; ?> (<?php  echo $MensGetSide["Order"]; ?>)</li>


          <?php endforeach; ?>

        </ul>


      </div>
    </div>
  </div>
</div>
<!--end col-->
