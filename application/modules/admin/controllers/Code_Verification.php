<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Code_Verification extends MY_Controller

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

		$this->load->view('admin/Code_View');
	}


	function listing(){
    
         $key_search=$this->input->post('critere');
		 $page_set=$this->input->post('page');

         $limit=15;
         $page=0;
         $output='';

         if (!empty($page_set)) {
         	$page=$page_set;
         }else{
         	$page=1;
         }

         $start_form=($page-1)*$limit;


    $critere = !empty($key_search) ? '  and (c.email LIKE "%'.$key_search.'%" OR c.code_verification LIKE "%'.$key_search.'%" OR c.date_insertion LIKE "%'.$key_search.'%")' : '';
    
    $data['page']=$page;
    $data['code']=$this->Model->readRequete("SELECT c.id_verification,c.email,c.code_verification,c.date_insertion FROM code_verification c WHERE 1  ".$critere." ORDER BY id_verification DESC LIMIT ".$start_form.",".$limit."") ;


    $total_record=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_record FROM code_verification c WHERE 1');
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




	$user_info=$this->load->view('admin/Code_Search_View',$data,TRUE);
	     echo json_encode($user_info);
 }

}

?>