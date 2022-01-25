<?php

/**
 * 
 */
class Donation extends MY_Controller
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
		$data['mode_paiement']=$this->Model->read('mode_paiement');
		$this->load->view('Donnation_View',$data);
	}

	function listing(){
          
    $critere = $this->session->userdata('memberid');
    $id_niveau = $this->session->userdata('id_niveau');
    
    $data['donation']=$this->Model->readRequete("SELECT * FROM donation JOIN water ON water.id_membre=donation.id_membre WHERE donation.id_membre= ".$critere."  AND donation.id_niveau=".$id_niveau);

     $data['admin_fees']=$this->Model->getValueSettings('admin_fees') ;

	  $donation_info=$this->load->view('Donation_Search_View',$data,TRUE);
	     echo json_encode($donation_info);
 }

 public function upload_file($nom_file,$nom_champ)
	{
      $ref_folder =FCPATH.'assets/photo/proof_donation';
      $code=date("YmdHis").uniqid();
      $fichier=basename($code);
      $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);

      if(!is_dir($ref_folder)) 
      {
          mkdir($ref_folder,0777,TRUE);
                                                     
      } 
      move_uploaded_file($nom_file, "$ref_folder/$fichier.$file_extension");
      $image_name=$fichier.".".$file_extension;
      return $image_name;
}



 public function paiement()
 {
 		$mode=$this->input->post('preferred');
		$details=$this->input->post('details');
		$id=$this->session->userdata('memberid');
		$id_niveau=$this->session->userdata('id_niveau');

		$img=$this->upload_file($_FILES['proof']['tmp_name'],$_FILES['proof']['name']);

		$data = array('mode_paiement' => $mode,
								  'descr_paiement' => $details,
									'proof_donation'=>	$img,
									'statut'=>0,
									'date_paiement'=>date('Y-m-d H:i:s')
					   );
		$this->Model->update('donation',array('id_membre'=>$id,'id_niveau'=>$id_niveau),$data);
		$this->Model->update('water',array('id_membre'=>$id),array('is_donation'=>1));

		$donateur=$this->Model->readRequeteOne("SELECT  m.nom_membre,m.prenom_membre,m.email_membre FROM membre m WHERE m.id_membre=".$id."") ;

		$msg_mail="";
		$mail_receveur="";


			$msg_mail="Cher Administrateur du système,<br> Nous tenons à vous informer que ".$donateur['nom_membre']." ".$donateur['prenom_membre']." vient de charger le preuve de paiement du frais d'administration.<br>Cordialement";
			$mail_receveur="admin@uumoja.org";

			$attach=FCPATH.'assets/photo/proof_donation/'.$img;


		$this->notifications->send_mail($mail_receveur,'CHARGEMENT DU PREUVE DE PAIEMENT | UMOJA',NULL,$msg_mail,$attach);

		$action="Frais d'admin ";
    $description="Paiement des frais d'admin";
    $this->Save_history($action,$description);


		$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Vous venez de charger votre preuve de paiement.</div>';
		$this->session->set_flashdata($data);

		redirect(base_url('cadeau/Donation'));

		
 }

 public function approver_donation()
 {
 	$this->load->view('Approve_donation_View');
 }

 function listing_approuv(){


 	$key_search=$this->input->post('critere');
		 $page_set=$this->input->post('page');
         $data['title']="Liste des produits";

         $limit=15;
         $page=0;
         $output='';

         if (!empty($page_set)) {
         	$page=$page_set;
         }else{
         	$page=1;
         }

         $start_form=($page-1)*$limit;


    $critere = !empty($key_search) ? '  and (m.nom_membre LIKE "%'.$key_search.'%" OR m.prenom_membre LIKE "%'.$key_search.'%"  OR m.email_membre LIKE "%'.$key_search.'%" OR CONCAT(m.nom_membre," ",m.prenom_membre) LIKE "%'.$key_search.'%" OR m.tele_membre LIKE "%'.$key_search.'%")' : '';
    
    $data['page']=$page;
    $data['appr']=$this->Model->readRequete("SELECT * FROM donation d JOIN membre m ON m.id_membre=d.id_membre WHERE d.statut= 0 ".$critere." LIMIT ".$start_form.",".$limit."") ;


    $total_record=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_record FROM donation d JOIN membre m ON m.id_membre=d.id_membre WHERE d.statut= 0');
	     $total_page=ceil($total_record['total_record']/$limit);

	     $output.='<nav aria-label="...">
					  <ul class="pagination">';

					 if ($page>1) {

					  	$previous=$page-1;
		 $output.='<li class="page-item" id="'.$previous.'">
					      <a class="page-link" href="javascript:void(0)" tabindex="-1">Previous</a>
				   </li>';

					  }

			        $active_class='';
				    $avant=0;
				    $apres=0;

			for ($i=1; $i <= $total_page ; $i++) { 
					
					$avant=$page-3;
					$apres=$page+3;

				if (($avant-1)==$i) {
				$output.='<li class="page-item"">
					...<span class="sr-only">(current)</span>
				  </li>';
				}

		        if ($i>=$avant && $i<=$apres) {
		        
		        $active_class=$i==$page?'active':'';
		        $output.='<li class="page-item '.$active_class.'" id="'.$i.'">
					<a class="page-link" href="javascript:void(0)">'.$i.'<span class="sr-only">(current)</span></a>
				  </li>';

		        }

		         if (($apres+1)==$i) {
				$output.='<li class="page-item"">
					...<span class="sr-only">(current)</span>
				  </li>';
				}

		        
			}



			if ($page<$total_page) {

					  	$next=$page+1;
		 $output.='<li class="page-item" id="'.$next.'">
					      <a class="page-link" href="javascript:void(0)" tabindex="-1">Next</a>
				   </li>';
				}

	    $output.='</ul>
					</nav>';
         $data['pagination']=$output;

	  $donation_info=$this->load->view('Approve_donation_Search_View',$data,TRUE);
	     echo json_encode($donation_info);
 }

 public function approuver()
 {
 		$id_membre=$this->input->post('id_membre');
		$id_donation=$this->input->post('id_donation');

		$data = array('date_approuv' => date('Y-m-d H:i:s'),
									'statut'=>1,
									'Id_admin'=>$this->session->userdata('memberid')
					   );

		$this->Model->update('donation',array('id_donation'=>$id_donation),$data);
		$this->Model->update('water',array('id_membre'=>$id_membre),array('is_donation'=>0));

		$donateur=$this->Model->readRequeteOne("SELECT  m.nom_membre,m.prenom_membre,m.email_membre FROM membre m WHERE m.id_membre=".$id_membre."") ;

		$msg_mail="";
		$mail_receveur="";


			$msg_mail="Cher ".$donateur['nom_membre']." ".$donateur['prenom_membre']." du système,<br> Nous tenons à vous informer que l'administrateur vient de valider le preuve de paiement du frais d'administration.<br>Cordialement";
			$mail_receveur=$donateur['email_membre'];



		//$this->notifications->send_mail($mail_receveur,'VALIDATION DU PREUVE DE PAIEMENT | UMOJA',NULL,$msg_mail);

			$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Vous venez d\'approuver le preve de paiement.</div>';
		$this->session->set_flashdata($data);

		redirect(base_url('cadeau/Donation/approver_donation'));
 }
}

?>