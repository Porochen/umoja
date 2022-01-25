<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tracabilite extends MY_Controller
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
		
		$this->load->view('admin/Tracabilite_View');

	}

	
	function listing($key_search=''){
         

   $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
   $query_principal="SELECT me.nom_membre,me.prenom_membre,trac.action,trac.description,trac.date_insertion FROM tracabilite trac LEFT JOIN membre me ON me.id_membre=trac.id_membre WHERE 1 ";

   $limit='LIMIT 0,10';
   if($_POST['length'] != -1){
    $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
  }
  $order_by='';

  if (!empty($order_by)) {
      # code...
    $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY trac.date_insertion  DESC';
  }

  $search = !empty($_POST['search']['value']) ? (" AND  (nom_membre LIKE '%$var_search%' OR prenom_membre LIKE '%$var_search%' OR action LIKE '%$var_search%' OR trac.date_insertion LIKE '%$var_search%' OR CONCAT(nom_membre,' ',prenom_membre) LIKE '%$var_search%' ) ") : '';
  $critaire ="";

  $query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
  $query_filter=$query_principal.'  '.$critaire.' '.$search;
  $fetch_data = $this->Model->readData($query_secondaire); 
  $u=0; 
  $data = array();

  foreach ($fetch_data as $value) {

    $u++;
    $sub_array = array(); 
    $sub_array[] =$u;
    $sub_array[] = $value->nom_membre.' '.$value->prenom_membre;
    $sub_array[] = $value->action;
    $sub_array[] = $value->description;
    $sub_array[] = $value->date_insertion;

    $data[] = $sub_array;
  }

  $output = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" =>$this->Model->readAll_data($query_principal),
    "recordsFiltered" => $this->Model->read_filtred($query_filter),
    "data" => $data
  );

  echo json_encode($output);
}



}

?>