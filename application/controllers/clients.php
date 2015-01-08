<?php
class Clients extends CI_Controller {
    // Layout used in this controller
	public $layout_view = 'layout/default';
	
	function __construct() {
	      parent::__construct();
		  $this->load->library('layout');
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->lang->load('message', 'english');
		  $this->load->helper('event');
		 
	}
 
	//edit client user profile
	public function profile(){
	       
		   //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
		  } 
	      $this->load->model('client');
		  $client_data = $this->client->getClientById($this->session->userdata('client_id'));
		  
		   if($this->input->post()){
		   //checking post for changepassword
		    if( $this->input->post('act') == 'changepassword' ){
			  	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
                if($this->form_validation->run() == FALSE){
				 //form validation failed         
				}else{
				  $this->client->updateClientUser($this->session->userdata('client_id'),array('password'=>base64_encode($this->input->post('password'))));
				  $this->session->set_flashdata('success',$this->lang->line('account_edit'));
				  redirect('clients/profile');
				}
		    }
			
			if( $this->input->post('act') == 'editaccount' ){
			    $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
				$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
				if($this->form_validation->run() == FALSE){
				  //form validation failed   
				  $client_data[0]['email'] = $this->input->post('email');
				  $client_data[0]['contact_number'] = $this->input->post('contact_number');
				 
				}else{
			      //check this email address exists
				  $res = $this->client->emailDuplication($this->session->userdata('client_id'),$this->input->post('email'));
				  if(count($res) > 0 ){
				    $this->session->set_flashdata('error',$this->input->post('email')." - ".$this->lang->line('email_exists'));
				    redirect('clients/profile');
				  }else{
					$this->client->updateClientUser($this->session->userdata('client_id'),array('business'=>$this->input->post('business'),'movies'=>$this->input->post('movies'),'music'=>$this->input->post('music'),'age'=>$this->input->post('age'),'email'=>$this->input->post('email'),'newsletter'=>$this->input->post('newsletter')));
					$this->client->updateClient($this->session->userdata('client_id'),array('contact_number'=>$this->input->post('contact_number')));
					$this->session->set_flashdata('success',$this->lang->line('account_edit'));
				    redirect('clients/profile');
				  }
				
				}
			
			
			}
		   //end of password change check
		  }
          $this->layout->title('Edit Account');
		  $this->layout->view('client_profile',array('result' => $client_data[0]));
	}
	
	
	 public function myPosts(){
	 
	       //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
		  }
		  //$this->session->set_userdata('clientAuth', true);
	      $this->layout->title('My Posts');
		  $this->load->model('event');
		  $data['data'] = $this->event->loadMyPosts($this->session->userdata('client_id'));
	      $this->layout->view('client_only/my_posts',$data);
	 }
	 
	 public function myEarnings(){
	 
	       //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
		  }
		  //$this->session->set_userdata('clientAuth', true);
	      $this->layout->title('My Earnings');
		  $this->load->model('event');
		  $data['data'] = $this->event->loadMyPosts($this->session->userdata('client_id'));
	      $this->layout->view('client_only/my_earnings',$data);
	 }
	 
	  public function withdraw(){
	 
	       //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
		  }
		  //$this->session->set_userdata('clientAuth', true);
	      $this->layout->title('Withdrawal');
		  $this->load->model('event');
		  $data['data'] = $this->event->loadMyPosts($this->session->userdata('client_id'));
	      $this->layout->view('client_only/widthdraw',$data);
	 }
	 
	  	 
  
	  public function vendorProfile($id=0,$pid=0){
	    $this->pid = $pid;
	    if($id > 0){
		  $this->load->model('vendor');
  		  $out = $this->vendor->getVendorById($id);
		  $out_img = $this->vendor->getImages($id);
		  
		  if(count($out_img) > 0 ){
		   $out[0]['gal'] =  $out_img;
		  }else{
		    $out[0]['gal'] =  array();
		  }
		  
		  
		  $out_cat = $this->vendor->getCat($id);
		  
		  if(count($out_cat) > 0 ){
		   $out[0]['cat'] =  $out_cat;
		  }else{
		    $out[0]['cat'] =  array();
		  }
		  
		  $out_review = $this->vendor->getReview($id);
		  
		  if(count($out_review) > 0 ){
		   $out[0]['review'] =  $out_review;
		  }else{
		    $out[0]['review'] =  array();
		  }
       
    		  
		  if( count($out) > 0 ){
		    $out[0]['post_id'] = $pid;
		    $this->layout->title('Vendor Profile');
	        $this->layout->view('vendor_only/vendor_details',$out[0]);  
		  }else{
		    redirect(base_url());	
		  }
		}else{
		   redirect(base_url());		  
		}
	  }
 
	  public function deactivate(){
	       $this->load->model('client');
		    /*--------------------------------------------------------------------------------------------------------------*/
			         $ano = 'select clients.contact_name,users.email from users inner join clients on clients.user_id = users.id where clients.user_id='.$this->session->userdata('client_id');
			         $kout = $this->db->query($ano);
			         $res  = $kout->result_array();


			    /* $this->load->library('email');
				     $config['wordwrap'] = TRUE;
					 $config['mailtype'] = 'html';
				     $this->email->initialize($config);
                     $this->email->from( 'thoughtbase@thoughtbase.net', 'Thoughtbase.com' );
                     $this->email->to( $res[0]['email'] );
                     $this->email->subject('Thoughtbase.com - Your Account Deactivated successfully');
                     $this->email->message( $this->load->view('deact_message',array('name'=>$res[0]['contact_name']), true ) );
                     $this->email->send(); */
					 
					 
					  $this->load->library('phpmailer/PHPMailer');
					 $u_email     = $res[0]['email'];
					 $headers     = "MIME-Version: 1.0\r\n";
                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";
                     $to          = $u_email;
                     $bodyOfMessage =  $this->load->view('deact_message',array('name'=>$res[0]['contact_name']), true );
	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 
	                 $mail->SingleTo = true; 
	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');
	                 $mail->Subject = 'Thoughtbase.com - Your Account Deactivated successfully';
	                 $mail->Body    = $bodyOfMessage;
	                 $mail->AddAddress($u_email);
	                 $mail->Send();
					 
			/*--------------------------------------------------------------------------------------------------------------*/
		   $this->client->updateClientUser($this->session->userdata('client_id'),array('disable_flag'=>1));
		   $this->session->set_flashdata('success','Your account deactivated successfully');
		   $this->session->sess_destroy();
		   redirect('main/clientLogin');
	  }
	  
	  
	  
	  
	  
	  //edit client user profile
	public function payment() {
	       
		   //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
		  } 
	      $this->load->model('client');
		  $client_data = $this->client->getClientById($this->session->userdata('client_id'));		  
		   if($this->input->post()){
		   //checking post for changepassword	
			if( $this->input->post('act') == 'editaccount' ){
			    $this->form_validation->set_rules('pemail', 'Paypal Email Address', 'trim|required');
				if($this->form_validation->run() == FALSE){
				  //form validation failed   
				  $client_data[0]['pemail'] = $this->input->post('pemail');				 
				}else{
	   				$this->client->updateClientUser($this->session->userdata('client_id'),array('pemail'=>$this->input->post('pemail')));
					$this->session->set_flashdata('success','settings changed successfully');
				    redirect('clients/payment');			
				}	
			}
		   //end of password change check
		  }
	      $this->layout->title('Edit Payment settings');
		  $this->layout->view('client_payment',array('result' => $client_data[0]));
	}
	  
	  
	  
}