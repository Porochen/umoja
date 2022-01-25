<?php 
/**
 * 
 */
class Users_Support extends MY_Controller
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

	public function index()
	{
		$id=$this->session->userdata('memberid');

		$data['mbr']=$this->Model->readRequeteOne('SELECT nom_membre,prenom_membre,email_membre FROM membre WHERE id_membre='.$id);

		$this->load->view('Users_Support_View',$data);
	}

	public function send_message()
	{
		$id=$this->session->userdata('memberid');
		$subject=$this->input->post('subject');
		$message=$this->input->post('message');
		$data_send = array('subject' =>$subject ,
							'message'=>$message,
							'id_member_sender'=>$id,
							'user_title'=>1,
							'id_member_rec'=>1);
		$this->Model->create('notification',$data_send);

		$message='<div style="background-color:#42ba96" class="alert alert-success text-center" id="sms">
        	Message envoyé avec succès.Merci</div>';

    	echo $message;

	}

	public function sent_message()
	{
		$this->load->view('Sent_Support_View');
	}
	function listing(){

	$id=$this->session->userdata('memberid');
		
    $data['sent']=$this->Model->readRequete("SELECT * FROM notification WHERE id_member_sender=".$id." ORDER BY id_notification DESC") ;

	$sms_info=$this->load->view('admin/Sent_Support_Search_View',$data,TRUE);
	     echo json_encode($sms_info);
 }

	public function box_message()
	{	
		
		$this->load->view('Box_Support_View');

	}

	function listing_box(){

	$id=$this->session->userdata('memberid');

	$rec=$this->Model->readRequete("SELECT * FROM notification WHERE id_member_rec=".$id." OR id_member_rec IS NULL ORDER BY id_notification DESC") ;

    foreach ($rec as $value) {
    	$read_by='';
    	$sender=$value['id_member_sender'];

    	$reada=$this->Model->readRequeteOne("SELECT * FROM notification WHERE id_member_sender=".$sender." AND id_notification=".$value['id_notification']) ;
    	
    		$read_by=$reada['read_by'].','.$id;

    		if ($value['id_member_rec']==NULL) {
    			$statut_sms=0;
    		}else{
    			$statut_sms=1;
    		}
    	

 		$change = array('statut_sms' =>$statut_sms,
 						'date_read'=>date('Y-m-d H:i:s'),
 						'read_by' =>$read_by);

 		$array=explode(',', $value['read_by']);
 		if (in_array($id,$array)) {
                   //on ne fait rien
            }else{
            	$this->Model->update('notification',array('id_member_sender'=>$sender,'id_notification'=>$value['id_notification']),$change);
            }

 		
    	
    }
		
    $data['received']=$this->Model->readRequete("SELECT * FROM notification WHERE id_member_rec IS NULL OR id_member_rec=".$id."  ORDER BY id_notification DESC") ;

	$sms_info=$this->load->view('admin/Box_Search_Support_View',$data,TRUE);
	     echo json_encode($sms_info);
 }


 public function notification()
 {
 	$id=$this->session->userdata('memberid');
 	$user_title=$this->session->userdata('user_title');
 	$read_by=','.$id;

 	$select=$this->Model->readRequete("SELECT * FROM notification WHERE user_title!=".$user_title." AND id_member_rec=".$id."  OR id_member_rec IS NULL") ;
	$noread=0;
 	foreach ($select as $key) {

 		if ($key['id_member_rec']==NULL) {

 			if ($user_title==1) {
 			
 			if ($key['read_by']==NULL) {
 				$rec=$this->Model->readRequeteOne("SELECT COUNT(*) AS noread FROM notification WHERE  statut_sms=0   AND id_notification=".$key['id_notification']) ;
	 			$noread=$noread+$rec['noread'];
 			}else{
 				$array=explode(',', $key['read_by']);

	 			if (in_array($id,$array)) {
	 				$noread=$noread+0;
	 			}else{
	 				$rec=$this->Model->readRequeteOne("SELECT COUNT(*) AS noread FROM notification WHERE  statut_sms=0   AND id_notification=".$key['id_notification']) ;
	 			$noread=$noread+$rec['noread'];
	 			}
 			}
 				// code...
 			}
 			//
 			
 			
    			
    		}else{
    			
    			$rec=$this->Model->readRequeteOne("SELECT COUNT(*) AS noread FROM notification WHERE id_member_rec=".$id." AND statut_sms=0 AND user_title!=".$user_title." AND is_replied=0 AND id_notification=".$key['id_notification']) ;
    			$noread=$noread+$rec['noread'];
    		}
 	}
 	
 
 	$nbr='';
 	if (empty($select)) {
 		$nbr='<span class="badge float-right" style="background-color:#4BB543;"><b class="text-white">0</b></span>';
 	}else{
 		$nbr='<span class="badge float-right" style="background-color:#4BB543;"><b class="text-white">'.$noread.'</b></span>';
 	}


 	 echo json_encode($nbr);
 }


}