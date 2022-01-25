<?php include VIEWPATH.'template/includes/header.php';?>

		<!-- Sidebar -->

<?php include VIEWPATH.'template/includes/sidebar_menu.php';?>

		<!-- End Sidebar -->



		<div class="main-panel">

			<div class="container">



<?php
          $image_profil='';
       if (!empty($source['photo_membre'])) {
           $image_profil=base_url('assets/photo/profile/').$source['photo_membre'];
       }else{
           $image_profil=base_url('assets/photo/profile/profile.jpg');
       }

?>





				<div class="panel-header bg-primary-gradient">

					<div class="page-inner py-5">

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











            <div class="page-inner mt--5">

                <div class="row mt--5">

                        <div class="col-lg-4 col-xl-3">

                            <div class="card bg-primary ">

                            <div class="panel-heading p-4 text-center">

                                <h3 class=" text-center mb-2"><?=lang('team_leader')?></h3>

                                <p class="text-dark mb-0">
                                 <?php
                                  
                                  $niveau=$this->Model->readOne('niveau', ['id_niveau'=> $source['id_niveau']]);
                                  ?>

                                    <?=$niveau['niveau_desc']?>

                                </p>

                            </div>

                            <div class=" userlist">

                                <div class="card-body text-center">

                                    <div class="userprofile mt-0">

                                        <div class="userpic"> 

                                            <center>

                                                   <img class="media-object rounded-circle thumb-sm" alt="<?= $source['prenom_membre']?>" src="<?= $image_profil?>" style="width: 100px; height: 100px">

                                                  </center>

                                        </div>

                                        <h3 class="username text-white">

                                            <?= $source['prenom_membre']?><br>

                                            <?= $source['nom_membre']?>

                                        </h3>

                                    </div>

                                    <p class="mb-0 text-white">

                                        <a href="javascript:void(0);" class="text-white">

                                            <?= $source['email_membre']?>             

                                        </a>

                                    </p>

                                    <p class="mb-0 text-white">

                                        <a href="javascript:void(0);" class="text-white">

                                            <?= $source['tele_membre']?>                

                                        </a>

                                    </p>

                                </div>

                            </div>

                            <div class="panel-footer br-br-0 br-bl-0">

                                <div class="text-center ">

                                    <div class="flex-c-m ">

                                        <a href="" target="_blank" class="login100-social-item bg1">

                                            <i class="fa fa-facebook"></i>

                                        </a>

                                        <a href="" target="_blank" class="login100-social-item bg2">

                                            <i class="fa fa-telegram"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>                      </div>

                        <div class="col-lg-8 col-xl-9">

                            <div class="input-group mb-5">

                                <input type="text" class="form-control" placeholder="">

                                <div class="input-group-append ">

                                    <button type="button" class="btn btn-secondary">

                                        <i class="fa fa-search" aria-hidden="true"></i>

                                    </button>

                                </div>

                            </div>

                            <div id="message_rps"></div>

                            <div class="card">

                                <div class="card-header border-bottom-0 p-4">

                                  <?php $total=count($user_in_waiting);?>

                                    <h2 class="card-title"><?=$total;?> <?=lang('membres')?></h2>

                                    <div class="page-options d-flex float-right">

                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newMember">

                                         <i class="fa fa-plus"></i><?=lang('nouveau')?>

                                        </button>

                                    </div>

                                </div>

                                <div class="e-table">

                                    <div class="table-responsive table-lg">

                                        <table class="table table-bordered mb-0">

                                            <thead>

                                                <tr>

                                                    <th><?=lang('nom_prenom')?></th>

                                                    <th><?=lang('email')?></th>
                                                    
                                                    <th><?=lang('phone_number')?></th>

                                                    <th><?=lang('date_of_birth')?></th>

                                                    <th class="text-center"><?=lang('actions')?></th>

                                                </tr>

                                            </thead>

                                            <tbody>

<?php 

        if (!empty($user_in_waiting)) {

         

         foreach ($user_in_waiting as $value) {     ?>

        

                                              <tr>

                                                 <td>

                                                   <?= $value['prenom_membre'].' '.$value['nom_membre']?> 

                                                  </td>

                                                  <td>

                                                   <?= $value['email_membre']?> 

                                                  </td>

                                                  <td>

                                                   <?= $value['tele_membre']?> 

                                                  </td>

                                                  <td>

                                                   <?= $value['date_insertion']?> 

                                                  </td>

                                                  <td class="text-center">

                                                    <a href="javascript:void(0)" title="Valider" data-toggle="modal" data-target="#approuver">

                                                      <i class="fa fa-sync-alt"></i>

                                                    </a>

                                                  </td>

                                               </tr>







<div class="modal fade" id="approuver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">

        <?=lang('vous_voulez_activer')?> <strong><em><?=$value['prenom_membre']?></em></strong>

        </h5>

        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-footer">

        <form action="<?= base_url('admin/Dashboard/approuver_waiting_list')?>" method="post">

          <input type="hidden" name="id_membre" value="<?= $value['id_membre']?>">

          <button type="submit" class="btn btn-sm btn-primary"><?=lang('activer')?></button>

        </form>

      </div>

    </div>

  </div>

</div>





<?php } } else { ?>

                                  <tr>

                                    <td colspan="5">

                                      <center>

                                         <h5><?=lang('donne_affiche')?></h5>

                                      </center>

                                    </td>

                                  </tr>

<?php        } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <div class="mb-5">

                                <ul class="pagination float-right">



                                    

                                </ul>

                            </div>

                        </div><!-- COL-END -->

                    </div>

                    <!-- ROW CLOSED --> 

            </div>



			







   

<!-- Footer -->	

<?php include VIEWPATH.'template/includes/footer.php';?>

<!-- End Footer -->	





















<!-- MESSAGE MODAL -->

    <div class="modal fade" id="newMember" tabindex="-1" role="dialog"  aria-hidden="true">

        <div class="modal-dialog" role="document">

            <form method="post" action="" onsubmit="return false" id="form_member" class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="example-Modal3">

                     <?=lang('nouveau_membre')?>

                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label for="recipient-name" class="form-control-label"><?=lang('nom')?></label>

                        <input type="text" name="nom_membre" autocomplete="off" class="form-control">

                    </div>

                    <div class="form-group">

                        <label for="recipient-name" class="form-control-label"><?=lang('prenom')?></label>

                        <input type="text" name="prenom_membre" autocomplete="off" class="form-control">

                    </div>





                    <div class="form-group">

                        <label for="recipient-name" class="form-control-label"><?=lang('email')?></label>

                        <input type="email" name="email_membre" onchange="send_mail()" autocomplete="off" class="form-control">

                        <div id="loadCODE"></div>

                    </div>

                    <div class="form-group" id="message_code"></div>

                    <div class="form-group">

                        <label for="recipient-name" class="form-control-label"><?=lang('tel')?></label>

                        <input type="tel" name="tele_membre" autocomplete="off" class="form-control">

                    </div>

                    <div class="form-group">

                        <label for="recipient-name" class="form-control-label"><?=lang('code_verification')?></label>

                        <input type="text" name="code" autocomplete="off" class="form-control">

                    </div>

                </div>

                <div class="modal-footer">

                    <input type="hidden" name="MM_insert" value="adDNEwUPdATe">

                    <button type="submit" onclick="new_fire()" class="btn btn-primary">

                      <?=lang('enregistrer')?>

                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- MESSAGE MODAL CLOSED -->







    <script>

        function new_fire(){

          var nom_membre=$('[name="nom_membre"]').val();

          var prenom_membre=$('[name="prenom_membre"]').val();

          var email_membre=$('[name="email_membre"]').val();

          var tele_membre=$('[name="tele_membre"]').val();

          var code=$('[name="code"]').val();



          if (nom_membre!='' && prenom_membre!='' && email_membre!='' && tele_membre!='' && code!='') {

             $('[name="code"]').css('border-color','');

              $.ajax({

                url:'<?= base_url()?>admin/Dashboard/new_fire',

                type:'post',

                data:{nom_membre:nom_membre,prenom_membre:prenom_membre,email_membre:email_membre,tele_membre:tele_membre,code:code},

                success:function(data){

                    $('#form_member').get(0).reset()

                    $('#newMember').modal('hide');

                    $('#message_rps').html(data);

                    setInterval(function(){ 



                      window.location.href='<?= base_url() ?>admin/Dashboard/Waiting_list';



                   }, 1000);

                }

              })

          }else if(nom_membre==''){

             $('[name="nom_membre"]').focus();

             $('[name="nom_membre"]').css('border-color','red');

          }else if(prenom_membre==''){

             $('[name="prenom_membre"]').focus();

             $('[name="prenom_membre"]').css('border-color','red');

             $('[name="nom_membre"]').css('border-color','');

          }else if(email_membre==''){

             $('[name="email_membre"]').focus();

             $('[name="email_membre"]').css('border-color','red');

             $('[name="nom_membre"]').css('border-color','');

             $('[name="prenom_membre"]').css('border-color','');

          }else if(tele_membre==''){

             $('[name="tele_membre"]').focus();

             $('[name="tele_membre"]').css('border-color','red');

             $('[name="nom_membre"]').css('border-color','');

             $('[name="prenom_membre"]').css('border-color','');

             $('[name="email_membre"]').css('border-color','');

          }else if(code==''){

             $('[name="code"]').focus();

             $('[name="code"]').css('border-color','red');

             $('[name="nom_membre"]').css('border-color','');

             $('[name="prenom_membre"]').css('border-color','');

             $('[name="email_membre"]').css('border-color','');

             $('[name="email_membre"]').css('border-color','');

          }

        }





        function send_mail(){

           var nom_membre=$('[name="nom_membre"]').val();

           var prenom_membre=$('[name="prenom_membre"]').val();

           var email_membre=$('[name="email_membre"]').val();

           $.ajax({

               url:'<?= base_url()?>admin/Dashboard/send_mail',

               type:'post',

               data:{email_membre:email_membre,nom_membre:nom_membre,prenom_membre:prenom_membre},

               success:function(data){

                $('#message_code').html(data);

               }

           })

        }

    </script>