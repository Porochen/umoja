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
       Settings
      </h2>
     </div>
     <div class="ml-md-auto py-2 py-md-0">
      <!-- PAGE-HEADER -->
      <div class="page-header">
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
         <a href="#">Acceuil</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
         Settings
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

   <div class="row row-cards">
    <div class="col-lg-12 col-xl-12">
        
   




<div class="content-page">
    <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
          <div class="card card-block card-stretch card-height">
           <div class="card-header d-flex justify-content-between">
            <div class="header-title">
             <h4 class="card-title">Settings</h4>
         </div>
     </div>
     <div class="card-body rec-pat">


        <div class="container-fluid">
          <div class="row">

            <div class="col-sm-6 col-md-6">
                <div class="panel panel-success col-h">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-heading">Logo de l'application</div>
                        </div>
                       
                    </div>

                    <form accept-charset="utf-8" method="post" enctype="multipart/form-data" action="<?= base_url('settings/Settings/update_logo')?>">
                        <div class="row">
                            <div class="row">

                            <div class="col-md-3 ">
                            <center><button type='button' class='btn btn-xs text-center' data-toggle='modal' data-target='#photo'></i><img src="<?= base_url() ?>/assets/photo/settings_images/<?=$logo?>" alt="Logo non trouvé." class="img-responsive" style="height: 60px;width: 60px;"></button></center>
                        </div>
                            <div class="col-md-9">
                                <input type="file" required=""  class="form-control" name="sitelogo" size="20" />
                            </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <input type="submit" value="Charger une nouvelle" class="btn btn-outline-primary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-sm-6 col-md-6">
                <div class="panel panel-success col-h">
                    <div class="panel-heading">Nom de l'application</div>
                    <div class="panel-body">
                        <form method="POST" action="<?= base_url('settings/Settings/update_nameapk')?>">
                           <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" name="name_apk" value="<?= $name_apk;?>" type="text" required="">
                            </div>
                            <div class="col-md-12 mt-4">
                                <input type="submit" value="Modifier"  class="btn btn-outline-primary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><br><br><br><br><br><br><br><br><br><br>

        <div class="col-sm-6 col-md-4">
                <div class="panel panel-success col-h">
                    <div class="panel-heading">Theme de l'application</div>
                    <div class="panel-body">
                        <form method="POST" action="<?= base_url('settings/Settings/update_themeapk')?>">
                           <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" name="theme_apk" value="<?= $theme_apk;?>" type="text" required="">
                            </div>
                            <div class="col-md-12 mt-4">
                                <input type="submit" value="Modifier"  class="btn btn-outline-primary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-success col-h">
                <div class="panel-heading">Frais d'administration</div>
                <div class="panel-body">
                    <form method="POST" action="<?= base_url('settings/Settings/update_admin_fees')?>">
                      <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" name="admin_fees" value="<?= $admin_fees;?>" type="text" required="">
                        </div>
                        <div class="col-md-12 mt-4">
                            <input type="submit" value="Modifier" class="btn btn-outline-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="panel panel-success col-h">
            <div class="panel-heading">Numéro du compte bancaire</div>
            <div class="panel-body">
                <form method="POST" action="<?= base_url('settings/Settings/update_compte_bancaire')?>">
                 <div class="row">
                    <div class="col-md-12">
                        <input class="form-control" name="compte_bancaire" value="<?= $compte_bancaire;?>" type="text" required="">
                    </div>
                    <div class="col-md-12 mt-4">
                        <input type="submit" value="Modifier"  class="btn btn-outline-primary" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-6">
        <div class="panel panel-success col-h">
            <div class="panel-heading">Numéro de support</div>
            <div class="panel-body">
                <form method="POST" action="<?= base_url('settings/Settings/update_support')?>">
                 <div class="row">
                    <div class="col-md-12">
                        <input class="form-control" name="num_support" value="<?= $num_support;?>" type="text" required="">
                    </div>
                    <div class="col-md-12 mt-4">
                        <input type="submit" value="Modifier"  class="btn btn-outline-primary" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-6">
        <div class="panel panel-success col-h">
            <div class="panel-heading">Email de support</div>
            <div class="panel-body">
                <form method="POST" action="<?= base_url('settings/Settings/update_email')?>">
                 <div class="row">
                    <div class="col-md-12">
                        <input class="form-control" name="email_support" value="<?= $email_support;?>" type="text" required="">
                    </div>
                    <div class="col-md-12 mt-4">
                        <input type="submit" value="Modifier"  class="btn btn-outline-primary" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-6">
        <div class="panel panel-success col-h">
            <div class="panel-heading">Phrase d'introduction</div>
            <div class="panel-body">
                <form method="POST" action="<?= base_url('settings/Settings/introduction')?>">
                 <div class="row">
                    <div class="col-md-12">

                        <textarea name="home_word" class="form-control"  type="text" rows="4" cols="50" required=""><?= $home_word;?></textarea>
                    </div>
                    <div class="col-md-12 mt-4">
                        <input type="submit" value="Modifier"  class="btn btn-outline-primary" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="dropdown-divider col-md-12"></div>

<div class="container-fluid">
      <div class="row">
          <article class="col-xs-12 col-sm-12 col-mid-3 col-lg-3"> 
                            
           </article> 
           <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
          
        <form method="post" action="<?=base_url('settings/Settings/reglement/')?>" 
        class="card">
           <div class="card-header">
            <div class="card-title">Reglèment d'ordre intérieur
              
            </div>
            </div>
                <div class="card-body">
                  <div class="row">
                
                 <div class="form-group col-md-12">
                  <label class="form-label">Veuillez saisir le reglèment d'ordre intérieur ici:</label>
                  <textarea required="" id="summernote" cols="50" rows="10" class="form-control" required name="reglement"><?=$reglement?></textarea>
                </div>
            
            </div>
            <div class="card-footer text-right">
                               
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Enregistrer</button>
            </div>
                                
         </form>
        </article>                        
                        
</div>
</div>





</div>
</div>
</div>
</div>
</div>



</div>
<!-- Page end  -->
</div>
</div>

 <div id='photo' class='modal fade'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            
            <div class='modal-body'>
                <center><img style='height: 300px;width: 300px;' src='<?=base_url('assets/photo/settings_images/').$logo ?>' class='img-circle' alt="PAS D'IMAGE"/></center> 
            </div>
        </div>
    </div>
</div>

    </div><!-- COL-END -->
   </div>
   <!-- ROW CLOSED -->
  </div>
  <!-- CONTAINER CLOSED -->
 </div>


 <!-- Footer -->    
 <?php include VIEWPATH.'template/includes/footer.php';?>
 <!-- End Footer -->    















