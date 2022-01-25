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
                <h2 class="text-white pb-2 fw-bold">Tableau de bord</h2>
                <a href="javascript:void(0)" class="btn btn-info text-white" data-toggle="modal" data-target="#excel_data">
                  <!-- <i class="fa fa-file-excel"> -->
                  Fichier Excel
                </a>
              </div>
              <div class="ml-md-auto py-2 py-md-0">
              <!-- PAGE-HEADER -->
              <div class="page-header">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Accueil</a>
                  </li>
                  <li class="breadcrumb-item">
                      <a href="#">Admin</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Tableau de bord
                  </li>
                </ol>
              </div>
                            <!-- PAGE-HEADER END -->
              </div>
            </div>

            <div class="col-md-11 mt-3" id="sms"></div>
          </div>
        </div>
        

        <div class="page-inner mt--5">
          <div class="row mt--2 ">
            <div class="col-md-12">

              <div class="row">

              <div class="col-md-4 col-xl-4">
                <div class="card overflow-hidden">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-7 col-md-6">
                        <h4 class="mb-1 number-font display-5 font-weight-bold text-dark">
                          <?php 
                          $id= $this->session->userdata('memberid');
                          echo $mbr;
                          ?> 
                        </h4>
                      </div>
                      
                      </div>
                      <p class="mb-0 text-muted text-center">
                          <span class="mb-0 text-success fs-13 ">
                            Nombre des membres actuels
                          </span>
                        </p>
                    </div>
                  </div>
                </div>
            
             <div class="col-md-4 col-xl-4">
                <div class="card overflow-hidden">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-7 col-md-6">
                        <h4 class="mb-1 number-font display-5 font-weight-bold text-dark text-center">
                         <?= $parent;?>                  
                         </h4>
                       
                      </div>
                      <div class="col-5 col-md-6">
                      </div>
                       <p class="mb-0 text-muted text-center">
                          <span class="mb-0 text-success fs-13 ">
                            Nombre de parents actuels
                          </span>
                        </p>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-md-4 col-xl-4">
                <div class="card overflow-hidden">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-7 col-md-6">
                        <h4 class="mb-1 number-font display-5 font-weight-bold text-dark">
                         <?=$water;?>                       
                        </h4>
                        
                      </div>
                      <div class="col-5 col-md-6">
                      
                      </div>
                       <p class="mb-0 text-muted text-center">
                          <span class="mb-0 text-success fs-13 ">
                            Nombre des waters actuels
                          </span>
                        </p>
                    </div>
                  </div>
                </div>
              </div>
              </div>

               

            </div>
           

      
        <!--End ROW-4 -->
        </div>
  </div>







        <div class="page-inner mt--5">
          <div class="row mt--2 ">
            <div class="col-md-12">

              <div class="row">

              <div class="col-md-2" style="background-color:#C0C0C0">
                <div class="card overflow-hidden">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-7 col-md-6">
                        <h4 class="mb-1 ">
                          <?php 
                          
                          echo $argent;
                          ?> 
                        </h4>
                      </div>
                      
                      
                      <p class="mb-0 text-muted text-center">
                          <span class="mb-0 text-success fs-13 ">
                            Nombre total <br>(ARGENT)
                          </span>
                        </p>
                    </div>
                    </div>
                  </div>
                </div>
            
             <div class="col-md-2" style="background-color:#614e1a">
                <div class="card overflow-hidden">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 col-md-6">
                        <h4 class="mb-1  text-center">
                         <?= $bronze;?>                  
                         </h4>
                       
                      </div>
                      <div class="dropdown-divider">
                      </div>
                       <p class="mb-0 text-muted text-center">
                          <span class="mb-0 text-success fs-13 ">
                            Nombre total <br>(BRONZE)
                          </span>
                        </p>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-md-2" style="background-color:#ffd700">
                <div class="card overflow-hidden">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 col-md-6">
                        <h4 class="mb-1 ">
                         <?=$or;?>                       
                        </h4>
                        
                      </div>
                      <div class="dropdown-divider">
                      
                      </div>
                       <p class="mb-0 text-muted text-center">
                          <span class="mb-0 text-success fs-13 ">
                            Nombre total <br>(OR)
                          </span>
                        </p>
                    </div>
                  </div>
                </div>
              </div>


               <div class="col-md-2" style="background-color:#6977a1">
                <div class="card overflow-hidden">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 col-md-6">
                        <h4 class="mb-1 ">
                         <?=$saphir;?>                       
                        </h4>
                        
                      </div>
                      <div class="dropdown-divider">
                      
                      </div>
                       <p class="mb-0 text-muted text-center">
                          <span class="mb-0 text-success fs-13 ">
                            Nombre total <br>(SAPHIR)
                          </span>
                        </p>
                    </div>
                  </div>
                </div>
              </div>
               <div class="col-md-2" style="background-color:#cee4e6">
                <div class="card overflow-hidden">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 col-md-6">
                        <h4 class="mb-1 ">
                         <?=$diamand;?>                       
                        </h4>
                        
                      </div>
                      <div class="dropdown-divider">
                      
                      </div>
                       <p class="mb-0 text-muted text-center">
                          <span class="mb-0 text-success fs-13 ">
                            Nombre total <br>(DIAMANT)
                          </span>
                        </p>
                    </div>
                  </div>
                </div>
              </div>
              </div>

               

            </div>
           

      
        <!--End ROW-4 -->
        </div>
  </div>



<!-- Footer --> 
<?php include VIEWPATH.'template/includes/footer.php';?>
<!-- End Footer --> 





<!-- MESSAGE MODAL FOR EXCEL DATA-->
    <div class="modal fade"  backdrop="static" id="excel_data" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="" onsubmit="return false" id="form_member" class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="example-Modal3">
                      Voulez-vous ajouter les données a partir d'excel ?
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
<!--                 <div class="modal-body">
                  
                </div> -->
                <div class="modal-footer">
                  <form method="post" id="import_form" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-8">
                        <label>Select Excel File</label>
                        <input type="file" name="file" class="form-control" id="file" accept=".xls, .xlsx,.ods" />
                        <font class="text-danger" id="file_error"></font>
                      </div>
                      <div class="col-md-4 mt-4">
                        <input type="submit" class="form-control btn btn-primary" name="import" id="import" value="Importer" onclick="excel_import()" class="btn btn-info" />
                        <div class="mt-2" id="loading"></div>
                      </div>
                    </div>
                  </form>  
                </div>
            </form>
        </div>
    </div>



    <script>

      $(document).ready(function(){
        $('#sms').delay(5000).hide('slow');
      })
      function excel_import(){
       if( document.getElementById("file").files.length == 0 ){
          $('#file_error').html('le champ est obligatoire') 
       }else{
      var file=document.getElementById('file').files[0];
      let form=new FormData();
          form.append('file',file);
    $.ajax({
      url:"<?php echo base_url(); ?>excel_import/Excel_Import/index",
      method:"POST",
      data:form,
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function () { 
              $('#import').hide()
              $('#loading').html('<center>'+
                '<img src="<?= base_url('assets/photo/logo/Settings.gif')?>" style="height:30px;width: 30px;"> Loading...</center>'); 
            },
      success:function(data){
        $('#import').show();
        $('#loading').hide();
        $('#file').val('');
        $('#excel_data').modal('hide');
        $('#sms').html(data);
        setInterval(function(){
              window.location.href='<?= base_url()?>admin/Admin';
         },100);
      }

    })

    }
    }
    </script>