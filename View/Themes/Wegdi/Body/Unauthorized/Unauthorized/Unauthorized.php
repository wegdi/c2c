<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

?>
<div class="row justify-content-center">
  <div class="col-xl-4 text-center">
      <div class="error-500 position-relative">
          <img src="<?php echo $Themes->ThemeUrl(); ?>/assets/images/error500.png" alt="" class="img-fluid error-500-img error-img">
          <h1 class="title text-muted">403</h1>
      </div>
      <div>

          <h4><?php echo $Themes->Translate("TEXT_UNAUTHORIZED_ALERT"); ?></h4>
          <p class="text-muted w-75 mx-auto"><?php echo $Themes->Translate("TEXT_UNAUTHORIZED_TEXT"); ?></p>
          <a href="/" class="btn btn-success"><i class="mdi mdi-home me-1"></i><?php echo $Themes->Translate("TEXT_UNAUTHORIZED_BUTTON"); ?></a>

      </div>
  </div><!-- end col-->
</div>
