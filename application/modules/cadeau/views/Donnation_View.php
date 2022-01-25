<?php include VIEWPATH.'template/includes/header.php';?>
<!-- Sidebar -->
<?php include VIEWPATH.'template/includes/sidebar_menu.php';?>
<!-- End Sidebar -->

<div class="main-panel">
 <div class="container">




  <div class="panel-header bg-primary-gradient">
   <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
     <div>
      <h2 class="text-white pb-2 fw-bold">
       <?=lang('donation')?>
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
         <a href="#"><?=lang('cadeaux')?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
         <?=lang('donation')?>
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
        
    <div id="list"></div>
     
    </div><!-- COL-END -->
   </div>
   <!-- ROW CLOSED -->
  </div>
  <!-- CONTAINER CLOSED -->
 </div>




 <!-- Footer -->	
 <?php include VIEWPATH.'template/includes/footer.php';?>
 <!-- End Footer -->	















 <!-- MESSAGE MODAL -->
 <div class="modal fade" id="donation" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form method="post" action="<?=base_url('cadeau/Donation/paiement')?>" enctype="multipart/form-data" class="modal-content">
    <div class="modal-header">
     <h5 class="modal-title" id="example-Modal3"><?=lang('pay_admin_fees')?></h5>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
     </button>
    </div>
    <div class="modal-body">

     <div class="form-group">
      <label class="form-label"><?=lang('methode_de_paiement_prefere')?></label>
     <select name="preferred" class="form-control" required>
       <option value="" selected><?=lang('choisir')?></option>
       <?php  foreach ($mode_paiement as $key) { ?>
        <option value="<?=$key['id_mode_paiement']?>" ><?=$key['description_mode']?></option>

      <?php  } ?>
      </select>
     </div>
     <div class="form-group">
      <label class="form-label"><?=lang('details')?></label> 
      <textarea class="form-control" name="details" required rows="3"></textarea>
     </div>
     <div class="form-group">
      <label class="form-label"><?=lang('preuve_payement')?></label>
      <input type="file" accept="image/*" class="form-control" required name="proof">
     </div>
    </div>
    <div class="modal-footer">
     <button type="submit" class="btn btn-primary">Pay Now</button>
    </div>
   </form>
  </div>
 </div>










 <!-- MESSAGE MODAL CLOSED -->

<script>
  $(document).ready(function(){
   getList()
});
</script>

<script>
    function getList(){

       $.ajax({
        url: "<?=base_url('cadeau/Donation/listing/');?>",
        type: "POST",
        dataType: 'JSON',
        processData: false,  
        contentType: false,
      error:function() {
          $('#list').html('<div class="alert alert-danger col-md-12"><h6 classtext-center>Erreur : Veuillez réessayer ! </h6></div>');
      },
      success: function(data){

          $('#list').html(data);
          }
      }); 
   }

</script> 