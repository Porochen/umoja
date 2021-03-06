<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller

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

			redirect(base_url('Login/admin_do_logout'));

		}	

	}



	function index(){

		$this->load->view('admin/Users_View');
	}


	function listing(){
    
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
    $data['user']=$this->Model->readRequete("SELECT m.id_membre,m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,CONCAT(m.nom_membre,' ',m.prenom_membre) AS nom FROM membre m WHERE 1 ".$critere." LIMIT ".$start_form.",".$limit."") ;


    $total_record=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_record FROM membre m WHERE id_membre>1');
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




	$user_info=$this->load->view('admin/Users_Search_View',$data,TRUE);
	     echo json_encode($user_info);
 }
function updateData($id_membre){
		$nom_membre=$this->input->post('nom_membre');

		$prenom_membre=$this->input->post('prenom_membre');

		$email_membre=$this->input->post('email_membre');

		$tele_membre=$this->input->post('tele_membre');


		$data=array('id_membre'=>$id_membre,
					'nom_membre'=>$nom_membre,
	              	'prenom_membre'=>$prenom_membre,
	              'email_membre'=>$email_membre,
	              'tele_membre'=>$tele_membre,
	           
	              );

		$mail=$this->Model->readOne('membre',array('id_membre'=>$id_membre));

		$this->Model->update('membre',array('id_membre' => $id_membre),$data);
		$this->Model->update('users',array('username' => $mail['email_membre']),array('username' => $email_membre));
		$this->Model->update('code_verification',array('email' => $mail['email_membre']),array('email' => $email_membre));

			$data['message']='<div class="alert alert-success text-center" id ="message">La modification r??ussi avec succ??s.</div>';
			$this->session->set_flashdata($data);


		redirect(base_url('admin/Users/index'));


}






}

?>