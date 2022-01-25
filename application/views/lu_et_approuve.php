
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Jul 2021 20:55:28 GMT -->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<?php
	$name_apk=$this->Model->getValueSettings('name_apk') ;

	$logo=$this->Model->getValueSettings('logo') ;
	$reglement=$this->Model->getValueSettings('reglement') ;
	?>


	<title><?=$name_apk?></title>

	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

	<link rel="icon" href="<?=base_url('assets/photo/settings_images/').$logo?>" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="<?= base_url()?>assets/js/plugin/webfont/webfont.min.js"></script>

	<script>

		WebFont.load({

			google: {"families":["Lato:300,400,700,900"]},

			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?= base_url()?>/assets/css/fonts.min.css']},

			active: function() {

				sessionStorage.fonts = true;

			}

		});

	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?= base_url()?>assets/css/atlantis.css">

</head>
<body class="page-not-found">
	<div class="wrapper not-found">
		<h2 class="animated fadeInLeft" style="font-size:50px;">
		Règlement d'ordre intérieur
	    </h2>
	    <span class="desc animated fadeIn">OOPS!</span>
		<div><br/>
		<h5 class="animated fadeInRight text-center" style="font-size:20px;">
			Il semble que vous n'avez pas encore lu le règlement,
		</h5>
		<em>
			SVP lisez le règlement  
			<a href="javascript:void(0)" data-toggle="modal" data-target="#reglement">ICI</a>  puis approuvez en cochant cette case ci-bas puis cliquez sur le bouton.
		</em>
	    </div>
	    
		<div class="row">
		  <div class="col-md-6 mt-4">
		  	<form id="uploadForm" onsubmit="return false" method="post">
		  		<input type="checkbox" class="approbation" value="1" name="approbation" style="width:40px;height:40px;" id="approbation">
		  	</form>
		  </div>
		  <div class="col-md-6">
		  	<a href="javascript:void(0)" onclick="approbation()" class="btn btn-primary btn-back-home mt-4 animated fadeInUp">
			<span class="btn-label mr-2">
				<i class="fa fa-check"></i>
			</span>
			Accepter
		    </a>
		  </div>	
		</div>	
	</div>
	<script src="<?= base_url()?>assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url()?>assets/js/core/popper.min.js"></script>
	<script src="<?= base_url()?>assets/js/core/bootstrap.min.js"></script>
	<script src="<?= base_url()?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

</body>

<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Jul 2021 20:55:28 GMT -->
</html>




<div class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" id="reglement">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title text-center">Le règlement</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fa fa-times"></i></span>
              </button>
          </div>
          <div class="modal-body">
             <?=$reglement?>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          </div>
      </div>
  </div>
</div>


<script>


	function approbation(){
		if( $('input[name=approbation]').is(':checked') ){
				let form = document.getElementById('uploadForm');
                form.action = '<?= base_url()?>Login/approuve';
                form.method = 'POST';
                form.submit();
			} else {
			  swal("Oops!", "Cochez d\'abord cette case!", {
						icon : "info",
						buttons: {        			
							confirm: {
								className : 'btn btn-info'
							}
						},
					});
		 }

	}


</script>