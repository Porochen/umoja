<?php include VIEWPATH.'template/includes/admin_header.php';?>

<!-- Sidebar -->

<?php include VIEWPATH.'template/includes/admin_menu.php';?>

		<!-- End Sidebar -->

<div class="main-panel">

	<div class="container">



		<div class="panel-header bg-primary-gradient">

			<div class="page-inner py-5">

				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

					<div>

						<h2 class="text-white pb-2 fw-bold">

							Profil

						</h2>

					</div>

					<div class="ml-md-auto py-2 py-md-0">

						<!-- PAGE-HEADER -->

						<div class="page-header">

							<ol class="breadcrumb">

								<li class="breadcrumb-item">

									<a href="#">acceuil</a>

								</li>

								<li class="breadcrumb-item active" aria-current="page">

									Profil

								</li>

							</ol>

						</div>

						<!-- PAGE-HEADER END -->

					</div>

				</div>

			</div>

		</div>
		<div class="page-inner mt--5">

			<div class="row mt--2 ">

				<div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">

					<form method="post" action="" onsubmit="return false" class="card" id="form_pwd">

						<div class="card-header">

							<div class="card-title">Changer le mot de passe</div>

						</div>

						<div class="card-body">

							<div class="form-group">

								<label class="form-label">Mot de passe actuel</label>

								<input type="password" class="form-control" required name="opwd" id="opwd" placeholder="Mot de passe actuel">
								<span id="succ"></span>
							</div>

							<div class="form-group">

								<label class="form-label">Nouveau mot de passe</label>

								<input type="password" class="form-control" required name="npwd" id="npwd" onkeyup="validate()" placeholder="nouveau mot de passe">
								<span id="msg"></span>
							</div>

							<div class="form-group">

								<label class="form-label">confirmer le mot de passse</label>

								<input type="password" class="form-control" required name="npwd2" id="npwd2" placeholder="confirmer le mot de passe" onkeyup="conf()">
								<span id="msg1"></span>

							</div>

						</div>

						<div class="card-footer text-right">
							<button type="submit" class="btn btn-primary" onclick="chgpwd()">Enregistrer</button>

						</div>

					</form>

				</div>



				<div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">

					<form method="post" action="<?=base_url('admin/Change_Password/Update_Profile')?>" enctype="multipart/form-data" class="card">

						<div class="card-header">

							<h3 class="card-title">Editer mon profil</h3>

						</div>

						<div class="card-body">

							<div class="row">

								<input type="hidden" class="form-control" name="id_admin" required value="<?=$admin['id_admin']?>">

								<div class="col-lg-6 col-md-12">

									<div class="form-group">

										<label for="exampleInputname">Nom</label>

										<input type="text" class="form-control" name="fname" required value="<?=$admin['nom_admin']?>">

									</div>

								</div>

								<div class="col-lg-6 col-md-12">

									<div class="form-group">

										<label for="exampleInputname1">Prénom</label>

										<input type="text" class="form-control" name="lname" required value="<?=$admin['prenom_admin']?>">

									</div>

								</div>

							</div>

							<div class="row">

								<div class="col-lg-6 col-md-12">

									<div class="form-group">

										<label for="exampleInputEmail1">Email</label>

										<input type="email" class="form-control" name="email" readonly="" value="<?=$admin['email_admin']?>">

									</div>

								</div>

								<div class="col-lg-6 col-md-12">

									<div class="form-group">

										<label for="exampleInputnumber">Téléphone</label>

										<input type="tel" class="form-control" name="phone" required value="<?=$admin['phone_admin']?>">

									</div>
									<div class="card-footer text-right"">

																	<button type="submit" class="btn btn-info mt-1">Enregistrer</button>

																</div>
								</div>

								

							</div>

	
						</form>					

					</div>

				</div>

				<!-- ROW-1 CLOSED -->

			</div>
			<!-- Footer -->



<?php include VIEWPATH.'template/includes/footer.php';?>


<script type="text/javascript"> 
        function conf() { 
            var msg1; 
            var str = document.getElementById("npwd").value;
            var str1 = document.getElementById("npwd2").value; 

            if (str != str1)
            {
            			$('[name="npwd2"]').focus();

               $('[name="npwd2"]').css('border-color','red');

                msg1 = "<p style='color:red'>Mot de passe non conforme.</p>"; 
               
            }
            else 
            {

               $('[name="npwd2"]').css('border-color','blue');
                msg1 = "";
            			 
            }
            document.getElementById("msg1").innerHTML= msg1;
        } 




        function chgpwd(){

          var opwd=$('[name="opwd"]').val();

          var npwd=$('[name="npwd"]').val();

          var npwd2=$('[name="npwd2"]').val();

          if ((npwd==npwd2) && (npwd.length == 6) ) {

              $.ajax({

                url:'<?= base_url()?>admin/Change_Password/check_password',

                type:'post',
                dataType:'json',

                data:{opwd:opwd,npwd:npwd,npwd2:npwd2},

                success:function(data){

                	if (data.response === 'success') 
						            {
						              $('#form_pwd').get(0).reset();
						              $('#succ').html("<p class='text-success'>"+data.message+"</p>");
						               $('#succ').delay(2000).hide('slow');

						               setInterval(function(){ 
                      window.location.href='<?= base_url('admin') ?>';

                   }, 3000);

						            }else{
						              $('#form_pwd').get(0).reset();
						              $('#succ').html("<p class='text-danger'>"+data.message+"</p>");
						            }

                }

              })

          }else{

             $('[name="npwd2"]').focus();

             $('[name="npwd2"]').css('border-color','red');

             $('[name="opwd"]').css('border-color','');

             $('[name="npwd"]').css('border-color','');

          }

        }
    </script>


    <script type="text/javascript"> 
        function validate() { 
            var msg; 
            var str = document.getElementById("npwd").value; 
            if (str.match( /[0-9]/g)  &&
                str.length == 6) 
            {
                msg = ""; 
                $('[name="npwd"]').css('border-color','');
            }
            else{ 

                msg = "<p style='color:red'>Non valide(6 chiffres seulement).</p>"; 
                $('[name="npwd"]').focus();

               	$('[name="npwd"]').css('border-color','red');
                }
            document.getElementById("msg").innerHTML= msg; 
        } 
    </script>