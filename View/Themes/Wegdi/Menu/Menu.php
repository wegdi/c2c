<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db=new General();

?>


<header id="page-topbar">
  <div class="layout-width horizontal">
    <div class="navbar-header">
      <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box horizontal-logo">
          <a href="/Home" class="logo logo-dark">
            <span class="logo-sm">
              <img src="<?php echo $db->GetSystem("Logo"); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
              <img src="<?php echo $db->GetSystem("Logo"); ?>" alt="" height="40">
            </span>
          </a>

          <a href="/Home" class="logo logo-light">
            <span class="logo-sm">
              <img src="<?php echo $db->GetSystem("Logo"); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
              <img src="<?php echo $db->GetSystem("Logo"); ?>" alt="" height="40">
            </span>
          </a>
        </div>

        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
          <span class="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </button>

        <!-- App Search-->

      </div>

      <div class="d-flex align-items-center">






        <div class="ms-1 header-item d-none d-sm-flex">
          <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
            <i class='bx bx-fullscreen fs-22'></i>
          </button>
        </div>

        <div class="ms-1 header-item d-none d-sm-flex">
          <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
            <i class='bx bx-moon fs-22'></i>
          </button>
        </div>

        <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
          <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
            <i class='bx bx-bell fs-22'></i>
            <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><?php echo $db->Quantity("Notifications",[]); ?> </span>
          </button>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

            <div class="dropdown-head bg-primary bg-pattern rounded-top">
              <div class="p-3">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="m-0 fs-16 fw-semibold text-white"> <?php echo $Themes->Translate("NOTIFICATIONS"); ?> </h6>
                  </div>
                  <div class="col-auto dropdown-tabs">
                    <span class="badge bg-light-subtle text-body fs-13"> <?php echo $db->Quantity("Notifications",[]); ?> <?php echo $Themes->Translate("NEWS"); ?></span>
                  </div>
                </div>
              </div>

              <div class="px-2 pt-2">
                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                      <?php echo $Themes->Translate("ALL"); ?>
                    </a>
                  </li>
                </ul>
              </div>

            </div>

            <div class="tab-content position-relative" id="notificationItemsTabContent">
              <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">

              </div>
            </div>
          </div>
        </div>

        <div class="dropdown ms-sm-3 header-item topbar-user">
          <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center">
              <img class="rounded-circle header-profile-user" src="<?php

              if ($db->GetUser('ProfilImage')!="") {
                  echo $db->GetUser('ProfilImage');
              }else {
                echo "/View/Themes/Wegdi/Src/assets/images/users/avatar-1.jpg";
              }


              ?>" alt="Header Avatar">
              <span class="text-start ms-xl-2">
                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $db->GetUser("NameSurname");  ?></span>
                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text"></span>
              </span>
            </span>
          </button>
          <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <a class="dropdown-item" href="/Profile/Edit"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle"><?php echo $Themes->Translate("PROFILE"); ?></span></a>
            <a class="dropdown-item" href="/Help/List"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle"><?php echo $Themes->Translate("HELP"); ?></span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/Modal/Logout/Exit/Exit.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout"><?php echo $Themes->Translate("LOGOUT"); ?></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>





<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
  <!-- LOGO -->
  <div class="navbar-brand-box">
    <!-- Dark Logo-->
    <a href="/Home" class="logo logo-dark">
      <span class="logo-sm">
        <img src="<?php echo $Themes->ThemeUrl(); ?>/assets/images/logo-sm.png" alt="" height="22">
      </span>
      <span class="logo-lg">
        <img src="<?php echo $Themes->ThemeUrl(); ?>/assets/images/logo-dark.png" alt="" height="17">
      </span>
    </a>
    <!-- Light Logo-->
    <a href="/Home" class="logo logo-light">
      <span class="logo-sm">
        <img src="<?php echo $Themes->ThemeUrl(); ?>/assets/images/logo-sm.png" alt="" height="22">
      </span>
      <span class="logo-lg">
        <img src="<?php echo $Themes->ThemeUrl(); ?>/assets/images/logo-light.png" alt="" height="17">
      </span>
    </a>
    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
      <i class="ri-record-circle-line"></i>
    </button>
  </div>

  <div id="scrollbar">
    <div class="container-fluid">
      <div id="two-column-menu"></div>
      <ul class="navbar-nav" id="navbar-nav">
        <?php
        $authorityID = $db->GetUser('Authority');
        $Menus = $db->Query('Menus', ['Parent_ID' => '0'], ['sort' => ['Order' => 1]], 'COK');

        foreach ($Menus as $key => $MenuGET):
          $O_id = $MenuGET['_id']->__toString();
          $authorityArray = is_array($MenuGET["Authority"]) ? $MenuGET["Authority"] : [$MenuGET["Authority"]];

          // Kullanıcının yetkisi menü içinde varsa, menüyü oluşturun
          if (in_array($authorityID, $authorityArray)):
            ?>
            <li class="menu-title">
              <span data-key="t-menu"><?php echo htmlspecialchars($MenuGET[LANGUAGES_GET_DIL]); ?></span>
            </li>
            <li class="nav-item">
              <?php if ($MenuGET["Seo_Url"] == "Home"): ?>
                <a class="nav-link menu-link" href="<?php echo htmlspecialchars(HTTPS_SERVER . $MenuGET["Seo_Url"]); ?>">
                  <i class="<?php echo htmlspecialchars($MenuGET["Icon"]); ?>"></i>
                  <span data-key="t-dashboards"><?php echo htmlspecialchars($MenuGET[LANGUAGES_GET_DIL]); ?></span>
                </a>
              <?php else: ?>
                <a class="nav-link menu-link" href="#<?php echo $O_id; ?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="<?php echo $O_id; ?>">
                  <i class="<?php echo htmlspecialchars($MenuGET["Icon"]); ?>"></i>
                  <span data-key="t-dashboards"><?php echo htmlspecialchars($MenuGET[LANGUAGES_GET_DIL]); ?></span>
                </a>
              <?php endif; ?>

              <?php
              $SubMenuC = $db->Query('Menus', ['Parent_ID' => $O_id], ['sort' => ['Order' => 1]], 'TEK');
              if ($SubMenuC["Parent_ID"] != ""):
                $SubMenu = $db->Query('Menus', ['Parent_ID' => $O_id], ['sort' => ['Order' => 1]], 'COK');
                ?>
                <div class="collapse menu-dropdown" id="<?php echo $O_id; ?>">
                  <ul class="nav nav-sm flex-column">
                    <?php
                    foreach ($SubMenu as $SubMenuGet):
                      // Alt menünün yetki kontrollerini yapın
                      $subMenuAuthorityArray = is_array($SubMenuGet["Authority"]) ? $SubMenuGet["Authority"] : [$SubMenuGet["Authority"]];
                      if (in_array($authorityID, $subMenuAuthorityArray)):
                        ?>
                        <li class="nav-item">
                          <a href="<?php echo htmlspecialchars(HTTPS_SERVER . $SubMenuGet["Seo_Url"]); ?>" class="nav-link"
                            data-key="t-analytics"><?php echo htmlspecialchars($SubMenuGet[LANGUAGES_GET_DIL]); ?></a>
                        </li>
                        <?php
                      endif;
                    endforeach;
                    ?>
                  </ul>
                </div>
              <?php endif; ?>
            </li>
            <?php
          endif;
        endforeach;
        ?>
      </ul>
    </div>
  </div>


  <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<div class="main-content">

  <div class="page-content">
    <div class="container-fluid">

      
