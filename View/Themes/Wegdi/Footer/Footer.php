<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once(CONTROLLER.'AppControl/ThemesControl/ThemesControl.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
?>

</div>
<!-- End Page-content -->

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Wegdi.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by Wegdi
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->
</div>
</div>
<!-- END layout-wrapper -->
<!-- JAVASCRIPT -->

<script>var Url = "<?php echo $Themes->ThemeUrl(); ?>/";</script>
<!-- JAVASCRIPT -->



<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/feather-icons/feather.min.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/plugins.js"></script>

<!-- prismjs plugin -->
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/prismjs/prism.js"></script>

<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/app.js"></script>


<!--select2 cdn-->

<script>
var param0 = "<?php echo $param0; ?>";
var param1 = "<?php echo $param1; ?>";
var param2 = "<?php echo $_GET["data"]; ?>";
var param3 = "<?php echo $param2; ?>";
var param4 = "<?php echo $param3; ?>";

var warning = "<?php echo $Themes->Translate("TEXT_WARNING"); ?>";
var warningtext = "<?php echo $Themes->Translate("TEXT_WARNING_REQUIRED"); ?>";
var save = "<?php echo $Themes->Translate("TEXT_SAVE"); ?>";
var savetext = "<?php echo $Themes->Translate("TEXT_SAVE_ALERT"); ?>";
var deletetext = "<?php echo $Themes->Translate("TEXT_DELETE"); ?>";
var deletetitle = "<?php echo $Themes->Translate("TEXT_DELETE_ERROR"); ?>";
</script>



<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/datatables.init.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/custom.js?rn=<?php echo rand(2222,22222222222); ?>"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/core.js?rn=<?php echo rand(2222,22222222222); ?>"></script>


<script>
        $(document).ready(function() {
            // .listle sınıfına sahip tüm select elementlerine select2 eklentisini uygula
            $('.listle').select2({
                placeholder: 'Arama yapın...',
                ajax: {
                    url: function () {
                        return $(this).data('url');
                    },
                    dataType: 'Json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.Name,
                                    id: item.IdeaSoftId
                                };
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>

</body>

</html>
