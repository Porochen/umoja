<?php include VIEWPATH.'template/includes/header.php';?>

		<!-- Sidebar -->

<?php include VIEWPATH.'template/includes/sidebar_menu.php';?>

		<!-- End Sidebar -->


		<div class="main-panel">

			<div class="container">

				<div class="panel-header bg-primary-gradient">

					<div class="page-inner py-3">

						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

							<div>

							   <h2 class="text-white pb-2 fw-bold">

								<?=lang('aide_support')?><b style="color:black"></b>

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

                      <a href="#"><?=lang('aide_support')?></a>

                  </li>

									<li class="breadcrumb-item active" aria-current="page">

										<?=lang('compose')?>

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
								
								<a href="<?=base_url('admin/Users_Support/')?>" class="list-group-item list-group-item-action d-flex align-items-center active">
									<span class="icon mr-3">
										<i class="fe fe-inbox"></i>
									</span><?=lang('new_message')?>
								</a>
								
								<a href="<?=base_url('admin/Users_Support/box_message')?>" class="list-group-item list-group-item-action d-flex align-items-center ">
									<span class="icon mr-3">
										<i class="fe fe-inbox"></i>
									</span><?=lang('message_box')?>
								</a>

								
								<a href="<?=base_url('admin/Users_Support/sent_message')?>" class="list-group-item list-group-item-action d-flex align-items-center ">
									<span class="icon mr-3">
										<i class="fe fe-send"></i>
									</span><?=lang('sent_message')?>
								</a>

								<?php
						    $num_support=$this->Model->getValueSettings('num_support') ;
						    ?>
								<div class="list-group-item list-group-item-action d-flex align-items-center ">
									<span class="icon mr-3">
										<i class="fa fa-phone"></i>
									</span><?=$num_support?>
								</div>
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
											<label><?=lang('to')?></label>
											<input type="text" class="form-control" readonly value="<?=lang('support_admin')?>">
										</div>
										
										<div class="col-12">
											<br>
											<label><?=lang('sujet')?></label>
											<input type="text" name="subject" class="form-control"  placeholder="<?=lang('sujet_topic')?>" value="">
										</div>
										<div class="col-12">
											<br><br>
											<span style="font-size: 18px">
												<b><?=lang('account_info')?></b>
											</span>
										</div>
										<div class="col-4">
											<label><?=lang('user_mail')?></label>
											<input type="text" class="form-control"  name="useremail" value="<?=$mbr['email_membre']?>" readonly>
										</div>
										<div class="col-4">
											<label><?=lang('first_name')?></label>
											<input type="text" class="form-control"  name="fname" value="<?=$mbr['prenom_membre']?>" readonly>
										</div>
										<div class="col-4">
											<label><?=lang('last_name')?></label>
											<input type="text" class="form-control"  name="lname" value="<?=$mbr['nom_membre']?>" readonly>
										</div>
										<div id="loadEMAIL" class="row">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 ml-auto col-md-12 col-lg-12">
										<div class="form-group mt-3 ">
											<textarea class="form-control" id="summernote" name="message" rows="12" ><?=lang('write_something')?></textarea>
										</div>

																				<div class="">
											<div class="row">
												<div class="col-lg-6 mb-0 col-md-6 col-sm-12 text-right">
													<button type="button" onclick="send_message()" class="btn btn-primary btn-space mt-2"><?=lang('sent_message')?></button>
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

          var message=$('[name="message"]').val();

          if (subject!='' && message!='' ) {

              $.ajax({

                url:'<?= base_url()?>admin/Users_Support/send_message',

                type:'post',

                data:{subject:subject,message:message},

                success:function(data){

                    $('#form_sms').get(0).reset()

                    $('#message').html(data);

                     setInterval(function(){ 

                      window.location.href='<?= base_url() ?>admin/Users_Support/sent_message';

                   }, 1000);
                }

              })

          }else if(subject==''){

             $('[name="subject"]').focus();

             $('[name="subject"]').css('border-color','red');

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