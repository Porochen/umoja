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
							   <h2 class="text-white pb-2 fw-bold">
								Tracabilité
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
										Tracabilité
									</li>
								</ol>
							</div>
                            <!-- PAGE-HEADER END -->
							</div>
						</div>
					</div>
				</div>


                <div class="table-responsive" ><br>
                        <table id='mytable' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>NOM & PRENOM</th>
                            <th>ACTION</th>
                            <th>DESCRIPTION</th>
                            <th>DATE</th>
                          </tr>
                        </thead>

                      </table>
                    </div>

			



   
<!-- Footer -->	
<?php include VIEWPATH.'template/includes/footer.php';?>
<!-- End Footer -->	

<script type="text/javascript">
 $(document).ready(function(){
    get_hist();
     
    });
 </script>

<script type="text/javascript">
function get_hist() 
{  
   $("#mytable").DataTable({
    "destroy" : true,
    "processing":true,
    "serverSide":true,
    "oreder":[],
    "ajax":{
      url: "<?=base_url('admin/Tracabilite/listing');?>", 
      type:"POST",
      data : {   },
      beforeSend : function() {
      }
    },
    lengthMenu: [[5,10,50, 100, -1], [5,10,50, 100, "All"]],
    pageLength: 5,
    "columnDefs":[{
      "targets":[],
      "orderable":false
    }],
    dom: 'Bfrtlip',
    buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'  ],
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
    }
  });


 }
</script>
