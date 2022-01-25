<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrateurs extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_verify();
	}

	public function is_verify()
	{
		if (empty($this->session->userdata('memberid')))
		{
			redirect(base_url('Login/admin_do_logout'));
		}	
	}

	public function index()
	{
		$this->load->view('Admini_List_View');
	}

	public function add()
	{
		$this->load->view('Admini_Add_View');
	}

	public function save()
	{
		$nom=$this->input->post('nom');
		$prenom=$this->input->post('prenom');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');

		$data = array('nom_admin' =>$nom ,
					  'prenom_admin' =>$prenom ,
					  'email_admin' =>$email ,
					  'phone_admin' =>$phone);

		$id_admin=$this->Model->createLastId('admin',$data);

        $code=$this->notifications->Code_verification(6);

		$login = array('id_membre'=>$id_admin,
					  'username' =>$email ,
					  'password' =>md5($code),
					  'statut_user' =>1,
					  'user_title' =>2);

		$this->Model->create('users',$login);

		$msg_mail = "Cher(e) ".$prenom." ".$nom.", Bienvenue dans le système Umoja.Veuillez recevoir vos identifiants/détails de connexion.<br>
    		Votre nom d'utilisateur est : ".$email." ,<br>
			et le mot de passe est : ".$code." ,<br>
			Vous pouvez accéder à notre système en utilisant en cliquant <a href=".base_url('admin').">ici</a>.<br> Cordialement.";
    	$this->notifications->send_mail($email,'IDENTIFIANTS DE CONNEXION | UMOJA',NULL,$msg_mail,NULL);

		$data = '<div style="background-color:#42ba96" class="alert alert-success col-md-12 text-center">Enregistrement de <b>'.$nom." ".$prenom.'</b> est faite avec success.Merci</div>';

		echo json_encode($data);

	}



	public	function listing(){
   
         $key_search=$this->input->post('critere');
		 $page_set=$this->input->post('page');

         $limit=5;
         $page=0;
         $output='';

         if (!empty($page_set)) {
         	$page=$page_set;
         }else{
         	$page=1;
         }

         $start_form=($page-1)*$limit;
          
   $critere = !empty($key_search) ? '  and (nom_admin LIKE "%'.$key_search.'%" OR prenom_admin LIKE "%'.$key_search.'%" OR email_admin LIKE "%'.$key_search.'%" OR telephone_admin LIKE "%'.$key_search.'%" OR  CONCAT(nom_admin," ",prenom_admin) LIKE "%'.$key_search.'%" )' : '';

	$data['page']=$page;	
    $data['Admini']=$this->Model->readRequete("SELECT * FROM admin a JOIN users u ON u.id_membre=a.id_admin  WHERE user_title=2  ".$critere." ORDER BY statut_user DESC LIMIT ".$start_form.",".$limit."") ;

    
    $total_record=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_record FROM admin WHERE 1');
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
         $Admini_info=$this->load->view('Admini_Search_View',$data,TRUE);
	     echo json_encode($Admini_info);
	}

	public function getOne($id)
	{
		$data['admin']=$this->Model->readOne('admin',['id_admin'=>$id]);
		$this->load->view('Admini_Update_View',$data);
	}
	public function update()
	{
		$id_admin=$this->input->post('id_admin');
		$nom=$this->input->post('nom');
		$prenom=$this->input->post('prenom');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');

		$data = array('nom_admin' =>$nom ,
					  'prenom_admin' =>$prenom ,
					  'email_admin' =>$email ,
					  'phone_admin' =>$phone , );

		$this->Model->update('admin',['id_admin'=>$id_admin],$data);

		$data = '<div style="background-color:#42ba96" class="alert alert-success col-md-12 text-center">Modification de <b>'.$nom." ".$prenom.'</b> est faite avec success.Merci</div>';

		echo json_encode($data);

	}

	public function desactiver($id)
	{
		$user=$this->Model->readRequeteOne("SELECT * FROM admin a JOIN users u ON u.id_membre=a.id_admin  WHERE user_title=2  AND id_membre=".$id) ;
		$ident=$user['nom_admin'].' '.$user['prenom_admin'];

		if ($user['statut_user']==1) {
			$statut_user=0;
			$statut='Désactivation';
		}else{
			$statut='Activation';
			$statut_user=1;
		}

		$delete=$this->Model->update('users',array('id_user'=>$user['id_user'],'user_title'=>2),array('statut_user'=>$statut_user));

		$data['sms'] = '<div style="background-color:#42ba96" class="alert alert-success col-md-12 text-center">'.$statut.' de <b>'.$ident.'</b> est faite avec success.Merci</div>';

		$this->session->set_flashdata($data);
		redirect(base_url('administrateurs/Administrateurs'));
	}

}
