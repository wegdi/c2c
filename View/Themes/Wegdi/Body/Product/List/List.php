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
                          <th style="width:10px;">Ürün Resmi</th>
                          <th style="width:30%;">Ürün Adı</th>
                          <th style="width:10%;">Model Kodu</th>
                          <th style="width:10%;">C2C  Kodu</th>
                          <th style="width:10%;">Adet</th>
                          <th>İdeaSoft</th>
                          <th>Kategori</th>
                          <th>Tedarikçi</th>

                      </tr>
                  </thead>

              </table>
          </div>
      </div>
  </div><!--end col-->
</div><!--end row-->



    <!-- removeFileItemModal -->
    <div id="removeTaskItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-removetodomodal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4><?php echo $Themes->Translate("TEXT_MODAL_REMOVE_TITLE"); ?></h4>
                            <p class="text-muted mx-4 mb-0"><?php echo $Themes->Translate("TEXT_MODAL_REMOVE_META"); ?></p>
                            <form id="silform">
                              <input type="hidden" id="remove-id-input" class="form-control" readonly name="oid">
                            <form >

                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal"><?php echo $Themes->Translate("BUTTON_NO"); ?></button>
                        <button type="button" class="btn w-sm btn-danger" onclick="Delete('#silform')" form="silform"  id="sil"><?php echo $Themes->Translate("BUTTON_YES"); ?></button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--end delete modal -->
