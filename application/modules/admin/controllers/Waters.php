<?php

/**
 * 
 */
class Waters extends MY_Controller
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

	public function index()
	{
		
		$this->load->view('Waters_View');
	}

	public	function listing($key_search=''){
     
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

   $critere = !empty($key_search) ? '  and (m.nom_membre LIKE "%'.$key_search.'%" OR m.prenom_membre LIKE "%'.$key_search.'%" OR m.email_membre LIKE "%'.$key_search.'%" OR m.tele_membre LIKE "%'.$key_search.'%" OR  CONCAT(m.nom_membre," ",m.prenom_membre) LIKE "%'.$key_search.'%" )' : '';
	
	$data['page']=$page;	
    $data['waters']=$this->Model->readRequete("SELECT m.id_membre,m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,CONCAT(m.nom_membre,' ',m.prenom_membre) FROM membre m JOIN water w ON w.id_membre=m.id_membre WHERE 1 ".$critere." ORDER BY m.id_membre ASC LIMIT ".$start_form.",".$limit."") ;
    
    $total_record=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_record FROM water WHERE 1');
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


	  $waters_info=$this->load->view('Waters_Search_View',$data,TRUE);
	     echo json_encode($waters_info);
 }


 public function index2($id_membre)
 {
 		$data['water']=$this->Model->readRequeteOne('SELECT me.id_membre,me.nom_membre,me.prenom_membre FROM  membre me WHERE me.id_membre='.$id_membre.' ');
 		$this->load->view('Fires_View',$data);
 }


 public	function listing_fires($key_search=''){

 	$id_water_source=$this->input->post('id_water_source');

          
   $critere = !empty($key_search) ? '  and (m.nom_membre LIKE "%'.$key_search.'%" OR m.prenom_membre LIKE "%'.$key_search.'%" OR m.email_membre LIKE "%'.$key_search.'%" OR m.tele_membre LIKE "%'.$key_search.'%" OR  CONCAT(m.nom_membre," ",m.prenom_membre) LIKE "%'.$key_search.'%" )' : '';

		
    $data['fires']=$this->Model->readRequete("SELECT m.id_membre,m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,CONCAT(m.nom_membre,' ',m.prenom_membre) FROM membre m JOIN tier3 t3 ON t3.id_membre_tier3=m.id_membre WHERE t3.id_water_source=".$id_water_source." ".$critere." ORDER BY t3.date_insertion ASC") ;

    $data['beneficiaire']=$this->Model->readRequete("SELECT DISTINCT (id_membre_beneficiaire),m.nom_membre,m.prenom_membre FROM beneficiaire b LEFT JOIN membre m ON m.id_membre=b.id_membre_beneficiaire WHERE id_water_source=".$id_water_source." ") ;

	  $fires_info=$this->load->view('Fires_Search_View',$data,TRUE);
	     echo json_encode($fires_info);
 }


 public function change_beneficiaire()
 {
 		$id_beneficiaire=$this->input->post('id_beneficiaire');
 		$id_membre_beneficiaire=$this->input->post('id_membre_beneficiaire');
 		$id_water_source=$this->input->post('id_water_source');
 	
 		$change = array('id_membre_beneficiaire' => $id_membre_beneficiaire, );
 		$this->Model->update('beneficiaire',array('id_beneficiaire'=>$id_beneficiaire),$change);

 		redirect(base_url('admin/Waters/index2/'.$id_water_source.''));

 }



}

?>