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

								Liste des Parents
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

										Parents

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
                        <input type="text" onkeyup="getList(this.value)" autocomplete="off" id="search" name="example-input1-group2" class="form-control" placeholder="Recherche">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    <div id="get_parents">   

   </div>



        </div>

        </div>





   

<!-- Footer -->	

<?php include VIEWPATH.'template/includes/footer.php';?>

<!-- End Footer -->	

 
<script>
  $(document).ready(function(){
   getList(critere="",page=0)
});

  $(document).on('click','.page-item',function(){
    var page=$(this).attr('id');
    var critere=$('#search').val();
    getList(critere,page);
})

</script>
<script>
    function getList(critere="",page=0){
        
       $.ajax({
        url: "<?=base_url('admin/Parents/listing');?>",
        type: "POST",
        data:{critere:critere,page:page},
        dataType: 'JSON',
        beforeSend:function () { 
              $('#get_parents').html("<br><div class='col-lg-12'><center><font style='font-size:46px'><i class='fa fa-46px fa-spin fa-spinner'></i><span class='sr-only'>Loading...</span></font></center></div>");
            },
      error:function() {
          $('#get_parents').html('<div class="alert alert-danger col-md-12"><h6 class="text-center">Error: reessayer encore ! </h6></div>');
      },
      success: function(data){

          $('#get_parents').html(data);
          }
      }); 
   }

</script> 