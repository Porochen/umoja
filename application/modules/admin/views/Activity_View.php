<?php include VIEWPATH.'template/includes/header.php';?>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/activite.css">
<!-- Sidebar -->

<?php include VIEWPATH.'template/includes/sidebar_menu.php';?>

<!-- End Sidebar -->

<div class="main-panel">

 <div class="container">


<div class="app-content">
				
				<!-- PAGE-HEADER -->
  <div class="panel-header bg-primary-gradient">

   <div class="page-inner py-3">

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

     <div>

      <h2 class="text-white pb-2 fw-bold">

      <?=lang('liste_d_attente')?>

      </h2>

     </div>

     <div class="ml-md-auto py-2 py-md-0">

      <!-- PAGE-HEADER -->

      <div class="page-header">

       <ol class="breadcrumb">

        <li class="breadcrumb-item">

         <a href="#"><?=lang('acceuil')?></a>

        </li>

        <li class="breadcrumb-item">

         <a href="#"><?=lang('membres')?></a>

        </li>

        <li class="breadcrumb-item active" aria-current="page">

          <?=lang('liste_d_attente')?>

        </li>

       </ol>

      </div>

      <!-- PAGE-HEADER END -->

     </div>

    </div>

   </div>

  </div>
<!-- PAGE-HEADER END -->
	<div class="row mt-4">
		<div class="col-md-11">
			<ul class="cbp_tmtimeline">
				<li>
					<time class="cbp_tmtime" datetime="2017-11-04T18:30">
						<span class="">
							11:50PM									</span>
						<span class="large text-primary">Now</span>
					</time>
					<div class="cbp_tmicon bg-warning">
						<i class="fa fa-user"></i>
					</div>
					<div class="cbp_tmlabel empty"> 
						<span>No Activity</span> 
					</div>
				</li>

<?php foreach ($data_activity as $value) {    ?>

				<li>
					<time class="cbp_tmtime" datetime="2021-06-03T17:56:46">
						<span class="">
							5:56PM
						</span> 
						<span class="text-primary">
							<?= $value['date_insertion']?>
						</span>
					</time>
					<div class="cbp_tmicon bg-primary">
						<i class="fa fa-tags"></i>
					</div>
					<div class="cbp_tmlabel">
						<h2>
							<a href="javascript:void(0);">
								<?= $value['action']?>
							</a> 
						</h2>
						<p class="text-sm">
							<?= $value['description']?>
						</p>
					</div>
				</li>

<?php } ?>
							
			</ul>
		</div>
	</div>
    <!-- ROW-1 CLOSED -->
</div>






















    <!-- Footer -->	

    <?php include VIEWPATH.'template/includes/footer.php';?>

    <!-- End Footer -->