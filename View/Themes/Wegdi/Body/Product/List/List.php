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
        <table id="UrunList" class="display table table-bordered dt-responsive" style="width:100%">
          <thead>
            <tr style="background: #f3f3f9;">
              <th colspan="12" class="text-center">Filtreleme</th>
            </tr>
            <tr style="background: #f3f3f9;">
              <th></th>
              <th></th>
              <th><input type="text" class="form-control" id="ProductName" name="ProductName"></th>
              <th style="width:10%;">
                <select class="form-select" id="inputGroupSelect01" name="Brand" required>
                  <?php  $Brand = $db->Query('Brand',[], [], 'COK'); ?>
                  <?php foreach ($Brand as $key => $value): ?>
                    <option  value="<?php echo $value["Name"]; ?>"><?php echo $value["Name"]; ?></option>

                  <?php endforeach; ?>
                </select>
              </th>
              <th><input type="text" class="form-control" id="Model" name="Model"></th>
              <th><input type="text" class="form-control" id="C2cCode" name="C2cCode"></th>
              <th></th>
              <th></th>
              <th style="width:10%;">
                <select class="form-select" id="inputGroupSelect01" name="IdeaSoftSatatus" required>
                  <option selected value="1">Mevcut</option>
                  <option  value="0">Mevcut Değil</option>

                </select>
              </th>
              <th></th>
              <th style="width:10%;"> <select class="js-example-basic-single"></select></th>
              <th></th>

            </tr>
            <tr>
              <th><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>
              <th style="width:10px;">Ürün Resmi</th>
              <th style="width:30%;">Ürün Adı</th>
              <th>Marka</th>
              <th style="width:10%;">Model Kodu</th>
              <th style="width:10%;">C2C  Kodu</th>
              <th style="width:10%;">Adet</th>
              <th style="width:10%;">Fiyat</th>
              <th style="width:10%;">İdeaSoft</th>
              <th style="width:10%;">Gönderilecek Fiyat</th>
              <th style="width:10%;">Kategori</th>
              <th>Tedarikçi</th>

            </tr>

          </thead>

        </table>
      </div>
    </div>
  </div><!--end col-->
</div><!--end row-->
