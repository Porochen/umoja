<?php

/**
 * 
 */
class Graine extends MY_Controller
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
				$niveau=0;
        if ($id_niveau==1) {
          $niveau=1;
        }elseif ($id_niveau==2) {
          $niveau=2;
        }elseif ($id_niveau==3) {
          $niveau=3;
        }elseif ($id_niveau==4) {
          $niveau=4;
        }elseif ($id_niveau==5) {
          $niveau=5;
        }

		$data['water_beneficiaire']=$this->Model->readRequete("SELECT m.id_membre,m.code_membre,m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,m.photo_membre,b.id_membre_donateur,m.id_niveau,b.id_beneficiaire,b.id_membre_beneficiaire FROM beneficiaire b  LEFT JOIN membre m ON m.id_membre=b.id_membre_beneficiaire WHERE b.id_membre_donateur=".$id) ;
		

		
		$data['mode_paiement']=$this->Model->read('mode_paiement');
		$data['compte_bancaire']=$this->Model->getValueSettings('compte_bancaire') ;
		
		$this->load->view('Seed_View',$data);
	}

	public function upload_file($nom_file,$nom_champ)
	{
      $ref_folder =FCPATH.'assets/photo/proof_paiement';
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

	public function upload_proof()
	{
		$mode=$this->input->post('preferred');
		$details=$this->input->post('details');
		$id=$this->session->userdata('memberid');
		$niveau_chargement=$this->input->post('niveau_chargement');

		$id_niveau= $this->session->userdata('id_niveau');
				$niveau=0;
        if ($id_niveau==1) {
          $niveau=1;
        }elseif ($id_niveau==2) {
          $niveau=2;
        }elseif ($id_niveau==3) {
          $niveau=3;
        }elseif ($id_niveau==4) {
          $niveau=4;
        }elseif ($id_niveau==5) {
          $niveau=5;
        }

		$img=$this->upload_file($_FILES['proof']['tmp_name'],$_FILES['proof']['name']);

		$data = array('id_mode_paiement' => $mode,
								  'desc_proof' => $details,
									'image_proof'=>	$img,
									'id_membre_donateur'=>$id,
									'statut'=>0,
					   );
		$id_proof_paiement=$this->Model->createLastId('proof_paiement',$data);

		$beneficiaire=$this->Model->readRequeteOne("SELECT b.id_membre_beneficiaire FROM beneficiaire b WHERE b.code_niveau=".$niveau." AND b.id_membre_donateur=".$id."") ;

		$donateur=$this->Model->readRequeteOne("SELECT  m.nom_membre,m.prenom_membre,m.email_membre FROM membre m WHERE m.id_membre=".$id."") ;

		$msg_mail="";
		$mail_receveur="";
		$activite_detail='';
		if ($beneficiaire['id_membre_beneficiaire']==0) {

			$msg_mail="Cher Administrateur du syst??me,<br> Nous tenons ?? vous informer que ".$donateur['nom_membre']." ".$donateur['prenom_membre']." vient de charger le preuve de paiement du cadeau destin?? au compte solidarit?? Umoja.<br>Cordialement";
			$mail_receveur="admin@uumoja.org";

			$data = array('id_membre_receveur' =>0,
									  'statut'=>1,
									  'niveau_membre_receveur'=>$niveau_chargement,
									  'niveau_membre_donateur'=>$niveau_chargement
								 );

		$confirm=$this->Model->update('proof_paiement',array('id_proof_paiement'=>$id_proof_paiement),$data);

		$activite_detail="Umoja Systeme";
			
		}else{

		$receveur=$this->Model->readRequeteOne("SELECT m.id_membre, m.nom_membre,m.prenom_membre,m.email_membre,m.id_niveau FROM membre m WHERE m.id_membre=".$beneficiaire['id_membre_beneficiaire']."") ;

		$msg_mail="Cher(e) ".$receveur['nom_membre']." ".$receveur['prenom_membre'].",<br> Nous tenons ?? vous informer que ".$donateur['nom_membre']." ".$donateur['prenom_membre']." vient de charger le preuve de paiement de votre cadeau.Vous pouvez vous connecter <a href=".base_url().">ici</a> pour accuser la r??ception de ce cadeau.<br>Cordialement"; 
	
		$mail_receveur=$receveur['email_membre'];

		$activite_detail=$receveur['nom_membre']." ".$receveur['prenom_membre'];

			if ($niveau_chargement!=$receveur['id_niveau']) {
				
				$data = array(
										'id_membre_receveur' =>$receveur['id_membre'],
									  'statut'=>1,
									  'niveau_membre_receveur'=>$niveau_chargement,
									  'niveau_membre_donateur'=>$niveau_chargement
								 );

				$confirm=$this->Model->update('proof_paiement',array('id_proof_paiement'=>$id_proof_paiement),$data);
			}

	   }

		$attach=FCPATH.'assets/photo/proof_paiement/'.$img;

		$action='Preuve de paiement';
    $description="Chargemenent d'un preuve pour le gift donner ?? ".$activite_detail;

    $this->Save_history($action,$description);

		$this->notifications->send_mail($mail_receveur,'CHARGEMENT DU PREUVE DE PAIEMENT | UMOJA',NULL,$msg_mail,NULL);


		$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Vous venez de charger votre preuve de paiement.</div>';
		$this->session->set_flashdata($data);

		redirect(base_url('cadeau/Graine'));
	}

	public function confirm_proof()
	{
		$id_membre_donateur=$this->input->post('id_membre_donateur');
		$id=$this->session->userdata('memberid');
		$niveau=$this->session->userdata('id_niveau');

		$data = array('id_membre_receveur' => $id,
									'statut'=>1,
									'id_niveau'=>$niveau
								 );

		$confirm=$this->Model->update('proof_paiement',array('id_membre_donateur'=>$id_membre_donateur),$data);

		$donateur=$this->Model->readRequeteOne("SELECT  m.nom_membre,m.prenom_membre,m.email_membre FROM membre m WHERE m.id_membre=".$id_membre_donateur."") ;


		$receveur=$this->Model->readRequeteOne("SELECT  m.nom_membre,m.prenom_membre,m.email_membre FROM membre m WHERE m.id_membre=".$id."") ;

		$msg_mail="Cher(e) ".$donateur['nom_membre']." ".$donateur['prenom_membre'].",<br> Nous tenons ?? vous informer que ".$receveur['nom_membre']." ".$receveur['prenom_membre']." vient d'approuver  la r??ception de votre cadeau.Vous pouvez vous connecter <a href=".base_url().">ici</a> pour plus de d??tail.<br>Cordialement"; 

		$activite_detail=$donateur['nom_membre']." ".$donateur['prenom_membre'];
	
		$mail_donateur=$donateur['email_membre'];

		$action='Preuve de paiement';
    $description="Validation d'un preuve pour le gift pay?? par ".$activite_detail;

    $this->Save_history($action,$description);

		$this->notifications->send_mail($mail_donateur,'RECEPTION DU PREUVE DE PAIEMENT | UMOJA',NULL,$msg_mail,NULL);

		$nbr_gift=$this->Model->readRequeteOne("SELECT COUNT(*) AS nbr FROM proof_paiement p  WHERE p.id_membre_receveur=".$id." AND p.niveau_membre_receveur=".$niveau."") ;

		$nbr_gift_recu=$this->Model->readRequeteOne("SELECT COUNT(*) AS nbr FROM proof_paiement p JOIN beneficiaire b ON  b.id_membre_beneficiaire=p.id_membre_receveur  WHERE p.id_membre_receveur=".$id." AND p.niveau_membre_receveur=".$niveau."") ;

		if ($nbr_gift['nbr']==8) {
			$this->change_niveau();
		}

		if ($niveau>1 && $nbr_gift_recu['nbr']==2) {
			$this->in_donation();
		}

		$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center text-success" id ="sms">Vous venez de charger la r??ception du cadeau.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('cadeau/Recolte'));

	}

	public function change_niveau()
	{
		$id=$this->session->userdata('memberid');
		$niveau=$this->session->userdata('id_niveau');

		$benef_act=$this->Model->readRequeteOne("SELECT *  FROM beneficiaire b  WHERE b.id_membre_donateur=".$id." ") ;
		$code_niveau=$niveau+1;


		$nbr_benef=$this->Model->readRequeteOne("SELECT COUNT(*) AS nbr FROM beneficiaire b  WHERE b.id_membre_beneficiaire=".$benef_act['id_membre_beneficiaire']." AND b.code_niveau=".$code_niveau."") ;

		 $beneficiaire=0; 

		if ($nbr_benef['nbr']<=5) {
			$beneficiaire=$benef_act['id_membre_beneficiaire'];
		}else{
			$beneficiaire=0;
		}


		$data_bene = array(
			'id_water_direct' =>$benef_act['id_water_direct'] ,
			'id_water_source' =>$benef_act['id_water_source'] ,
			'id_membre_beneficiaire' =>$beneficiaire,
			'id_membre_donateur' =>$benef_act['id_membre_donateur'] ,
			'code_niveau' =>$code_niveau ,
			 );

			$confirm=$this->Model->update('membre',array('id_membre'=>$id),$data);

			$this->Model->create('beneficiaire',$data_bene);

		$action='Chargemenent de niveau';
    $description="Vous venez de passer du niveau ".$niveau." au niveau".$code_niveau;
    $this->Save_history($action,$description);

			redirect(base_url());

	}

	public function in_donation()
	{
		$id=$this->session->userdata('memberid');
		$id_niveau=$this->session->userdata('id_niveau');

		$data = array(
			'id_membre' =>$id,
			'in_donation' =>date('Y-m-d H:i:s') ,
			'id_niveau' =>$id_niveau ,
			 );

			$this->Model->create('donation',$data);
	    $this->Model->update('water',array('id_membre'=>$id),array('is_donation'=>1));

	  $action="Frais d'admin ";
    $description="Votre compte est soumis au paiment des frais d'admin";
    $this->Save_history($action,$description);

			redirect(base_url('dashboard/Dashboard_Main'));
		
	}

}

?>