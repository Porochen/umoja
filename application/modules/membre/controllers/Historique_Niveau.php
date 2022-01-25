<?php

/**
 * 
 */
class Historique_Niveau extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		$id_water=$this->session->userdata('memberid');
		$all_fires=$this->Model->readRequete("SELECT m.id_membre,concat(m.prenom_membre,' ',m.nom_membre) AS nom,m.email_membre,m.tele_membre FROM tier3 t JOIN membre m ON t.id_membre_tier3=m.id_membre WHERE t.id_water_source=".$id_water."");
		
		$data['all_fires']=$all_fires;
		$this->load->view('Historique_Niveau_View',$data);
	}
}