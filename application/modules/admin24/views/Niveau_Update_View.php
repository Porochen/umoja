     
<?php include VIEWPATH.'template/includes/admin_header.php';?>

		<!-- Sidebar -->

<?php include VIEWPATH.'template/includes/admin_menu.php';?>

		<!-- End Sidebar -->



		<div class="main-panel">

			<div class="container">

				<div class="panel-header bg-primary-gradient">

					<div class="page-inner py-3">

						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

							<div>

							   <h2 class="text-white pb-2 fw-bold">

								Niveau

							   </h2>

							</div>

							<div class="ml-md-auto py-2 py-md-0">

							<!-- PAGE-HEADER -->

							<div class="page-header">

								<ol class="breadcrumb">

									<li class="breadcrumb-item">

										<a href="#">Home</a>

									</li>

				                  <li class="breadcrumb-item">

				                      <a href="#">Admin</a>

				                  </li>

									<li class="breadcrumb-item active" aria-current="page">

										Niveau

									</li>

								</ol>

							</div>

                            <!-- PAGE-HEADER END -->

							</div>

						</div>

					</div>

				</div>
     
        <center><div class="col-md-10 mt-3">   
        <form method="post" action="<?=base_url('admin/Niveau/update')?>" enctype="multipart/form-data" class="card">
						<div class="card-header">

							<div class="card-title ">Modifier un niveau <a href="<?=base_url('admin/Niveau')?>" class="btn btn-primary float-right"><i class="fa fa-list"></i>Liste</a></div>

						</div>

						<div class="card-body">
							<div class="row">
							<div class="form-group col-md-6">
								<input type="hidden" class="form-control" required name="id" value="<?=$niveau['id_niveau']?>">
								<label class="form-label">DESCRIPTION DU NIVEAU</label>

								<input type="text" class="form-control" required name="descr" value="<?=$niveau['niveau_desc']?>">

							</div>

							
							<div class="form-group col-md-6">

								<label class="form-label">MONTANT POUR LE CADEAU</label>

								<input type="number" class="form-control" required name="cadeau" value="<?=$niveau['cout_gift']?>">

							</div>

							<div class="form-group col-md-6">

								<label class="form-label">IMAGE</label>

								<input type="file" class="form-control" required name="img" >

							</div>

						</div>
						</div>
						<div class="card-footer text-right">

							<button type="submit" class="btn btn-primary">Modifier</button>

						</div>

					</form>

       </div></center>



        </div>

        </div>



   

<!-- Footer -->	

<?php include VIEWPATH.'template/includes/footer.php';?>

<!-- End Footer -->	
