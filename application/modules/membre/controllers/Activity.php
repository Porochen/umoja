<?php


/**
 * 
 */
class Activity extends MY_Controller
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

		$id=$this->session->userdata('memberid');
        $data_activity= $this->Model->readRequete("SELECT t.action,t.description,date_format(t.date_insertion,'%d-%m-%y') AS date,date_format(t.date_insertion,'%H:%i%p') AS heure FROM tracabilite t WHERE id_membre=".$id."");
        $data['data_activity']=$data_activity;
        $this->load->view('membre/Activity_View',$data);
	}
}