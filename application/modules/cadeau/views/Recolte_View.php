<?php include VIEWPATH.'template/includes/header.php';?>

<!-- Sidebar -->

<?php include VIEWPATH.'template/includes/sidebar_menu.php';?>

<!-- End Sidebar -->



<div class="main-panel">

 <div class="container">

  <div class="panel-header bg-primary-gradient">

   <div class="page-inner py-3">

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

     <div>

      <h2 class="text-white pb-2 fw-bold">

     <?=lang('recolter')?>  

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

         <a href="#"><?=lang('membres')?></a>

        </li>

        <li class="breadcrumb-item active" aria-current="page">

         <?=lang('recolter')?>

        </li>

       </ol>

      </div>

      <!-- PAGE-HEADER END -->

     </div>

    </div>

   </div>

  </div>





      <div>

          <?php if(!empty($this->session->flashdata('sms'))){   

            echo $this->session->flashdata('sms'); } 

         ?>

      </div>





  <div class="page-inner mt-5">


<div class="row mt--5 ml-3">

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  
<?php
      $i=0;
      $total=count($total_niveau);

      foreach ($total_niveau as $value) { ?>
        <li class="nav-item">
          <a class="nav-link mr-3" id="button<?=$value['id_niveau']?>" data-toggle="pill" href="javascript:void(0)" onclick="getData(<?=$value['id_niveau']?>,<?=$total?>)" role="tab" aria-controls="pills-home" aria-selected="true">
            <?=$value['niveau_desc']?>
          </a>
        </li>

<?php  } ?>

  </ul>
</div> 

<input type="hidden" value="<?=$total?>" name="total">
<input type="hidden" value="<?=$id_niveau?>" name="niveau_actuel">
<div class="col-md-12 mt-3" id="get_data"></div>

    </div>
   </div>
 </div>


  <?php include VIEWPATH.'template/includes/footer.php';?>





<script type="text/javascript">

$(document).ready(function(){

  var id_niveau=$('#niveau_actuel').val()
  var total=$('#total').val()
  getData(id_niveau,total);
})

function getData(id_niveau=0,total=0){
  var id_niveau=id_niveau;
  var total=total;

for (var i = total- 1; i >= 0; i--) {


  if (i==id_niveau) {
    document.getElementById('button'+id_niveau).className = "nav-link active mr-3";
  }else{
   document.getElementById('button'+id_niveau).className = "nav-link mr-3";
  }

}
  
  $.ajax({
    url:'<?= base_url()?>cadeau/Recolte/getData',
    type:'post',
    data:{id_niveau:id_niveau},
    beforeSend:function () { 
              $('#get_data').html("<br><div class='col-lg-12'><center><font style='font-size:46px'><i class='fa fa-46px fa-spin fa-spinner'></i><span class='sr-only'>Loading...</span></font></center></div>");
            },
      error:function() {
          $('#get_data').html('<div class="alert alert-danger col-md-12"><h6 class="text-center">Error: reessayer encore ! </h6></div>');
      },
    success:function(data){
      $('#get_data').html(data)
    }
  })
}


</script>


























