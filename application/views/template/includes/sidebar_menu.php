<div class="sidebar sidebar-style-2">			

<div class="sidebar-wrapper scrollbar scrollbar-inner">

	<div class="sidebar-content">

		<div class="user">

			<?php 

					$memb=$this->Model->readOne('membre', ['id_membre'=> $this->session->userdata('memberid')]);

				?>

			<div class="avatar-sm float-left mr-2">

				<?php
        $img = '';

        if (!empty($memb['photo_membre'])) { 

         $img=base_url('assets/photo/profile/').$memb['photo_membre'];
         $nom=$memb['nom_membre'];
        }else{ 
         $img=base_url('assets/photo/profile/profile.jpg');
         $nom='No Image';
        }  

        ?>
         <center>
          <img class="media-object rounded-circle thumb-sm" alt="<?=$nom?>" src="<?= $img ?>" style="width: 40px; height: 40px">
        </center>


			</div>

			<div class="info">

				<a data-toggle="collapse" href="#collapseExample" aria-expanded="true" style="margin-left: 60px;">

					<span>

						<?= $this->session->userdata('prenom') ?>
						<span class="user-level"><?=lang('utilisateur')?></span>

						<span class="caret"></span>

					</span>

				</a>

				<div class="clearfix"></div>



				<div class="collapse in" id="collapseExample">

					<ul class="nav">

						<li>

							<a href="<?= base_url('membre/Membre/Profile')?>">

								<span class="link-collapse"><?=lang('mon_profil')?></span>

							</a>

						</li>

						<li>

							<a href="<?= base_url('membre/Membre/Profile')?>">

								<span class="link-collapse"><?=lang('edit_profil')?></span>

							</a>

						</li>

					</ul>

				</div>

			</div>

		</div>

		<ul class="nav nav-primary">

			<li class="nav-item <?php if($this->current_cm->current_class()=='dashboard') echo 'active';?>">

				<a href="<?= base_url('dashboard/Dashboard_Main')?>">

					<i class="fas fa-home" style="color:#0080ff"></i>

					<p><?=lang('dashbord')?></p>

				</a>

				

			</li>

			<li class="nav-item <?php if($this->current_cm->current_class()=='profile') echo 'active';?>">

				<a href="<?=base_url('membre/Membre/Profile/')?>">

					<i class="fas fa-layer-group" style="color:#0080ff"></i>

					<p><?=lang('profil')?></p>

				</a>

				

			</li>

			

			<li class="nav-item <?php if($this->current_cm->current_class()=='membre_info') echo 'active';?>">

				<a data-toggle="collapse" href="#forms">

					<i class="fas fa-users" style="color:#0080ff"></i>

					<p><?=lang('membres')?></p>

					<span class="caret"></span>

				</a>

				<div class="collapse" id="forms">

					<ul class="nav nav-collapse">

							<a href="<?=base_url('admin/Dashboard/Active_Network/')?>">

								<span class="sub-item">
									<i class="fas fa-network-wired" style="color:#0080ff"></i>
									<?=lang('reseau_actif')?>
										
									</span>

							</a>
<?php               if ($this->session->userdata('id_niveau')==1) {     ?>
	                   

						  <a href="<?=base_url('admin/Dashboard/Waiting_list')?>">

							<span class="sub-item">
								<i class="fa fa-spinner fa-spin" style="color:#0080ff"></i>
								<?=lang('liste_d_attente')?></span>

						  </a>
<?php } ?>

						
					</ul>

				</div>

			</li>

			<li class="nav-item <?php if($this->current_cm->current_class()=='cadeaux') echo 'active';?>">

				<a data-toggle="collapse" href="#tables">

					<i class="fas fa-gifts" style="color:#0080ff"></i>

					<p><?=lang('cadeaux')?></p>

					<span class="caret"></span>

				</a>

				<div class="collapse" id="tables">

					<ul class="nav nav-collapse">

							<a href="<?=base_url('cadeau/Graine/')?>">

								<span class="sub-item">
									<i class="fas fa-donate" style="color:#0080ff"></i>
									<?=lang('semence')?>
								</span>

							</a>


							<a href="<?=base_url('cadeau/Recolte/')?>">

								<span class="sub-item">
								<i class="fa fa-gift" aria-hidden="true" style="color:#0080ff"></i>
									<?=lang('recolter')?>
										
									</span>

							</a>

							<a href="<?=base_url('cadeau/Donation/')?>">

								<span class="sub-item">
									<i class="fa fa-money-bill-alt" style="color:#0080ff"></i>
									<?=lang('donation')?>
										
									</span>

							</a>


					</ul>

				</div>

			</li>


			<li class="nav-item <?php if($this->current_cm->current_class()=='activite') echo 'active';?>">

				<a href="<?=base_url('membre/Activity')?>">

					<i class="fas fa-chart-bar" style="color:#0080ff"></i>

					<p><?=lang('activite')?></p>

				</a>

			</li>

			<li class="nav-item">

				<a href="<?=base_url('admin/Users_Support')?>" >

					<i class="fas fa-envelope" style="color:#0080ff"></i>

					<p><?=lang('aide_support')?>&nbsp;&nbsp;<b id="notif"></b></p>

				</a>

			</li>
			
		<li class="nav-item <?php if($this->current_cm->current_class()=='boutique' || $this->current_cm->current_class()=='annonce' || $this->current_cm->current_class()=='crowdFunding' || $this->current_cm->current_class()=='projet') echo 'active';?>">

				<a data-toggle="collapse" href="#projet">

					<i class="fas fa-tasks" style="color:#0080ff"></i>

					<p><?=lang('projet')?></p>

					<span class="caret"></span>

				</a>

				<div class="collapse" id="projet">

					<ul class="nav nav-collapse">

						

							<a href="<?=base_url('boutique/Boutique')?>">

								<span class="sub-item"><i class="fas fa-shopping-cart" style="color:#0080ff"></i>Umoja Boutique
								</span>

							</a>

							<a href="<?= base_url('annonce/Annonce')?>">

								<span class="sub-item">
									<i class="fas fa-book-open" style="color:#0080ff"></i>
									Petites annonces
								</span>

							</a>



							<a href="<?= base_url('crowdFunding/CrowdFunding')?>">

							<span class="sub-item">
								<i class="fas fa-hands-helping" style="color:#0080ff"></i>
								Umoja Crowdfunding
							</span>

							</a>

							<a href="<?= base_url('projet/Projet')?>">

							<span class="sub-item">
								<i class="fas fa-donate" style="color:#0080ff"></i>
								Umoja Charity
							</span>

							</a>
							<a href="<?= base_url('mastercard/Mastercard')?>">

							<span class="sub-item">
								<i class="fa fa-cc-visa fa-4x" style="color:#0080ff"></i>
								Visa MasterCard
							</span>

							</a>

					</ul>

				</div>

			</li>






			<li class="nav-item">

				<a href="<?= base_url('Login/do_logout')?>">

					<i class="fas fa-sign-out-alt" style="color:#0080ff"></i>

					<p> <?=lang('logout')?></p>

				</a>

			</li>

		</ul>

	</div>

</div>

</div>