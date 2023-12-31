<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once(CONTROLLER.'AppControl/ThemesControl/ThemesControl.php');
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Giriş Ekranı | CRM YÖNETİM PANELİ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="<?php echo $Themes->ThemeUrl(); ?>/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo $Themes->ThemeUrl(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo $Themes->ThemeUrl(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo $Themes->ThemeUrl(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="assets/images/logo-light.png" alt="" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary"><?php echo $Themes->Translate("TEXT_WELCOME"); ?></h5>
                                        </div>

                                        <div class="mt-4">
                                            <form action="/System/Login/Login.php" method="POST">

                                                <div class="mb-3">
                                                    <label for="username" class="form-label"><?php echo $Themes->Translate("INPUT_USERNAME"); ?></label>
                                                    <input type="text" class="form-control" id="username" name="email">
                                                </div>

                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <a href="/sifremi-unuttum" class="text-muted"><?php echo $Themes->Translate("TEXT_FORGOT"); ?></a>
                                                    </div>
                                                    <label class="form-label" for="password-input"><?php echo $Themes->Translate("INPUT_PASSWORD"); ?></label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 password-input"  id="password-input" name="password">
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>


                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check"><?php echo $Themes->Translate("INPUT_REMEMBER"); ?></label>
                                                </div>

                                                <div class="mt-4">
                                                        <button class="btn btn-success w-100" type="button" id="login-btn"><?php echo $Themes->Translate("BUTTON_LOGIN"); ?></button>
                                                </div>



                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0"><?php echo $Themes->Translate("TEXT_ACCOUNT_HAVE"); ?> <a href="auth-signup-cover.html" class="fw-semibold text-primary text-decoration-underline"> <?php echo $Themes->Translate("TEXT_SIGNUP"); ?></a> </p>
                                        </div>

                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">
                              <?php echo INFO; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/plugins.js"></script>
    <!-- Sweet Alerts js -->
     <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>

     <!-- Sweet alert init js-->
     <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/sweetalerts.init.js"></script>

    <!-- password-addon init -->

    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/password-addon.init.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/custom.js?rn=<?php echo rand(222,1111); ?>"></script>


</body>

</html>
