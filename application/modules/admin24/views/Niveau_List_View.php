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

								Niveau

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

										Niveau

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
        <div class="table-responsive mt-3">   
        <div class="float-left" style="margin-left:15px"><a href="<?=base_url('admin/Niveau/add')?>" class="btn btn-primary"><i class="fa fa-plus"></i>Nouveau</a></div>
         <?=$this->table->generate($data)?>

       </div>



        </div>

        </div>



   

<!-- Footer -->	

<?php include VIEWPATH.'template/includes/footer.php';?>

<!-- End Footer -->	



<script>

  $(document).ready(function(){
    $("#sms").delay(5000).hide('slow');

    $("#mytable").DataTable({

     language: {

      "sProcessing":     "Traitement en cours...",

      "sSearch":         "Rechercher&nbsp;:",

      "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",

      "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",

      "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",

      "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",

      "sInfoPostFix":    "",

      "sLoadingRecords": "Chargement en cours...",

      "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",

      "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",

      "oPaginate": {

        "sFirst":      "Premier",

        "sPrevious":   "Pr&eacute;c&eacute;dent",

        "sNext":       "Suivant",

        "sLast":       "Dernier"

      },

      "oAria": {

        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",

        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"

      }

    },                

    dom: 'Bfrtlip',

    buttons: [



    {

     extend: 'copy',

     exportOptions: {

      columns: [ 0, 1, 2,3,4,5,6,7,8,9]

    }

  },

  {

   extend: 'csv',

   exportOptions: {

    columns: [ 0, 1, 2,3,4,5,6,7,8,9]

  }

}, 

{ 

 extend: 'excel',

 exportOptions: {

  columns: [ 0, 1, 2,3,4,5,6,7,8,9]

}

},

{

 extend: 'pdf',

 exportOptions: {

  columns: [ 0, 1, 2,3,4,5,6,7,8,9]

}

},

{

 extend: 'print',

 exportOptions: {

  columns: [ 0, 1, 2,3,4,5,6,7,8,9]

}

} 

]          

});

  });



</script>