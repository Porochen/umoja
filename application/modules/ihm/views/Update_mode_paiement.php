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
                <h2 class="text-white pb-2 fw-bold">Paiement</h2>
              </div>
              <div class="ml-md-auto py-2 py-md-0">
              <!-- PAGE-HEADER -->
              <div class="page-header">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Paiement</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Editer
                  </li>
                </ol>
              </div>
                            <!-- PAGE-HEADER END -->
              </div>
            </div>
          </div>
        </div>

        <div class="card-body tdy-appoin">

         <form action="<?= base_url('index.php/ihm/Mode_paiement/update/'.$paiem['id_mode_paiement'])?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-4">
              <label>CODE</label> 
              <input name="code_mode_paiement"  value="<?=$paiem['code_mode_paiement']?>" class="form-control" >
                 <font class="text-danger">
               <?=form_error('code_mode_paiement')?>
               </font>
            </div>
            <div class="col-md-4">
              <label>DESCRIPTION</label> 
              <input name="description_mode"  value="<?=$paiem['description_mode']?>" class="form-control" >
                 <font class="text-danger">
               <?=form_error('description_mode')?>
               </font>
            </div> 
            <div class="col-md-4">
              <label>IMAGE</label> 
              <input type="file" name="img" class="form-control"  required="">
            </div>
          
              
              <div class="col-md-4 mt-4">
              <input type="submit" class="btn btn-primary form-control " value="Editer">
            </div>
         </form> 
        </div> 
      </div>
    </div>
<!-- Footer --> 
<?php include VIEWPATH.'template/includes/footer.php';?>
<!-- End Footer -->

