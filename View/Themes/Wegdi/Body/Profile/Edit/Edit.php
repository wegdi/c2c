<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
date_default_timezone_set($db->GetSystem("TimeZone"));

?>


<div class="position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg profile-setting-img">
        <img src="<?php echo $Themes->ThemeUrl(); ?>/assets/images/profile-bg.jpg" class="profile-wid-img" alt="">

    </div>
</div>

<div class="row">
    <div class="col-xxl-3">
        <div class="card mt-n5">
            <div class="card-body p-4">
                <div class="text-center">
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        <img src="<?php  echo $db->GetUser('ProfilImage');  ?>" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">

                    </div>
                    <h5 class="fs-16 mb-1"><?php  echo $db->GetUser('NameSurname');  ?></h5>
                </div>
            </div>
        </div>
        <!--end card-->


    </div>
    <!--end col-->
    <div class="col-xxl-9">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                            <i class="fas fa-home"></i>
                             <?php echo $Themes->Translate("PROFILE_DETAIL"); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                            <i class="far fa-user"></i>
                           <?php echo $Themes->Translate("TEXT_USER_PASSWORD_C"); ?>

                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                        <form action="javascript:void(0);">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="firstnameInput" class="form-label"><?php echo $Themes->Translate("TEXT_USER_NAME"); ?></label>
                                        <input type="text" class="form-control" id="firstnameInput" placeholder="<?php echo $Themes->Translate("TEXT_USER_NAME"); ?>" value="<?php  echo $db->GetUser('NameSurname');  ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label"><?php echo $Themes->Translate("TEXT_SETTING_PHONE"); ?></label>
                                        <input type="text" class="form-control" id="phonenumberInput" placeholder="<?php echo $Themes->Translate("TEXT_SETTING_PHONE"); ?>" value="<?php  echo $db->GetUser('Phone');  ?>" disabled>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label"><?php echo $Themes->Translate("TEXT_USER_MAIL"); ?></label>
                                        <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" value="<?php  echo $db->GetUser('UserMail');  ?>" disabled>
                                    </div>
                                </div>




                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        <form  id="feg">
                            <div class="row g-2">
                                <div class="col-lg-12">
                                    <div>
                                        <label for="oldpasswordInput" class="form-label"><?php echo $Themes->Translate("TEXT_USER_PASSWORD"); ?>*</label>
                                        <input type="password" class="form-control" id="oldpasswordInput"  name="Password" required>
                                    </div>
                                </div>



                                <div class="col-lg-12 text-end">
                                  <button type="button" id="kaydet" onclick="FromSave('#feg')" form="feg" class="btn btn-primary btn-label waves-effect waves-light" onclick="ajaxFunction('/Modal/<?php echo $param0.'/'.$param1.'/'.$param1; ?>.php')">
                                    <i class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i>
                                    <?php echo $Themes->Translate("BUTTON_REGISTER"); ?>
                                  </button>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                        <div class="mt-5 mb-3 border-bottom pb-2">

                            <h5 class="card-title">Login History</h5>
                        </div>
                        <?php $Log = $db->Query('Log', ['UserMail' => $db->GetUser('UserMail'),'Condition' => 'Login'],['sort' => ['Date' => -1]], 'COK',"0","5"); ?>
                        <?php foreach ($Log as $key => $value): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 avatar-sm">
                                <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                    <i class="ri-smartphone-line"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6><?php echo $value["Browser"]; ?> </h6>
                                <p class="text-muted mb-0"><?php echo $value["IpAdress"]; ?>  | <?php echo  date($db->GetSystem("DateFormat"),$value["Date"]); ?></p>
                            </div>

                        </div>
                      <?php endforeach; ?>



                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
