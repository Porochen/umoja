<?php 
/**
 * 
 */
class Admin_Support extends MY_Controller
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
		$this->load->view('Admin_Received_Message_View');
	}

	public function reply($id,$id_notif)
	{
		$data['reply']=$this->Model->readRequeteOne("SELECT id_membre, nom_membre,prenom_membre,email_membre FROM membre WHERE id_membre=".$id." ") ;
		$data['message_to_reply']=$this->Model->readRequeteOne("SELECT * FROM notification WHERE id_notification=".$id_notif." ") ;
		$memberid=$this->session->userdata('memberid');

		$this->load->view('Admin_Reply_Message_View',$data);
	}
	public function send_message()
	{
		$id=$this->session->userdata('memberid');
		$id_member_rec=$this->input->post('id_member_rec');
		$subject=$this->input->post('subject');
		$message=$this->input->post('message');
		$id_notif=$this->input->post('id_notif');
		$data_send = array('subject' =>$subject ,
							'message'=>$message,
							'id_member_sender'=>$id,
							'user_title'=>2,
							'id_member_rec'=>$id_member_rec);
		$this->Model->create('notification',$data_send);

		$this->Model->update('notification',array('id_notification'=>$id_notif),array('is_replied'=>1));

		$message='<div style="background-color:#42ba96" class="alert alert-success text-center" id="sms">
        	Code envoyé avec succès.Merci</div>';

    	echo $message;

	}


	function listing(){

	$id=$this->session->userdata('memberid');
		
    $rec=$this->Model->readRequete("SELECT * FROM notification WHERE user_title=1  ORDER BY id_notification DESC") ;

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

     $data['received']=$this->Model->readRequete("SELECT * FROM notification WHERE user_title=1 AND is_replied=0 ORDER BY id_notification DESC") ;

	$sms_info=$this->load->view('admin/Admin_Search_Received_Message_View',$data,TRUE);
	     echo json_encode($sms_info);
 }

 public function sent_message()
	{
		$this->load->view('Admin_Sent_Support_View');
	}
	function listing_sent(){

	$id=$this->session->userdata('memberid');
		
    $data['sent']=$this->Model->readRequete("SELECT * FROM notification WHERE id_member_sender=".$id." ORDER BY id_notification DESC") ;

	$sent_info=$this->load->view('admin/Admin_Search_Sent_Support_View',$data,TRUE);
	     echo json_encode($sent_info);
 }

 public function compose()
	{
		$data['to']=$this->Model->readRequete("SELECT id_membre, nom_membre,prenom_membre FROM membre WHERE id_membre>1 ORDER BY nom_membre ASC") ;
		$this->load->view('Admin_Support_View',$data);
	}

	public function compose_send()
	{
		$id=$this->session->userdata('memberid');
		$smsto=$this->input->post('smsto');
		if ($smsto=="NULL") {
			$smsto=NULL;
		}
		$subject=$this->input->post('subject');
		$message=$this->input->post('message');
		$data_send = array('subject' =>$subject ,
							'message'=>$message,
							'id_member_sender'=>$id,
							'user_title'=>2,
							'id_member_rec'=>$smsto);
		$this->Model->create('notification',$data_send);

		$message='<div style="background-color:#42ba96" class="alert alert-success text-center" id="sms">
        	Message avec succès.Merci</div>';

    	echo $message;
	}

	
}