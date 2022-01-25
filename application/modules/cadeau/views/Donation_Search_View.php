<?php 
if (empty($donation)) { ?>

  <div class="card">
      <div class="card-header border-bottom-0 p-4">
       <h2 class="card-title"></h2>
      </div>
      <div class="container">
      <div class="e-table">
       <div class="table-responsive table-lg">
        <table class="table table-bordered mb-0">
         <thead>
          <tr>
           <th><?=lang('titre')?></th>
           <th><?=lang('montants')?></th>
           <th><?=lang('date')?></th>
           <th colspan="2"><?=lang('preuve')?></th>
          </tr>
         </thead>
         <tbody>
          <tr>
           <td colspan="7">
              <center>
                  <h5><?=lang('donne_affiche')?></h5>
              </center>
            </td>
     </tr>

         </tbody>
        </table>
       </div>
      </div>
      </div>
     </div>

       
       
<?php }else{

foreach ($donation as $value) { 
  if ($value['is_donation']==0) 
  { ?>
     <div class="card">
      <div class="card-header border-bottom-0 p-4">
       <h2 class="card-title"></h2>
      </div>
      <div class="container">
      <div class="e-table">
       <div class="table-responsive table-lg">
        <table class="table table-bordered mb-0">
         <thead>
          <tr>
           <th><?=lang('titre')?></th>
           <th><?=lang('montants')?></th>
           <th><?=lang('date')?></th>
           <th colspan="2"><?=lang('preuve')?></th>
          </tr>
         </thead>
         <tbody>

          <tr>
           <td>Admin</td>
           <td><?=$admin_fees ?>.00$</td>
           <td><?=$value['date_paiement']?> </td>
           <td>
            <button type="button" class="btn btn-info" style="padding: 2px 5px 2px 5px" data-toggle="modal" data-target="#WXHjzvGRn_A2"><?=lang('voir_preuve')?></button>
            <div id="WXHjzvGRn_A2" class="modal fade">
             <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content ">
               <div class="modal-header pd-x-20">
                <h6 class="modal-title"><?=lang('preuve_payement')?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
               </div>
               <div class="modal-body pd-20">
                <center>
                 <span style="color: #069">
                  <b>Pour agrandir l'image, veuillez faire un clic droit et sélectionnez ouvrir l'image dans un nouvel onglet.</b><br><br>
                 </span>
                 <img src="<?= base_url('assets/photo/proof_donation/').$value['proof_donation']?>" alt="Proof" style="width: 60%; height: auto; border-radius: 0px">
                </center>
               </div>
              </div>
             </div>
            </div>
           </td>
           <td>
            <span class="btn btn-success" style="padding: 2px 5px 2px 5px">
            APPROUVE                                                        </span>
           </td>
          </tr>

         </tbody>
        </table>
       </div>
      </div>
      </div>
     </div>
<?php  }elseif ($value['is_donation']==1)
  { ?>

    <div class="card">
      <div class="card-header border-bottom-0 p-4">
        <h2 class="card-title"></h2>
        <div class="page-options d-flex float-right">
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#donation"><?=lang('pay_now')?></button>
        </div>
      </div>
      <div class="container">
      <div class="e-table">
        <div class="table-responsive table-lg">
          <table class="table table-bordered mb-0">
            <thead>
            <tr>
           <th><?=lang('titre')?></th>
           <th><?=lang('montants')?></th>
           <th><?=lang('date')?></th>
           <th colspan="2"><?=lang('preuve')?></th>
          </tr>
            </thead>
            <tbody>

              <tr>
                <td>Admin</td>
                <td><?=$admin_fees ?>.00$</td>
                <td><?=$value['in_donation']?></td>
                <td>
                  <span><?=lang('no_proof')?></span>
                </td>
                <td>
                  <span class="btn btn-danger" style="padding: 2px 5px 2px 5px">
                   <?=lang('echeance')?>                           </span>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>

 <?php }

  ?>


 

<?php } } ?>