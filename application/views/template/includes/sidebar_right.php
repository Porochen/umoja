<?php if ($this->session->userdata('memberid')!=1) {
?>

<div class="quick-sidebar">

<a href="#" class="close-quick-sidebar">

	<i class="flaticon-cross"></i>

</a>



<div class="quick-sidebar-wrapper">

	<ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
		<li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#members" role="tab" aria-selected="true">Mes Fires</a> </li>

		<!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tasks" role="tab" aria-selected="false">Tasks</a> </li>

		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Settings</a> </li> -->

	</ul>

			<?php
				$id=$this->session->userdata('memberid');
                $fires=$this->Model->readRequete("SELECT DISTINCT(id_membre), m.nom_membre,m.prenom_membre,m.tele_membre,photo_membre FROM membre m  LEFT JOIN beneficiaire b ON b.id_membre_donateur=m.id_membre WHERE b.id_water_source =".$id);
				?>

	<div class="tab-content mt-3">

		<div class="tab-chat tab-pane fade show active" id="members" role="tabpanel">

			<div class="messages-contact">

				<div class="quick-wrapper">

					<div class="quick-scroll scrollbar-outer">

						<div class="quick-content contact-content">

							<span class="category-title mt-0">Liste de mes fires</span>

							<div class="contact-list contact-list-recent ml-3">
							<?php 
							$i=1;

							foreach ($fires as $fire) {
								 ?>
								<div class="user">
									<div class="form-group">
										<div class="row">
										<div>
											<span class="text-info">
                                            <?=$i++?>
                                        </span>
																						
										</div>
						<?php

						$img = '';

						if (!empty($fire['photo_membre'])) { 

						$img=base_url('assets/photo/profile/').$fire['photo_membre'];
						$nom=$fire['nom_membre'];
						}else{ 
						$img=base_url('assets/photo/profile/profile.jpg');
						$nom='No Image';
						}  

						?>
										<div class="avatar">

											<img src="<?= $img ?>" alt="<?=$nom?>" class="avatar-img rounded-circle border border-white">

										</div>

										<div class="user-data mt-3">

											<span class="name " ><?=$fire['nom_membre'].' '.$fire['prenom_membre'].' ('.$fire['tele_membre'].' )'?></span>

										</div>
									</div>
								
								</div>
								</div>
								<?php } ?>
							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="tab-pane fade" id="tasks" role="tabpanel">

			<div class="quick-wrapper tasks-wrapper">

				<div class="tasks-scroll scrollbar-outer">

					<div class="tasks-content">

					<!-- task content here -->

				</div>

			</div>

		</div>
		</div>

		<div class="tab-pane fade" id="settings" role="tabpanel">

			<div class="quick-wrapper settings-wrapper">

				<div class="quick-scroll scrollbar-outer">

					<div class="quick-content settings-content">


						<!-- settings here -->

				</div>

			</div>

		</div>

	</div>

</div>

</div>

<?php } ?>