<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once(CONTROLLER.'AppControl/ThemesControl/ThemesControl.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
?>
<!doctype html>
<html lang="TR" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none" data-preloader="enable">

<head>

    <meta charset="utf-8" />
    <title>Crm | Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

      <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


    <!-- Layout config Js -->
    <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo $Themes->ThemeUrl(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo $Themes->ThemeUrl(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo $Themes->ThemeUrl(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo $Themes->ThemeUrl(); ?>/assets/css/custom.min.css" rel="stylesheet" type="text/css" />





    <style media="screen">
      .ck-body-wrapper{
        display: none;
      }
    </style>


</head>

<body>
  <!--<div id="preloader">
     <div id="status">
         <div class="spinner-border text-primary avatar-sm" role="status">
             <span class="visually-hidden">Loading...</span>
         </div>
     </div>
  </div> -->


  <div id="layout-wrapper">
