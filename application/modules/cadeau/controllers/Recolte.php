<?php

/**
 * 
 */
class Recolte extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->is_verify();
	}

	public function is_verify()
	{
		if (empty($this->session->userdata('memberid')))
		{
			redirect(base_url('Login/do_logout'));
		}	
	}


	public function index()
	{
		$id=$this->session->userdata('memberid');
		$id_niveau= $this->session->userdata('id_niveau');

		$data['total_niveau']=$this->Model->readRequete('SELECT * FROM niveau WHERE id_niveau<='.$id_niveau.' ORDER BY id_niveau DESC');
		$data['id_niveau']=$id_niveau;

		$this->load->view('Recolte_View',$data);
	}


	function getData(){

		$id=$this->session->userdata('memberid');
		$id_niveau=$this->input->post('id_niveau');

		$membres=$this->Model->readRequete('SELECT m.id_membre,m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,m.remplace,b.id_membre_beneficiaire,b.code_niveau,p.id_proof_paiement,p.desc_proof,p.image_proof,p.id_membre_donateur,p.statut,p.date_insertion,b.id_membre_donateur FROM beneficiaire b JOIN membre m ON m.id_membre=b.id_membre_donateur LEFT JOIN proof_paiement p ON p.id_membre_donateur=b.id_membre_donateur WHERE id_water_source='.$id.' AND code_niveau='.$id_niveau.'');


$montant=$this->Model->readOne('niveau',['id_niveau'=>$id_niveau]); 
$compte_bancaire=$this->Model->getValueSettings('compte_bancaire') ; 
$out_put='';

 // ========< member_info >=========


$out_put.='<div class="row">';

  
        if (!empty($membres)) {
        
           foreach($membres as $membre) { 

         if ($membre['statut']==NULL){
               $statu=lang('echeance');
            }else{
               if($membre['statut']==1)
               {
                  $statu=lang('recu');
               }elseif($membre['statut']==0)
               {
                     $statu=lang('payable');
               }

            }

          

$out_put.='<div class="col-lg-4 col-sm-12 p-l-0 p-r-0 col-md-12">
       <div class="card">
        <div class="card-header text-center success">
         <h4 class="card-title">
          $ '.$montant['cout_gift'] .'.00 - '.$statu.'
         </h4>
        </div>

        <div class="card-body">';
      
        $img = '';

        if (!empty($membre['photo_membre'])) { 

         $img=base_url('assets/photo/Profile/').$membre['photo_membre'];
         $nom=$membre['nom_membre'];
        }else{ 
         $img=base_url('assets/photo/profile/profile.jpg');
         $nom='No Image';
        }  

    
$out_put.=' <center>
          <img class="media-object rounded-circle thumb-sm" alt="<?=$nom?>" src="'.$img .'" style="width: 65px; height: 65px">
        </center>
         <div class="text-center mt-3">
          <h5>'.
           $membre['nom_membre'].' '.$membre['prenom_membre'].'
          </h5>
          <p class="mb-4">'.
           $membre['email_membre'].'<br>'.
           $membre['tele_membre'].'
          </p>
          <div class="dropdown-divider"></div>
        <u>
          <b class="text-success text-center">'.lang('beneficiaire').'</b>
        </u>';

          $bene=$this->Model->readRequeteOne("SELECT m.id_membre,m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre FROM membre m WHERE m.id_membre=".$membre['id_membre_beneficiaire']."") ;

        

        
            if (!empty($bene)) {     
      
$out_put.=' <h5>'.
           $bene['nom_membre'].' '.$bene['prenom_membre'].
          '</h5>
          <p class="mb-4">'.
            $bene['email_membre'].'<br>'.
           $bene['tele_membre'].'
          </p>';
   
    
    }else{   
$out_put.='<h5>'.lang('compte_bancaire').'</h5>
          <p class="mb-4">'.lang('numero_compte').'<br>'.$compte_bancaire.'<br>
          </p>';
     } 


$out_put.='<div class="col p-1 mt-2">
           <div class="float-left">
            <div class="row">';

            if($membre['statut']!=NULL) { 

$out_put.='<button type="button" class="btn btn-primary btn-sm d-block" data-toggle="modal" data-target="#TPVnvWwJu'.$membre['id_membre_donateur'].'">'.lang('preuve').'</button>';

             if($membre['statut']==0) { 

   $out_put.=' <button type="button" class="btn btn-success btn-sm d-block" data-toggle="modal" data-target="#APPROUVE'.$membre['id_membre_donateur'].'" style="margin-left: 140px;">'.lang('approuve').'</button>';

                 } 

             } 

$out_put.=' </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>';
            




// ===========< modal preuve >=====

$out_put.='
<div id="TPVnvWwJu'.$membre['id_membre_donateur'].'" class="modal fade">
       <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
         <div class="modal-header pd-x-20">
          <h6 class="modal-title">'.lang('preuve_payement').'</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
          </button>
         </div>
         <div class="modal-body pd-20">
          <center>
           <p>
            <h4>
             '.lang('cadeau_de').' '.$membre['prenom_membre'].'
            </h4>
           </p>
           <hr>
           <embed src="'.base_url('assets/photo/proof_paiement/').$membre['image_proof'].'" alt="Proof" alt="Preuve" width="100%" height="400px"/>
           </center>
         </div>
        </div>
       </div>
      </div>';


// ============< fin modal preuve >=====


// ===========< modal approbation >=======
$out_put.='
<div class="modal fade" id="APPROUVE'.$membre['id_membre_donateur'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title text-success text-center">'.lang('accuse_reception').'</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>       
      </div>     
         <form action="'.base_url('cadeau/Graine/confirm_proof/').'" method="post">
            <div class="modal-body">
           '.lang('recu_cadeau_de').'<b class="text-success">'.$membre['prenom_membre'].'</b> ? 
            </div>
           <div class="modal-footer">
            <input type="hidden" name="id_membre_donateur" value="'.$membre['id_membre_donateur'].'">
              <button type="button" class="btn btn-default" data-dismiss="modal">'.lang('fermer').'</button>
              <button type="submit" class="btn btn-primary">'.lang('approuve').'</button>
            </div>
         </form>
    </div>
  </div>
</div>';

// =========< fin modal approbation >========






             } 

		$out_put.='</div>

		</div>';

		      
		        }else{
$out_put.='		        	
<div class="container-fluid mt-4">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
                 <div class="alert alert- col-md-12"><h6 class="text-center">Aucune donnée disponible dans la table ! </h6></div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>';
		        } 
		  
       $out_put.='</div>';

     echo $out_put;


   }











}


?>