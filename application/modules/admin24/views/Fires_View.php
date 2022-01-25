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

								Liste des fires de <b ><?= $water['nom_membre'].' '.$water['prenom_membre'] ?></b>

							   </h2>
                               <input type="hidden" name="id_water_source" value="<?=$water['id_membre']?>">
							</div>

							<div class="ml-md-auto py-2 py-md-0">

							<!-- PAGE-HEADER -->

							<div class="page-header">

								<ol class="breadcrumb">

									<li class="breadcrumb-item">

										<a href="#">Home</a>

									</li>

                  <li class="breadcrumb-item">

                      <a href="<?=base_url('admin/Waters')?>">Waters</a>

                  </li>

									<li class="breadcrumb-item active" aria-current="page">

										Fires

									</li>

								</ol>

							</div>

                            <!-- PAGE-HEADER END -->

							</div>

						</div>

					</div>

				</div>



        <!-- code here -->
<div class="container pt-3">
<div class="row mb-3">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body p-t-0">
                    <div class="input-group">
                        <input type="text" onkeyup="getList(this.value)" autocomplete="off" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Recherche">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    <div id="get_waters">   

   </div>



        </div>

        </div>





   

<!-- Footer -->	

<?php include VIEWPATH.'template/includes/footer.php';?>

<!-- End Footer -->	

 
<script>
  $(document).ready(function(){
   getList(critere="")
});
</script>
<script>
    function getList(critere=""){
        var id_water_source=$('[name="id_water_source"]').val();
       $.ajax({
        url: "<?=base_url('admin/Waters/listing_fires/');?>"+critere,
        type: "POST",
        dataType: 'JSON',
        data:{id_water_source:id_water_source},
      error:function() {
          $('#get_waters').html('<div class="alert alert-danger col-md-12"><h6 class="text-center">Error: reessayer encore ! </h6></div>');
      },
      success: function(data){

          $('#get_waters').html(data);
          }
      }); 
   }

</script> 