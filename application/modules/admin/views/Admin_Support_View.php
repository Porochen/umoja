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

										Compose

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

				<!-- ROW-1 OPEN -->
				<div class="row">
					<div class="col-lg-3 col-md-12 col-sm-12">
						<div class="card">
							<div class="list-group list-group-transparent mb-0 mail-inbox">
								
								<a href="<?=base_url('admin/Admin_Support/compose')?>" class="list-group-item list-group-item-action d-flex align-items-center active">
									<span class="icon mr-3">
										<i class="fe fe-inbox"></i>
									</span>New message
								</a>
								
								<a href="<?=base_url('admin/Admin_Support')?>" class="list-group-item list-group-item-action d-flex align-items-center ">
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
					<div class="col-lg-9 col-md-12 col-sm-12">
						<span id="message"></span>
						
						<form method="post" action="" onsubmit="return false" id="form_sms" class="card">
							<div class="inbox card-body">
								<div>
									<div class="form-row mb-4">
										<div class="col-12">
											<label>To:</label>

											<select name="smsto" id="basic" class="select2-input form-control">
												<option value="NULL">All members</option>
												<?php foreach ($to as $value): ?>
													<option value="<?=$value['id_membre']?>"><?=$value['nom_membre'].' '.$value['prenom_membre']?></option>
												<?php endforeach ?>
												
											</select>
											
										</div>
										
										<div class="col-12">
											<br>
											<label>Subject:</label>
											<input type="text" name="subject" class="form-control"  placeholder="Subject / Topic Here..." value="">
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 ml-auto col-md-12 col-lg-12">
										<div class="form-group mt-3 ">
											<textarea class="form-control" id="summernote" name="message" rows="12" >Write something here...</textarea>
										</div>

																				<div class="">
											<div class="row">
												<div class="col-lg-6 mb-0 col-md-6 col-sm-12 text-right">
													<button type="button" onclick="send_message()" class="btn btn-primary btn-space mt-2">Send message</button>
												</div>
											</div>
										</div>
																			</div>
								</div>
							</div>
						</form>
					</div><!-- COL-END -->
				</div>
				<!-- ROW-1 CLOSED -->
			</div>
			<!-- Footer -->	
		</div>

<?php include VIEWPATH.'template/includes/footer.php';?>

<!-- End Footer -->	

<script type="text/javascript">
	function send_message(){

          var subject=$('[name="subject"]').val();
          var smsto=$('[name="smsto"]').val();

          var message=$('[name="message"]').val();

          if (subject!='' && message!='' && smsto!='') {

              $.ajax({

                url:'<?= base_url()?>admin/Admin_Support/compose_send',

                type:'post',

                data:{subject:subject,message:message,smsto:smsto},

                success:function(data){

                    $('#form_sms').get(0).reset()

                    $('#message').html(data);

                     setInterval(function(){ 

                      window.location.href='<?= base_url() ?>admin/Admin_Support/sent_message';

                   }, 1000);
                }

              })

          }else if(smsto==''){

             $('[name="smsto"]').focus();

             $('[name="smsto"]').css('border-color','red');

          }else if(subject==''){

             $('[name="subject"]').focus();

             $('[name="subject"]').css('border-color','red');
             $('[name="smsto"]').css('border-color','');

          }else if(message==''){

             $('[name="message"]').focus();

             $('[name="message"]').css('border-color','red');

             $('[name="subject"]').css('border-color','');

          }

        }

  $(document).ready(function(){
   $('#message').delay('slow').fadeOut(5000);
 });
</script>