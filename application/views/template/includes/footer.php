<?php include VIEWPATH.'template/includes/sidebar_right.php';?>

		<!-- Custom template | don't include it in your project! -->

<?php include VIEWPATH.'template/includes/sidebar_settings.php';?>

		<!-- End Custom template -->
</div>


	<footer class="footer">

		<div class="container-fluid">

			<nav class="pull-left">

				<ul class="nav">

					<li class="nav-item">

						<a class="nav-link" href="#">

							Développé par:
						</a>

					</li>

					<li class="nav-item">

						<a class="nav-link" href="#">
						United Youth Company

						</a>

					</li>

				</ul>

			</nav>

			<div class="copyright ml-auto">

				<a href="#">Copyright © Umoja Family <?=date('Y')?></a>

			</div>				

		</div>

		

	</footer>

</div>





</div>

	<!--   Core JS Files   -->

	<script src="<?= base_url()?>assets/js/core/jquery.3.2.1.min.js"></script>

	<script src="<?= base_url()?>assets/js/core/popper.min.js"></script>

	<script src="<?= base_url()?>assets/js/core/bootstrap.min.js"></script>



	<!-- jQuery UI -->

	<script src="<?= base_url()?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

	<script src="<?= base_url()?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>



	<!-- jQuery Scrollbar -->

	<script src="<?= base_url()?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<!-- Summernote -->
<script src="<?= base_url()?>assets/summernote/summernote-bs4.min.js"></script>

	<!-- Moment JS -->

	<script src="<?= base_url()?>assets/js/plugin/moment/moment.min.js"></script>



	<!-- Chart JS -->

	<script src="<?= base_url()?>assets/js/plugin/chart.js/chart.min.js"></script>



	<!-- jQuery Sparkline -->

	<script src="<?= base_url()?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>



	<!-- Chart Circle -->

	<script src="<?= base_url()?>assets/js/plugin/chart-circle/circles.min.js"></script>



	<!-- Datatables -->

	<script src="<?= base_url()?>assets/js/plugin/datatables/datatables.min.js"></script>



	<!-- Bootstrap Notify -->

	<script src="<?= base_url()?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>



	<!-- Bootstrap Toggle -->

	<script src="<?= base_url()?>assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>



	<!-- jQuery Vector Maps -->

	<script src="<?= base_url()?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>

	<script src="<?= base_url()?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>



	<!-- Google Maps Plugin -->

	<script src="<?= base_url()?>assets/js/plugin/gmaps/gmaps.js"></script>



	<!-- Dropzone -->

	<script src="<?= base_url()?>assets/js/plugin/dropzone/dropzone.min.js"></script>



	<!-- Fullcalendar -->

	<script src="<?= base_url()?>assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>



	<!-- DateTimePicker -->

	<script src="<?= base_url()?>assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>



	<!-- Bootstrap Tagsinput -->

	<script src="<?= base_url()?>assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>



	<!-- Bootstrap Wizard -->

	<script src="<?= base_url()?>assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>



	<!-- jQuery Validation -->

	<script src="<?= base_url()?>assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>



	<!-- Summernote -->

	<script src="<?= base_url()?>assets/js/plugin/summernote/summernote-bs4.min.js"></script>



	<!-- Select2 -->

	<script src="<?= base_url()?>assets/js/plugin/select2/select2.full.min.js"></script>



	<!-- Sweet Alert -->

	<script src="<?= base_url()?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>



	<!-- Owl Carousel -->

	<script src="<?= base_url()?>assets/js/plugin/owl-carousel/owl.carousel.min.js"></script>



	<!-- Magnific Popup -->

	<script src="<?= base_url()?>assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>



	<!-- Atlantis JS -->

	<script src="<?= base_url()?>assets/js/atlantis.min.js"></script>



	<!-- Atlantis DEMO methods, don't include it in your project! -->

	<script src="<?= base_url()?>assets/js/setting-demo.js"></script>

	<script src="<?= base_url()?>assets/js/demo.js"></script>

	<script type="text/javascript">
		$(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    // CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    //   mode: "htmlmixed",
    //   theme: "monokai"
    // });
  })
</script>
	<script type="text/javascript">
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script type="text/javascript">
	$('#basic').select2({
			theme: "bootstrap"
		});
</script>

<script>
  $(document).ready(function(){
  	 	 getnot()
});
</script>
<script>
    function getnot(){
       $.ajax({
        url: "<?=base_url('admin/Users_Support/notification/');?>",
        type: "POST",
        dataType: 'JSON',
      success: function(data){

          $('#notif').html(data);
          }
      }); 
   }

</script> 

</body>



<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Jul 2021 21:36:26 GMT -->

</html>