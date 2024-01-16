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
  <div class="col-lg-12">
      <div class="card">
          <div class="card-header">
              <h5 class="card-title mb-0"><?php echo  $db->BarGet($param0.'/'.$param1,LANGUAGES_GET_DIL); ?></h5>
          </div>
          <div class="card-body">
              <table id="MetaTable" class="display table table-bordered dt-responsive" style="width:100%">
                  <thead>
                      <tr>
                          <th>Kategori Adı</th>
                          <th></th>
                      </tr>
                  </thead>

              </table>
          </div>
      </div>
  </div><!--end col-->
</div><!--end row-->