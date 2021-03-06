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

								Remplacement des membres

							   </h2>

							</div>

							<div class="ml-md-auto py-2 py-md-0">

							<!-- PAGE-HEADER -->

							<div class="page-header">

								<ol class="breadcrumb">

									<li class="breadcrumb-item">

										<a href="#">Home</a>

									</li>

                  <li class="breadcrumb-item">

                      <a href="#">Admin</a>

                  </li>

									<li class="breadcrumb-item active" aria-current="page">

										Remplacement

									</li>

								</ol>

							</div>

                            <!-- PAGE-HEADER END -->

							</div>

						</div>

					</div>

				</div>



        <!-- code here -->
<div class="container pt-3">
<div class="row mb-3">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body p-t-0">
                    <div class="input-group">
                        <input type="text" onkeyup="getList(this.value)" autocomplete="off" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Recherche">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div id="get_members">   

   </div>



        </div>

        </div>





    
    <!-- MESSAGE MODAL CLOSED -->
   

<!-- Footer -->	

<?php include VIEWPATH.'template/includes/footer.php';?>

<!-- End Footer -->	

  <script>
  $(document).ready(function(){
   getList(critere="",page=0);
});

  $(document).on('click','.page-item',function(){
    var page=$(this).attr('id');
    var critere=$('#search').val();
    getList(critere,page);
})

</script>

<script>
    function getList(critere="",page=0){

       $.ajax({
        url: "<?=base_url('admin/Remplacement/listing/');?>"+critere,
        type: "POST",
        dataType: 'JSON',
        data:{critere:critere,page:page},
        beforeSend:function () { 
              $('#get_members').html("<br><div class='col-lg-12'><center><font style='font-size:46px'><i class='fa fa-46px fa-spin fa-spinner'></i><span class='sr-only'>Loading...</span></font></center></div>");
            },
      error:function() {
          $('#get_members').html('<div class="alert alert-danger col-md-12"><h6 class="text-center">Error: reessayer encore ! </h6></div>');
      },
      success: function(data){

          $('#get_members').html(data);
          }
      }); 
   }

</script> 



<script>

     function new_fire(id_mbr){

      var id_membre=$('[name="id_membre'+id_mbr+'"]').val();

      var nom_membre=$('[name="nom_membre'+id_mbr+'"]').val();

      var prenom_membre=$('[name="prenom_membre'+id_mbr+'"]').val();

      var email_membre=$('[name="email_membre'+id_mbr+'"]').val();

      var tele_membre=$('[name="tele_membre'+id_mbr+'"]').val();

      var motif=$('[name="motif'+id_mbr+'"]').val();


      var PHOTO = document.getElementById("PHOTO"+id_mbr).files[0];
      var file = document.getElementById("PHOTO"+id_mbr);


      var code=$('[name="code'+id_mbr+'"]').val();

      var form = new FormData();
      form.append('PHOTO',PHOTO);
      form.append('id_membre',id_membre);
      form.append('nom_membre',nom_membre);
      form.append('prenom_membre',prenom_membre);
      form.append('email_membre',email_membre);
      form.append('tele_membre',tele_membre);
      form.append('motif',motif);
      form.append('code',code);



      if (nom_membre!='' && prenom_membre!='' && email_membre!='' && tele_membre!='' && code!='' && motif!='' && file!='') {

       $('[name="code'+id_mbr+'"]').css('border-color','');

       $.ajax({

        url:'<?= base_url()?>admin/Remplacement/replaceOne',

        type : "POST",
        dataType: "JSON",
        data: form,
        processData: false,
        contentType: false,

        success:function(data){

         $('#form_member'+id_mbr).get(0).reset()

         $('#newMember'+id_mbr).modal('hide');

         $('#message_rps'+id_mbr).html(data);

         setInterval(function(){ 



          window.location.href='<?= base_url() ?>admin/Remplacement';



         }, 2000);

        }

       })

      }else if(nom_membre==''){

       $('[name="nom_membre'+id_mbr+'"]').focus();

       $('[name="nom_membre'+id_mbr+'"]').css('border-color','red');

      }else if(prenom_membre==''){

       $('[name="prenom_membre'+id_mbr+'"]').focus();

       $('[name="prenom_membre'+id_mbr+'"]').css('border-color','red');

       $('[name="nom_membre'+id_mbr+'"]').css('border-color','');

      }else if(email_membre==''){

       $('[name="email_membre'+id_mbr+'"]').focus();

       $('[name="email_membre'+id_mbr+'"]').css('border-color','red');

       $('[name="nom_membre'+id_mbr+'"]').css('border-color','');

       $('[name="prenom_membre'+id_mbr+'"]').css('border-color','');

      }else if(tele_membre==''){

       $('[name="tele_membre'+id_mbr+'"]').focus();

       $('[name="tele_membre'+id_mbr+'"]').css('border-color','red');

       $('[name="nom_membre'+id_mbr+'"]').css('border-color','');

       $('[name="prenom_membre'+id_mbr+'"]').css('border-color','');

       $('[name="email_membre'+id_mbr+'"]').css('border-color','');

      }else if(motif==''){

       $('[name="motif'+id_mbr+'"]').focus();

       $('[name="motif'+id_mbr+'"]').css('border-color','red');

       $('[name="nom_membre'+id_mbr+'"]').css('border-color','');

       $('[name="prenom_membre'+id_mbr+'"]').css('border-color','');

       $('[name="email_membre'+id_mbr+'"]').css('border-color','');
       $('[name="tele_membre'+id_mbr+'"]').css('border-color','');

      }else if(img==''){

       $('[name="img'+id_mbr+'"]').focus();

       $('[name="img'+id_mbr+'"]').css('border-color','red');

       $('[name="nom_membre'+id_mbr+'"]').css('border-color','');

       $('[name="prenom_membre'+id_mbr+'"]').css('border-color','');

       $('[name="email_membre'+id_mbr+'"]').css('border-color','');
       $('[name="tele_membre'+id_mbr+'"]').css('border-color','');
       $('[name="motif'+id_mbr+'"]').css('border-color','');


      }else if(code==''){

       $('[name="code'+id_mbr+'"]').focus();

       $('[name="code'+id_mbr+'"]').css('border-color','red');

       $('[name="nom_membre'+id_mbr+'"]').css('border-color','');

       $('[name="prenom_membre'+id_mbr+'"]').css('border-color','');

       $('[name="email_membre'+id_mbr+'"]').css('border-color','');

       $('[name="email_membre'+id_mbr+'"]').css('border-color','');

      }

     }





     function send_mail(id_mbr){

      var nom_membre=$('[name="nom_membre'+id_mbr+'"]').val();

      var prenom_membre=$('[name="prenom_membre'+id_mbr+'"]').val();

      var email_membre=$('[name="email_membre'+id_mbr+'"]').val();

      $.ajax({

       url:'<?= base_url()?>admin/Admin/send_mail',

       type:'post',

       data:{email_membre:email_membre,nom_membre:nom_membre,prenom_membre:prenom_membre},

       success:function(data){

        $('#message_code'+id_mbr).html(data);

       }

      })

     }

    </script>