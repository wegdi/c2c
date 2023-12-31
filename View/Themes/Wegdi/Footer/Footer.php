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

<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/feather-icons/feather.min.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/plugins.js?rn=221"></script>



<!--Swiper slider js-->
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/swiper/swiper-bundle.min.js"></script>




<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/prismjs/prism.js"></script>


<!-- ckeditor -->
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

<!-- dropzone js -->
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/dropzone/dropzone-min.js"></script>


<!-- Vector map-->







<!-- App js -->
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/app.js"></script>


<!-- multi.js -->
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/multi.js/multi.min.js"></script>
<!-- autocomplete js -->
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>
<!-- init js -->
 <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/form-advanced.init.js?rn=22"></script>
 <!-- input spin init -->



<!-- Sweet Alerts js -->
 <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>

 <!-- Sweet alert init js-->
 <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/sweetalerts.init.js"></script>

 <?php if ($param0=="Home" or $param0=="" ): ?>

 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script>
 fetch('/Modal/Home/Query/Query.php')
   .then(response => response.json())
   .then(data => {
     const ctx = document.getElementById('myChart');

     const chartData = {
       labels: data.Conversions.Labels,
       datasets: [
         {
           label: data.Conversions.label, // "Dönüşümler"
           data: data.Conversions.Data,
           backgroundColor: 'red',
           borderWidth: 1,
         },
         {
           label: data.Click.label, // "Tıklamalar"
           data: data.Click.Data,
           backgroundColor: 'blue',
           borderWidth: 1,
         },
         {
           label: data.Amount.label, // "Harcanan Tutar"
           data: data.Amount.Data,
           backgroundColor: 'green',
           borderWidth: 1,
         },
       ],
     };

     new Chart(ctx, {
       type: 'bar',
       data: chartData,
       options: {
         scales: {
           y: {
             beginAtZero: true,
           },
         },
       },
     });
   })
   .catch(error => {
     console.error('Veri çekme hatası:', error);
   });


 </script>
 <?php endif; ?>
<script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/ecommerce-product-checkout.init.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--select2 cdn-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script src="<?php echo $Themes->ThemeUrl(); ?>/assets/js/pages/select2.init.js"></script>

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





</body>

</html>
