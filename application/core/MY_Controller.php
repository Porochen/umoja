<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{	

	function __construct() 
	{
		parent::__construct();
		$this->_hmvc_fixes();
		// $this->load->module(array("admin","dashbord","cadeau","excel_import","membre")) ;
	}
	
	function _hmvc_fixes()
	{		
		//fix callback form_validation		
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}


	public function Save_history($action,$description){
	  $id_membre=$this->session->userdata('memberid');
	  if(!empty($id_membre)){
	  $this->Model->Set_History($id_membre,$action,$description) ;
	  }
	}

}