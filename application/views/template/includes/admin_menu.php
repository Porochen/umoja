<div class="sidebar sidebar-style-2">			

<div class="sidebar-wrapper scrollbar scrollbar-inner">

	<div class="sidebar-content">

		<div class="user">

			<?php 

					$memb=$this->Model->readOne('membre', ['id_membre'=> $this->session->userdata('memberid')]);



                $img = '';



                if (!empty($memb['photo_membre'])) { 



                $img='

                 <img width="50" height="50" src="'.base_url('assets/photo/Profile/').$memb['photo_membre'].'" alt="Image" style="border-radius: 50%" >';

                    }else{ 

                $img='<center>

                     <font color="#aeb1b3" style="font-size: 35px"><i class="fa fa-user"></i></font>

                   </center>';

                 }  



				?>

			<div class="avatar-sm float-left mr-2">

				<?= $img ?>

			</div>

			<div class="info">

				<a data-toggle="collapse" href="#collapseExample" aria-expanded="true" style="margin-left: 60px;">

					<span>

						<?= $this->session->userdata('prenom') ?>

						<span class="user-level">Admin</span>

						<!-- <span class="caret"></span> -->

					</span>

				</a>

				<div class="clearfix"></div>

			</div>

		</div>

		<ul class="nav nav-primary">

			<li class="nav-item active">

				<a href="<?= base_url('admin/Admin')?>">

					<i class="fas fa-home" style="color:#0080ff"></i>

					<p>Dashboard</p>

				</a>

				

			</li>

			

			<li class="nav-item">

				<a data-toggle="collapse" href="#forms">

					<i class="fas fa-users" style="color:#0080ff"></i>

					<p>Membres</p>

					<span class="caret"></span>

				</a>

				<div class="collapse" id="forms">

					<ul class="nav nav-collapse">


						<li>

							<a href="<?=base_url('admin/Users')?>">

								<span class="sub-item">Tous les membres</span>

							</a>

						</li>

						<li>

							<a href="<?=base_url('admin/Waters')?>">

								<span class="sub-item">Waters</span>

							</a>

						</li>

						<li>

							<a href="<?=base_url('admin/Parents')?>">

								<span class="sub-item">Parents</span>

							</a>

						</li>

						<li>

							<a href="<?=base_url('admin/Code_Verification')?>">

								<span class="sub-item">Codes</span>

							</a>

						</li>

					</ul>

				</div>

			</li>

		

			<li class="nav-item">

				<a href="<?=base_url('admin/Niveau')?>">

					<i class="fa fa-step-forward" style="color:#0080ff"></i>

					<p>Niveau</p>

				</a>

			</li>
			<li class="nav-item">

				<a href="<?=base_url('ihm/Mode_paiement')?>">

					<i class="fas fa-money-bill-alt" style="color:#0080ff"></i>

					<p>Mode Paiement</p>

				</a>

			</li>
			<li class="nav-item">

				<a href="<?=base_url('cadeau/Donation/approver_donation')?>">

					<i class="fa fa-credit-card" style="color:#0080ff"></i>

					<p>Frais d'admin</p>

				</a>

			</li>
			<li class="nav-item">

				<a href="<?=base_url('admin/Remplacement')?>">

					<i class="fa fa-edit" style="color:#0080ff"></i>

					<p>Remplacement</p>

				</a>

			</li>

			<li class="nav-item">

				<a href="<?=base_url('admin/Remplacement/histo_replace')?>">

					<i class="fas fa fa-history" style="color:#0080ff"></i>

					<p>Historique remplacement</p>

				</a>

			</li>

			<li class="nav-item">

				<a href="<?=base_url('admin/Tracabilite')?>">

					<i class="fas fa-info-circle" style="color:#0080ff"></i>

					<p>Tracabilité</p>

				</a>

			</li>
			<li class="nav-item">

				<a href="<?=base_url('admin/Admin_Support/compose')?>">

					<i class="fas fa-envelope" style="color:#0080ff"></i>

					<p>Aide & support&nbsp;<b id="notif"></b></p>

				</a>

			</li>
			<li class="nav-item">

				<a href="<?=base_url('settings/Settings')?>">

					<i class="fa fa-cog" style="color:#0080ff"></i>

					<p>Settings</p>

				</a>

			</li>
			<?php if ($this->session->userdata('memberid')==1) {
				?>
			<li class="nav-item">

				<a href="<?=base_url('administrateurs/Administrateurs')?>">

					<i class="fa fa-user" style="color:#0080ff"></i>

					<p>Administrateurs</p>

				</a>

			</li>
		<?php } ?>
			<li class="nav-item">

				<a href="<?= base_url('Login/admin_do_logout')?>">

					<i class="fas fa-sign-out-alt" style="color:#0080ff"></i>

					<p> Logout</p>

				</a>

			</li>

		</ul>

	</div>

</div>

</div>