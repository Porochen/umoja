<?php


/**
 * 
 */
class Projet extends MY_Controller
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

	function index(){
        $this->load->view('projet/Projet_View');
	}
}