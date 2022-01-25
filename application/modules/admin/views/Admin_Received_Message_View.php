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

								Aide et support <b style="color:black"></b>

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

                      <a href="#">Aide et Support</a>

                  </li>

									<li class="breadcrumb-item active" aria-current="page">

										 Message box

									</li>

								</ol>

							</div>

                            <!-- PAGE-HEADER END -->

							</div>

						</div>

					</div>

				</div>


						<!-- CONTAINER -->
			<div class="app-content">
				
<!-- PAGE-HEADER END -->
				<!-- ROW-1 OPEN -->
				<div class="row">
					<div class="col-lg-3 col-md-12 col-sm-12">
						<div class="card">
							<div class="list-group list-group-transparent mb-0 mail-inbox">
						

								<a href="<?=base_url('admin/Admin_Support/compose')?>"  class="list-group-item list-group-item-action d-flex align-items-center ">
									<span class="icon mr-3">
										<i class="fe fe-inbox"></i>
									</span>New message
																	</a>
								
								<a href="<?=base_url('admin/Admin_Support')?>"  class="list-group-item list-group-item-action d-flex align-items-center active">
									<span class="icon mr-3">
										<i class="fe fe-inbox"></i>
									</span>Message box
																	</a>

								
								<a href="<?=base_url('admin/Admin_Support/sent_message')?>" class="list-group-item list-group-item-action d-flex align-items-center ">
									<span class="icon mr-3">
										<i class="fe fe-send"></i>
									</span>Sent message
																	</a>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-9">

						<div id="received_sms">
							
						</div>

				</div>
				<!-- ROW-1 CLOSED -->
			</div>
			<!-- CONTAINER CLOSED -->
		</div>
	</div>



<?php include VIEWPATH.'template/includes/footer.php';?>

<script>

	$(document).ready(function(){
   getList()
});
    function getList(){
       $.ajax({
        url: "<?=base_url('admin/Admin_Support/listing/');?>",
        type: "POST",
        dataType: 'JSON',
      error:function() {
          $('#received_sms').html('<div class="alert alert-danger col-md-12"><h6 class="text-center">Error: reessayer encore ! </h6></div>');
      },
      success: function(data){

          $('#received_sms').html(data);
          }
      }); 
   }

</script> 