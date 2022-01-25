<?php
/**
 * 
 */
class Niveau extends MY_Controller
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
	public function index(){

		$niveau=$this->Model->readRequete('SELECT * FROM niveau');

		$tabledata=array();

		$i=0;

		foreach ($niveau as $value) {

			$niv=array();

			  $i++;

			$niv[]=$i;

			$niv[]='<center><img src="'.base_url('assets/photo/pierre/').$value['image'].'" alt="photo" style="width:40px;height:40px;"></center>';
			$niv[]=$value['niveau_desc'];

			$niv[]='$ '.$value['cout_gift'];

			$niv[]=$value['statut']==1 ? 'Activé' : 'Desactivé' ;

			$options=' <div class="dropdown">
                              <span class="dropdown-toggle dropdown-bg btn btn-outline-primary" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                 <a class="dropdown-item" href="'.base_url('admin/Niveau/getOne/').$value['id_niveau'].'"><i class="ri-mark-pen-fill mr-2"></i>Modifier</a>';
                                 // '<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete'.$value['id_niveau'].'"><i class="ri-delete-bin-6-fill mr-2"></i><font class="text-danger">Supprimer</font></a>';

			            if ($value['statut']==1) {
							$options.='<a class="dropdown-item" href="#" data-toggle="modal" data-target="#statut'.$value['id_niveau'].'"><b class="class="text-success">Desactiver</b></a>';
							$titre="Voulez-vous vraiment desactiver ";	
							$stat=0;
				    	
						}else{

							$options.='<a class="dropdown-item" href="#" data-toggle="modal" data-target="#statut'.$value['id_niveau'].'"><b class="class="text-success">Activer</b></a>';;
							$titre="Voulez-vous vraiment activer ";
							$stat=1;					   
						}
                          
                          $options.='</div>
                           </div>
								<div class="modal fade" id="delete'.$value['id_niveau'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							      <h4 class="modal-title ">Suppression d\'un niveau</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        
							      </div>
							      <div class="modal-body">
							        <p>Voulez-vous vraiment Supprimer le : <b style="color:green">'.$value['niveau_desc'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('admin/Niveau/delete').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_niveau'].'">
								        <button type="button" class="btn btn-outline-default pull-left" data-dismiss="modal">Annuler</button>
								        <input type="submit" name="submit" class="btn btn-outline-danger" value="Supprimer">
							      </div>
							      </form>
							      
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->';

				$options.='<div class="modal fade" id="statut'.$value['id_niveau'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							      <h4 class="modal-title ">Changement de statut</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        
							      </div>
							      <div class="modal-body">
							        <p>'.$titre.' : <b style="color:green">'.$value['niveau_desc'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('admin/Niveau/statut').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_niveau'].'">
							      		<input type="hidden" name="STATUT" value="'.$stat.'">
								        <button type="button" class="btn btn-outline-default pull-left" data-dismiss="modal">Annuler</button>
								        <input type="submit" name="submit" class="btn btn-outline-primary" value="Changer">
							      </div>
							      </form>
							      
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->

								';

			$niv[]=$options;
	
			$tabledata[]=$niv;

		}



		$template = array(

			'table_open' => '<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed col-sm-12">',

			'table_close' => '</table>'

		);

		$this->table->set_template($template);

		$this->table->set_heading(array('#','IMAGE','NIVEAU','CADEAU','STATUT','ACTION'));

		$data['data']=$tabledata;

		

		$this->load->view('admin/Niveau_List_View',$data);

	}
	public function add()
	{
		$this->load->view('Niveau_add_View');
	}
	public function save()
	{
		$descr=$this->input->post('descr');
		$cadeau=$this->input->post('cadeau');
		$img=$this->upload_file($_FILES['img']['tmp_name'],$_FILES['img']['name']);

		$data_niveau = array('image' =>$img ,
							 'niveau_desc' =>$descr ,
							 'statut' =>1 ,
							 'cout_gift' =>$cadeau ,
							  );
		$this->Model->create('niveau',$data_niveau);

		$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('admin/Niveau/'));
	}

	public function getOne($id)
	{
		$data['niveau']=$this->Model->readOne('niveau',array('id_niveau'=>$id));
		$this->load->view('Niveau_Update_View',$data);
	}

	public function update()
	{
		$id=$this->input->post('id');
		$descr=$this->input->post('descr');
		$cadeau=$this->input->post('cadeau');
		$img=$this->upload_file($_FILES['img']['tmp_name'],$_FILES['img']['name']);

		$data_niveau = array('image' =>$img ,
								'niveau_desc' =>$descr ,
							 	'statut' =>1 ,
							 	'cout_gift' =>$cadeau ,
							  );
		$this->Model->update('niveau',array('id_niveau'=>$id),$data_niveau);

		$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('admin/Niveau/'));
	}

	public function delete()
	{
		$id=$this->input->post('ID');
		
		$delete=$this->Model->delete('niveau',array('id_niveau'=>$id));	
		
		$data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('admin/Niveau/'));
	}


	public function statut()
	{
		$ID = $this->input->post('ID');
		$STATUT = $this->input->post('STATUT');
		if ($STATUT==1) {

			$data = array('statut' =>$STATUT,'date_updated'=>date('Y-m-d H:i:s') );
       
        	$users=$this->Model->update('niveau',array('id_niveau'=>$ID),$data);
		}else{
			$data = array('statut' =>$STATUT,'date_updated'=>date('Y-m-d H:i:s') );
       
        	$users=$this->Model->update('niveau',array('id_niveau'=>$ID),$data);
		}

        
        $data['sms']='<div style="background-color:#42ba96" class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('admin/Niveau/'));
	}

	public function upload_file($nom_file,$nom_champ)

{

      $ref_folder =FCPATH.'assets/photo/pierre';

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
}
?>