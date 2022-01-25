<?php 
	/**
	 * @author uyc.tic@gmail.com
	 */
	class Mode_paiement extends MY_Controller
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

		function add()
	    {
		  	$this->load->view('Add_paiement');
		  	
		
	    }

	public function index()
	{

		
		$paiement=$this->Model->read('mode_paiement');

		$data_data=array();
		$u=0;
		foreach ($paiement as $value) {
			$fetch_data=array();
			$u=++$u;
			$fetch_data[]=$u;
			$fetch_data[]='<center><img src="'.base_url('assets/photo/mode_paiement/').$value['image_mode_paiement'].'" alt="photo" style="width:40px;height:40px;"></center>';
		   $fetch_data[]=$value['description_mode'];
			$fetch_data[]=$value['code_mode_paiement'];
			
			$fetch_data[]='<div class="dropdown">
                              <span class="dropdown-toggle dropdown-bg btn btn-outline-primary" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                 <a class="dropdown-item" href="'.base_url('ihm/Mode_paiement/select_one/').$value['id_mode_paiement'].'"><i class="ri-pencil-fill mr-2"></i>Modifier</a>
                                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete'.$value['id_mode_paiement'].'"><i class="ri-delete-bin-6-fill mr-2"></i><font class="text-danger">Supprimer</font></a>
                              </div>
                              </div>
                           <div class="modal fade" id="delete'.$value['id_mode_paiement'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							    <h4 class="modal-title ">Suppression d\'un paiement</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        </div>
							      <div class="modal-body">
							        <p>Voulez-vous vraiment Supprimer : <b style="color:green">'.$value['description_mode'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('ihm/Mode_paiement/delete').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_mode_paiement'].'">
								        <button type="button" class="btn btn-outline-default pull-left" data-dismiss="modal">Annuler</button>
								        <input type="submit" name="submit" class="btn btn-outline-danger" value="Supprimer">
							      </div>
							      </form>
							      
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->';
								

							
							$data_data[]=$fetch_data;

		

}
	

		$template = array(
          'table_open' => '<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed">',
          'table_close' => '</table>'
      	);
        
      	$this->table->set_heading('#','IMAGE','DESCRIPTION','CODE','OPTIONS');
       
      	$this->table->set_template($template);
      	$data['paiement']=$data_data;
      	$this->load->view('List_paiement',$data);
	}

	
function add_new(){

	  $this->form_validation->set_rules('description_mode','','required',['required'=>'Le champ est obligatoire']);
	  $this->form_validation->set_rules('code_mode_paiement','','required',['required'=>'Le champ est obligatoire']);


	if ($this->form_validation->run()==FALSE) {

	  	$this->add() ;
	  }else{
	  	$descr=$this->input->post('description_mode');
	  	$cod=$this->input->post('code_mode_paiement');

	  	$img=$this->upload_file($_FILES['img']['tmp_name'],$_FILES['img']['name']);

	  	$data=array('description_mode'=>$descr,
	  		'image_mode_paiement'=>$img,
	  		'code_mode_paiement'=>$cod,
	  		      );
	  	$this->Model->create('mode_paiement',$data);
	  	$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Mode_paiement/index'));
	  }    
	}


	public function upload_file($nom_file,$nom_champ)

{

      $ref_folder =FCPATH.'assets/photo/mode_paiement';

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




	public function select_one($id)
	{

		
	$data['paiem']=$this->Model->readOne('mode_paiement',array('id_mode_paiement' =>$id ));
		$this->load->view('Update_mode_paiement',$data);
	}
function update($id_mode_paiement=0){

	  $this->form_validation->set_rules('description_mode','','required',['required'=>'Le champ est obligatoire']);
	  $this->form_validation->set_rules('code_mode_paiement','','required',['required'=>'Le champ est obligatoire']);

//form
	if ($this->form_validation->run()==FALSE) {

	  	$this->select_one($id_mode_paiement);
	  }else{
	  		  	
	  	$descr=$this->input->post('description_mode');
	  	$cod=$this->input->post('code_mode_paiement');

	  	$img=$this->upload_file($_FILES['img']['tmp_name'],$_FILES['img']['name']);

	  	$data=array('description_mode'=>$descr,
	  		'image_mode_paiement'=>$img,
	  		'code_mode_paiement'=>$cod,
	  		      );
	  	$this->Model->update('mode_paiement',array('id_mode_paiement'=>$id_mode_paiement),$data);
	  	$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Mode_paiement/index'));
	  }    
	}


	public function delete()
	{
		$id=$this->input->post('ID');
		
		$delete=$this->Model->delete('mode_paiement',array('id_mode_paiement'=>$id));	
		
		$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('ihm/Mode_paiement/'));
	}
	
	
  }