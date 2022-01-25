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
			redirect(base_url('Login/admin_do_logout'));
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

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

<div class="wrapper">

<div class="main-header">

	<!-- Logo Header -->

	<div class="logo-header" data-background-color="blue">

		

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

				<?php 

				$memb=$this->Model->readOne('admin', ['id_admin'=> $this->session->userdata('memberid')]);



				$img = '';



                if (!empty($memb['photo_membre'])) { 



                $img='

                 <img width="50" height="50" src="'.base_url('assets/photo/Profile/').$memb['photo_membre'].'" alt="Image" style="border-radius: 50%" >';

                    }else{ 

                $img='<center>

                     <font color="#aeb1b3" style="font-size: 35px"><i class="fa fa-user"></i></font>

                   </center>';

                 } 



				?>

				<li class="nav-item dropdown hidden-caret">

					<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">

						<div class="avatar-sm">

							<?= $img?>

						</div>

					</a>

					<ul class="dropdown-menu dropdown-user animated fadeIn">

						<div class="dropdown-user-scroll scrollbar-outer">

							<li>

								<div class="user-box">

									<div class="avatar-lg">

										<?= $img?>

									</div>

									<div class="u-text">

										<h4><?= $memb['nom_admin'].' '.$memb['prenom_admin']?></h4>

										<p class="text-muted"><?= $memb['email_admin']?></p>

									</div>

								</div>

							</li>

							<li>

								<div class="dropdown-divider"></div>

								<a class="dropdown-item" href="<?= base_url('admin/Change_Password/change_password_view')?>">Profil</a>

								<div class="dropdown-divider"></div>						

								<a class="dropdown-item" href="<?= base_url('Login/admin_do_logout')?>">Logout</a>

							</li>

						</div>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

	<!-- End Navbar -->

</div>

