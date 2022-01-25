<!DOCTYPE html>

<html lang="en">



<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Jul 2021 21:35:14 GMT -->

<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<?php
	$name_apk=$this->Model->getValueSettings('name_apk') ;

	$logo=$this->Model->getValueSettings('logo') ;
	?>


	<title><?=$name_apk?></title>

	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

	<link rel="icon" href="<?=base_url('assets/photo/settings_images/').$logo?>" type="image/x-icon"/>

    <?php
		if (empty($this->session->userdata('memberid')))
		{
			redirect(base_url('Login/do_logout'));
		}	
	?>

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



	<!-- CSS Just for demo purpose, don't include it in your project -->

	<link rel="stylesheet" href="<?= base_url()?>assets/css/demo.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/summernote/summernote-bs4.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/boutique/boutique.min.css">


	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>


<?php 

$level=$this->session->userdata('id_niveau');
$color='';
if ($level==1) {
	$color='#ffd700';
}elseif($level==2){
	$color='#fff';
}elseif($level==3){
	$color='#fff';
}elseif($level==4){
	$color='#fff';
}elseif($level==5){
	$color='#ffd700';
}

?>
<div class="wrapper">

<div class="main-header">

	<!-- Logo Header -->

	<div class="logo-header" data-background-color="blue2">

		

		<a href="#" class="logo">

			<img src="<?=base_url('assets/photo/settings_images/').$logo?>" alt="Umoja" style="width: 160px; height: 60px;" class="navbar-brand">

		</a>

		<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">

			<span class="navbar-toggler-icon">

				<i class="icon-menu"></i>

			</span>

		</button>

		<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>

		<div class="nav-toggle">

			<button class="btn btn-toggle toggle-sidebar">

				<i class="icon-menu"></i>

			</button>

		</div>

	</div>

	<!-- End Logo Header -->



	<!-- Navbar Header -->

	<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

		

		<div class="container-fluid">
			<div class="dropdown">
			  <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-background-color="blue2">
			    		<?=lang('langue')?>
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton pull-right" >
			  	<li class="<?=(($this->session->userdata('current_lang')=='kirundi')?'active':'')?>" style="margin-right:10px;">
		        <a href="<?php echo base_url(); ?>Language/index/kirundi">
		          <img src="<?php echo base_url() ?>assets/photo/logo/burundi.png" style="width: 30px;"> <?=lang('kir')?>
		        </a>
		    </li>
		    <div class="dropdown-divider"></div>
		    <li class="<?=(($this->session->userdata('current_lang')=='english')?'active':'')?>" style="margin-right:10px;">
		        <a href="<?php echo base_url(); ?>Language/index/english">
		          <img src="<?php echo base_url() ?>assets/photo/logo/language-en.png" style="width: 30px;"> <?=lang('an')?>
		        </a>
		    </li>
		    <div class="dropdown-divider"></div>
		    <li class="<?=(($this->session->userdata('current_lang')=='french')?'active':'')?>" style="margin-right:10px;">
		        <a href="<?php echo base_url(); ?>Language/index/french">
		          <img src="<?php echo base_url() ?>assets/photo/logo/language-fr.png" style="width: 30px;"> <?=lang('fr')?>
		        </a>
		    </li>
		    <div class="dropdown-divider"></div>
		    <li class="<?=(($this->session->userdata('current_lang')=='kiswahili')?'active':'')?>" style="margin-right:10px;">
		        <a href="<?php echo base_url(); ?>Language/index/kiswahili">
		          <img src="<?php echo base_url() ?>assets/photo/logo/tzn.png" style="width: 30px;"> <?=lang('kiswi')?>
		        </a>
		    </li>
		    <div class="dropdown-divider"></div>
			  </div>
			</div>

			<div class="ml-md-auto">
				<?php
				$id_niveau=$this->session->userdata('id_niveau');
				$niveau=$this->Model->readOne('niveau', ['id_niveau'=> $id_niveau]);
				?>
				
			<button class="btn btn-xl" style="background-image:url(<?=base_url('assets/photo/pierre/').$niveau['image'] ?>);background-position: center; background-repeat: no-repeat; background-size: auto;">
			     <b style="font-size: 18px;color:<?=$color?> ;"><?=$niveau['niveau_desc']?></b>
			     &nbsp;&nbsp;&nbsp;<span  class="badge float-right" style="background-color:<?=$color?>;font-size: 18px;"><?=$id_niveau?></span>
			 </button>
			</div>



			<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

				<li class="nav-item toggle-nav-search hidden-caret">

					<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">

						<i class="fa fa-search"></i>

					</a>

				</li>


				
		

				<li class="nav-item">

					<a href="#" class="nav-link quick-sidebar-toggler">

						<i class="fa fa-th"></i>

					</a>

				</li>


				<li class="nav-item dropdown hidden-caret">

					<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">

						<div class="avatar-sm">

						<?php
						$memb=$this->Model->readOne('membre', ['id_membre'=> $this->session->userdata('memberid')]);
						$img = '';

						if (!empty($memb['photo_membre'])) { 

						$img=base_url('assets/photo/profile/').$memb['photo_membre'];
						$nom=$memb['nom_membre'];
						}else{ 
						$img=base_url('assets/photo/profile/profile.jpg');
						$nom='No Image';
						}  

						?>
						<center>
						<img class="media-object rounded-circle thumb-sm" alt="<?=$nom?>" src="<?= $img ?>" style="width: 40px; height: 40px">
						</center>


						</div>

					</a>

					<ul class="dropdown-menu dropdown-user animated fadeIn">

						<div class="dropdown-user-scroll scrollbar-outer">

							<li>

								<div class="user-box">

									<div class="avatar-lg">

										<center>
										<img class="media-object rounded-circle thumb-sm" alt="<?=$nom?>" src="<?= $img ?>" style="width: 40px; height: 40px">
										</center>

									</div>

									<div class="u-text">

										<h4><?= $this->session->userdata('prenom') ?></h4>

										<p class="text-muted"><?= $this->session->userdata('username') ?></p><a href="<?= base_url('membre/Membre/Profile')?>" class="btn btn-xs btn-secondary btn-sm"><?=lang('view_profile')?></a>

									</div>

								</div>

							</li>

							<li>

								<div class="dropdown-divider"></div>

								<a class="dropdown-item" href="<?= base_url('membre/Membre/Profile')?>"><?=lang('mon_profil')?></a>

								<div class="dropdown-divider"></div>

								<a class="dropdown-item" href="<?= base_url('Login/do_logout')?>"><?=lang('logout')?></a>

							</li>

						</div>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

	<!-- End Navbar -->

</div>

