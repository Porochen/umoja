<?php include VIEWPATH.'template/includes/admin_header.php';?>

    <!-- Sidebar -->

<?php include VIEWPATH.'template/includes/admin_menu.php';?>

    <!-- End Sidebar -->



    <div class="main-panel">

      <div class="container">

        <div class="panel-header bg-primary-gradient">

          <div class="page-inner py-3">

            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

              <div class="ml-md-auto py-2 py-md-0">

              <!-- PAGE-HEADER -->

              <div class="page-header">

                <ol class="breadcrumb">

                  <li class="breadcrumb-item">

                    <a href="#">Home</a>

                  </li>

                  <li class="breadcrumb-item">

                      <a href="#">Administrateurs</a>

                  </li>

                  <li class="breadcrumb-item active" aria-current="page">

                    Liste

                  </li>

                </ol>

              </div>

                            <!-- PAGE-HEADER END -->

              </div>

            </div>

          </div>

        </div>





     <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title"><h3>Modifier un administrateur<a href="<?=base_url('administrateurs/Administrateurs')?>" class="btn btn-primary btn-sm float-right text-white"><i class="fa fa-list"></i>Liste</a></h3></div>
         <div id="message_succ"></div>
          <form id="formadmin" onsubmit="return false;" enctype="multipart/form-data">
            <div class="row">
               <input type="hidden" class="form-control" name="id_admin" value="<?=$admin['id_admin']?>">
              <div class="col-6">
                <div class="form-group">
                  <label>Nom</label>
                  <input type="text" class="form-control" value="<?=$admin['nom_admin']?>" name="nom">
                </div>
                <div class="form-group">
                  <label>Téléphone</label>
                  <input type="text" class="form-control" value="<?=$admin['phone_admin']?>" name="phone">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Prénom</label>
                  <input type="text" class="form-control" value="<?=$admin['prenom_admin']?>" name="prenom">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" readonly="" class="form-control" value="<?=$admin['email_admin']?>" name="email" id="email">
                </div>
                <div class="form-group">
                  <label></label>
                  <button type="button" class="btn btn-primary mt-4 mt-sm-0 btn-icon-text" onclick="update()">
                  <i class="fa fa-save"></i> Modifier </button>
                </div>
              </div>
            </div>
        </form>
        </div>
      </div>
    </div>


  

<?php include VIEWPATH.'template/includes/footer.php';?>

    
      
<script type="text/javascript">
  function update(){
          var id_admin=$('[name="id_admin"]').val();
          var nom=$('[name="nom"]').val();
          var prenom=$('[name="prenom"]').val();
          var email=$('[name="email"]').val();
          var phone=$('[name="phone"]').val();

          if (nom!='' && prenom!='' && phone!='' && email!='') {

              $.ajax({

                url:'<?= base_url()?>administrateurs/Administrateurs/update',

                type:'post',
                dataType: "json",
                data:{nom:nom,prenom:prenom,email:email,id_admin:id_admin,phone:phone},

                success:function(data){

                    $('#formadmin').get(0).reset()

                   $('#message_succ').html(data);
                     setInterval(function(){ 

                      window.location.href='<?= base_url() ?>administrateurs/Administrateurs';

                   }, 2000);
                }

              })

          }else if(nom==''){

             $('[name="nom"]').focus();

             $('[name="nom"]').css('border-color','red');

          }else if(prenom==''){

             $('[name="prenom"]').focus();

             $('[name="prenom"]').css('border-color','red');

             $('[name="nom"]').css('border-color','');

          }else if(phone==''){

             $('[name="phone"]').focus();

             $('[name="phone"]').css('border-color','red');

             $('[name="nom"]').css('border-color','');

             $('[name="prenom"]').css('border-color','');


          }else if(email==''){

             $('[name="email"]').focus();

             $('[name="email"]').css('border-color','red');

             $('[name="nom"]').css('border-color','');

             $('[name="prenom"]').css('border-color','');


          }

        }

  $(document).ready(function(){
   $('#message').delay('slow').fadeOut(5000);
 });

</script>