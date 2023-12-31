<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);

require_once(SYSTEM.'General/General.php');
$db = new General();
$Notifications = $db->Query('Notifications',[],['sort' => ['Date' => -1]], 'COK');
date_default_timezone_set($db->GetSystem("TimeZone"));

?>


<?php foreach ($Notifications as $key => $value): ?>
  <?php
  $UserID = $value["UserID"];
  $Users = $db->Query('Users', ['_id' => $db->ObjectId($UserID)], [], 'TEK');

  // Timestap değerini "Y-m-d H:i:s" biçimine dönüştür
  $formattedDate = date($db->GetSystem("DateFormat"), $value["Date"]);
  ?>
  <?php if (in_array($db->GetUser('Groups'),$value["Groups"])): ?>

  <div data-simplebar style="max-height: 300px;" class="pe-2">
    <div class="text-reset notification-item d-block dropdown-item position-relative">
      <div class="d-flex">
        <div class="avatar-xs me-3 flex-shrink-0">
          <img src="<?php echo $Users["ProfilImage"]; ?>" class="rounded-circle header-profile-user" alt="">
        </div>
        <div class="flex-grow-1">
          <a href="#!" class="stretched-link">
            <h6 class="mt-0 mb-2 lh-base"><?php echo $value["Message"]; ?></h6>
          </a>
          <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
            <span><i class="mdi mdi-clock-outline"></i> <?php echo $formattedDate; ?> </span>
          </p>
        </div>
        <div class="px-2 fs-15">
          <div class="form-check notification-check">
            <input class="form-check-input" type="checkbox" name="UserIDs[]" value="<?php echo $value["_id"]; ?>" id="all-notification-check01">
            <label class="form-check-label" for="all-notification-check01"></label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

<?php endforeach; ?>
