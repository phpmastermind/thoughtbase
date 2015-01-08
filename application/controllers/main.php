<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');   

class Main extends CI_Controller {

    // Layout used in this controller

	public $layout_view = 'layout/default';

	

	function __construct() {

	      parent::__construct();

		  $this->load->library('layout');

		  $this->load->helper('url');

		  $this->load->library('session');

		  $this->lang->load('message', 'english');

	}

 

	   public function index() {

	      $this->layout->title('Home');

	      $this->layout->view('home');

	   }

	   

	   public function newPost($id=0){

	      $data['id'] = $id;

 		  $this->load->model('event');

		  $this->load->model('client');

    	  //checking post belong to user

		  if( $data['id'] > 0 ){

		     if(!$this->session->userdata('clientAuth')){

			      redirect('main/index');			 

			 }else{

			      $temp = $this->event->getPost($data['id'],$this->session->userdata('client_id'));

  		          $client_data_no = $this->client->getClientById($this->session->userdata('client_id'));

				  if(! count($temp) > 0){

				    redirect('main/index');

				  }else{

						

						$data['eventSubType'] = $temp[0]['sub_event_type'];

				 	    $out_temp =	$this->event->getParentEvent($data['eventSubType']);

						$data['eventType']    = isset($out_temp[0]['me_id']) ? $out_temp[0]['me_id'] :'';

     					$data['category']     = $temp[0]['vendor_cat_id'];

						$data['delivery_dt']  = $temp[0]['date'];

						$data['address'] = $temp[0]['address'];

						$data['post_unit'] = $temp[0]['post_unit'];

						$data['budget'] = $temp[0]['budget'];

						$data['quantity'] = $temp[0]['unit'];

						$data['total'] = $temp[0]['unit']*$temp[0]['budget'];

						$data['contact_number'] = $client_data_no[0]['contact_number'];

						$data['contactTime'] = $temp[0]['contact'];

						$data['description'] = $temp[0]['addi_req'];	

						$sub_events = $this->event->getSubTypes($data['eventType']);

						 $options ='<option value=""></option>';

						 if(count($sub_events) > 0 ){

						   foreach($sub_events as $row => $val){

							if($data['eventSubType'] == $val['event_id'] ){

							   $options .='<option selected value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

							}else{

							  $options .='<option  value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

							}

						   }

						 }

						 $data['options'] = $options;  

						

				  }

			 }

		  }

	      //fetching events types informatiom



		  //checking usr session to populate contact number

		  if($this->session->userdata('clientAuth')){

		     $user_data = $this->client->getClientById($this->session->userdata('client_id'));

			 $data['contact_no'] = isset($user_data[0]['contact_number']) ? $user_data[0]['contact_number'] :''; 

		  }else{

			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|is_unique[users.email]');

			$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			$this->form_validation->set_rules('userName', 'Username', 'trim|required');

		    $data['contact_no'] ='';

		  }

		  $data['main_event_type'] = $this->event->getAll();

	      $data['vendor_cat'] = $this->event->getAllVendorCat();

	  

		  if( ($this->input->post('act')) &&  ($this->input->post('act') =='post') ){

             $data['eventType'] = $this->input->post('eventType');

			 $data['eventSubType'] = $this->input->post('eventSubType');

			 $data['category'] = $this->input->post('category');

			 $data['delivery_dt'] = $this->input->post('delivery_dt');

			 $data['address'] = $this->input->post('address');

 			 $data['post_unit'] = $this->input->post('post_unit');

			 $data['budget'] = $this->input->post('budget');

			 $data['quantity'] = $this->input->post('quantity');

			 $data['total'] = $this->input->post('total');

			 $data['contact_number'] = $this->input->post('contact_number');

			 $data['contactTime'] = $this->input->post('contactTime');

 			 $data['description'] = $this->input->post('description');

		     //set validation error message here

 			$this->form_validation->set_rules('eventType', 'Event Type', 'trim|required');

			$this->form_validation->set_rules('eventSubType', 'Plan', 'trim|required');

			$this->form_validation->set_rules('category', 'Looking for', 'trim|required');

			$this->form_validation->set_rules('delivery_dt', 'Delivery date', 'trim|required');

    		$this->form_validation->set_rules('address', 'Address', 'trim|required');

			$this->form_validation->set_rules('budget', 'Budget', 'trim|required');

			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');

            $this->form_validation->set_rules('total', 'Total', 'trim|required');

			$this->form_validation->set_rules('post_unit', 'Unit', 'trim|required');



			

			

    		if($this->form_validation->run() == FALSE){

			 $data['eventType'] = $this->input->post('eventType');

			 $data['eventSubType'] = $this->input->post('eventSubType');

			 $data['category'] = $this->input->post('category');

			 $data['delivery_dt'] = $this->input->post('delivery_dt');

			 $data['address'] = $this->input->post('address');

			 $data['post_unit'] = $this->input->post('post_unit');

			 $data['budget'] = $this->input->post('budget');

			 $data['quantity'] = $this->input->post('quantity');

			 $data['total'] = $this->input->post('total');

			 $data['contact_number'] = $this->input->post('contact_number');

			 $data['contactTime'] = $this->input->post('contactTime');

 			 $data['description'] = $this->input->post('description');

			 

			 if( ! $this->session->userdata('clientAuth')){

			   $data['email'] = $this->input->post('email');

			   $data['contact_number'] = $this->input->post('contact_number');

			   $data['userName'] = $this->input->post('userName');

			 }



			 

			 //loding subcategories of event

			 $sub_events = $this->event->getSubTypes($data['eventType']);

			 $options ='<option value=""></option>';

			 if(count($sub_events) > 0 ){

			   foreach($sub_events as $row => $val){

			    if($data['eventSubType'] == $val['event_id'] ){

			       $options .='<option selected value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

			    }else{

				  $options .='<option  value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

				}

			   }

			 }

			 $data['options'] = $options;

			 //form validation failed         

			}else{

			  //registration

			  if( ! $this->session->userdata('clientAuth')){

			      $clientId = $this->client->insertClient(array('email' =>$this->input->post('email'),'password' => $this->input->post('password'),'register_date'=> date('Y-m-d H:i:s') , 'disable_flag' => 0 ));

				  //inserting in to client table

				  $clientData = array('user_id'=> $clientId,'contact_name'=>$this->input->post('userName'),'contact_number'=>$this->input->post('contact_number'));

				  $this->client->insertClientTable($clientData);

 				  $this->session->set_userdata('clientAuth', true);

				  $this->session->set_userdata('client_id', $clientId);

				  $this->session->set_userdata('client_name', $this->input->post('userName') );

			  }//

			  

			  		

			

			  //valid form

			  //$db['main_event_type'] = $data['eventType'];

			  $db['sub_event_type'] = $data['eventSubType'];

			  $db['vendor_cat_id'] = $data['category'];

			  $db['date'] = $data['delivery_dt'];

			  $db['address'] = $data['address'];

 			  $db['post_unit'] = $data['post_unit'];

			  $db['budget']     = $data['budget'];

			  $db['unit']      = $data['quantity'];

			  $db['addi_req'] = $data['description'];

			  $db['contact'] = $data['contactTime'];

			  $db['user_id'] = $this->session->userdata('client_id');

			  $db['submitted_date'] = date('Y-m-d H:i:s');

			  if($data['id'] > 0 ){

			   //update condition

			   	$this->session->set_flashdata('success',$this->lang->line('post_update'));

			    $this->event->updatePost($data['id'],$db);

			  }else{

			   //add condition

			    $this->session->set_flashdata('success',$this->lang->line('post_insert'));

			    $this->event->insertPost($db);

			   	   

			  }

			  //redirect to client post page

			  redirect('clients/myPosts');

			

			}

          }		  

	  

		  

	      $this->layout->title('Get Quotes');

	      $this->layout->view('newPost',$data);

		  //$this->layout->view('newPostWiz',$data);

	   }

	   

	   public function clientLogin() {

	   

	      //already logged in redirct to home page

	      if($this->session->userdata('clientAuth')){

		    redirect('main/index');

		  }

	   

		  

			    //setting formvalidation rules

				$this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|required');

				$this->form_validation->set_rules('password', 'Password', 'trim|required');

		        if($this->form_validation->run() == FALSE){

				 //form validation failed         

				}else{

				  //formvalidation success check login credentials

				  $this->load->model('client');

				  $client_dat = $this->client->getClient($this->input->post('email'),$this->input->post('password'));

				  

			  

				  if( count($client_dat) > 0){

				     //login success

					 $this->session->set_userdata('clientAuth', true);

					 $this->session->set_userdata('client_id', $client_dat[0]['id']);

					 $this->session->set_userdata('client_name', $client_dat[0]['contact_name']);

				     redirect('clients/myPosts');

				  }else{

				     //login error

				     $this->session->set_flashdata('error',$this->lang->line('login_failed'));

					 redirect('main/clientLogin');

				  }

				

				}

	      $this->layout->title('Login');

	      $this->layout->view('client_login');

	   }

	   

	   

	   //vendor login

	   public function vendorLogin() {

	   

	      //already logged in redirct to home page

	      if($this->session->userdata('vendorAuth')){

		    redirect('main/index');

		  }

	   

			    //setting formvalidation rules

				$this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|required');

				$this->form_validation->set_rules('password', 'Password', 'trim|required');

		        if($this->form_validation->run() == FALSE){

				 //form validation failed         

				}else{

				  //formvalidation success check login credentials

				  $this->load->model('vendor');

				  $vendor_dat = $this->vendor->getVendor($this->input->post('email'),$this->input->post('password'));

				  

			  

				  if( count($vendor_dat) > 0){

				     //login success

					 $this->session->set_userdata('vendorAuth', true);

					 $this->session->set_userdata('vendor_id', $vendor_dat[0]['id']);

					 $this->session->set_userdata('name', $vendor_dat[0]['name']);

				     redirect('vendors/dashboard');

				  }else{

				     //login error

				     $this->session->set_flashdata('error',$this->lang->line('login_failed'));

					 redirect('main/vendorLogin');

				  }

				

				}

	      $this->layout->title('Vendor Login');

	      $this->layout->view('vendor_login');

	   }

	   

	   

	   public function clientRegister() {

	         

			//checking for register post

			if($this->input->post()){

			    //setting formvalidation rules

				$this->form_validation->set_rules('email', 'Email Address', 'trim|required|is_unique[users.email]');

				$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');

				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

				$this->form_validation->set_rules('userName', 'Username', 'trim|required');

				$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|matches[ocaptcha]');

				$this->form_validation->set_rules('ocaptcha', 'Verify image letters', 'trim|required');

				

				

				if($this->form_validation->run() == FALSE){

				  //form validation failed         

				}else{

				  unset($_POST['captcha']);

				  unset($_POST['ocaptcha']);

				  //formvalidation success redirect to client dashboard after update

				  $this->load->model('client');

				  //inserting in to user table

				  $clientId = $this->client->insertClient($this->input->post());

				  //inserting in to client table

				  $clientData = array('user_id'=> $clientId,'contact_name'=>$this->input->post('userName'),'contact_number'=>$this->input->post('contact_number'));

				  $this->client->insertClientTable($clientData);

				  /*---------------------------------------------------*/

				    /* $this->load->library('email');

				     $config['wordwrap'] = TRUE;

					 $config['mailtype'] = 'html';

				     $this->email->initialize($config);

                     $this->email->from('thoughtbase@thoughtbase.net', 'Thoughtbase.com' );

                     $this->email->to( $this->input->post('email') );

                     $this->email->subject( 'Thoughtbase.com - Registration Confirmation' );

                     $this->email->message( $this->load->view( 'message',array('name'=>$this->input->post('userName'),'id'=>base64_encode($clientId)), true ) );

                     $this->email->send();

             		 redirect('main/confirm_email'); */

					 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $this->input->post('email');

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                     $bodyOfMessage = $this->load->view( 'message',array('name'=>$this->input->post('userName'),'id'=>base64_encode($clientId)), true );

	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "Thoughtbase.com - Registration Confirmation";

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	

                     redirect('main/confirm_email');					 

				}

			}//end of post check

			$this->load->helper('captcha');

			$this->load->helper('string');

			$vals = array(

               'word'	=> strtolower(random_string('alpha', 4)),

               'img_path'	=> './captcha/',

               'img_url'	=> base_url().'captcha/',

               'img_width'	=> '150',

               'img_height' => '30',

               'expiration' => 7200

            );

			

			



            $cap = create_captcha($vals);

			$this->layout->title('Register');

			$this->layout->view('client_register',$cap);

	   }
	   
	   
	   
	   
	     public function advtRegister() {

	         

			//checking for register post

			if($this->input->post()){

			    //setting formvalidation rules

				$this->form_validation->set_rules('email', 'Email Address', 'trim|required|is_unique[users.email]');
				$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
				$this->form_validation->set_rules('userName', 'Username', 'trim|required');
				$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|matches[ocaptcha]');
				$this->form_validation->set_rules('ocaptcha', 'Verify image letters', 'trim|required');
				if($this->form_validation->run() == FALSE){
				  //form validation failed         
				}else{

				  unset($_POST['captcha']);

				  unset($_POST['ocaptcha']);

				  //formvalidation success redirect to client dashboard after update

				  $this->load->model('client');

				  //inserting in to user table

				  $clientId = $this->client->insertClient($this->input->post());

				  //inserting in to client table

				  $clientData = array('user_id'=> $clientId,'contact_name'=>$this->input->post('userName'),'contact_number'=>$this->input->post('contact_number'));

				  $this->client->insertClientTable($clientData);

				  /*---------------------------------------------------*/

				    /* $this->load->library('email');

				     $config['wordwrap'] = TRUE;

					 $config['mailtype'] = 'html';

				     $this->email->initialize($config);

                     $this->email->from('thoughtbase@thoughtbase.net', 'Thoughtbase.com' );

                     $this->email->to( $this->input->post('email') );

                     $this->email->subject( 'Thoughtbase.com - Registration Confirmation' );

                     $this->email->message( $this->load->view( 'message',array('name'=>$this->input->post('userName'),'id'=>base64_encode($clientId)), true ) );

                     $this->email->send();

             		 redirect('main/confirm_email'); */

					 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $this->input->post('email');

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                     $bodyOfMessage = $this->load->view( 'message',array('name'=>$this->input->post('userName'),'id'=>base64_encode($clientId)), true );

	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "Thoughtbase.com - Registration Confirmation";

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	

                     redirect('main/confirm_email');					 

				}

			}//end of post check

			$this->load->helper('captcha');

			$this->load->helper('string');

			$vals = array(

               'word'	=> strtolower(random_string('alpha', 4)),

               'img_path'	=> './captcha/',

               'img_url'	=> base_url().'captcha/',

               'img_width'	=> '150',

               'img_height' => '30',

               'expiration' => 7200

            );

			

			



            $cap = create_captcha($vals);

			$this->layout->title('Register');

			$this->layout->view('client_register',$cap);

	   }

	   

	   

	    //vendor register 

	    public function vendorRegister(){

			//checking for register post

			if($this->input->post()){

			    //setting formvalidation rules

				$this->form_validation->set_rules('email', 'Email Address', 'trim|required|is_unique[users.email]');

				$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');

				$this->form_validation->set_rules('company', 'Company Name', 'trim|required');

				$this->form_validation->set_rules('uen', 'Business Registration Number', 'trim|required');

				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

				$this->form_validation->set_rules('userName', 'Username', 'trim|required');

				if($this->form_validation->run() == FALSE){

				 //form validation failed         

				}else{

				  //formvalidation success redirect to client dashboard after update

				  $this->load->model('vendor');

				  //inserting in to user table

				  $vendorId = $this->vendor->insertVendor($this->input->post());

				  //inserting in to vendor table

				  $vendorData = array('user_id'=> $vendorId,'name'=>$this->input->post('userName'),'contact_number'=>$this->input->post('contact_number'),'company_name'=>$this->input->post('company'),'uen'=>$this->input->post('uen'));

				  $this->vendor->insertVendorTable($vendorData);
				  
				  
				  	 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $this->input->post('email');

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                     $bodyOfMessage = $this->load->view( 'message1',array('name'=>$this->input->post('userName'),'id'=>base64_encode($vendorId)), true );

	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "Thoughtbase.com - Registration Confirmation";

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	

                     redirect('main/confirm_email');	

				 /* 
				    $this->session->set_flashdata('success',$this->lang->line('registration_success'));
			        redirect('main/vendorLogin');*/
				  
				  
				  

				}

			}//end of post check

			$this->layout->title('Advertiser Register');

			$this->layout->view('vendor_register');

	   }

	   

	   

	   public function clientLoginAuth() {

	      $this->session->set_userdata('clientAuth', true);

	      $this->layout->title('My Posts');

	      $this->layout->view('client_only/my_posts'); 

	   }

	  

	   public function logout() {

		  $this->session->sess_destroy();

	      redirect(site_url(), 'refresh');

	   }

	   

	   public function ajaxSubEvents(){

 		  $options ='<option value=""></option>';

	      if(isset($_POST['id'])  && $_POST['id'] > 0  ){

		     $this->load->model('event');

		     $sub_events = $this->event->getSubTypes($_POST['id']);

			 if(count($sub_events) > 0 ){

			   foreach($sub_events as $row => $val){

			    $options .='<option value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

			   }

			 }

		  }

		  echo $options;

	   }

	   

	   public function confirm_email(){

		 $this->layout->title('Confirm Email');

	     $this->layout->view('client_only/confirm_email');  

	   }

	   

	   

	   public function forgot_password(){

		 $this->layout->title('Forgot Password');

		 if($this->input->post()){

		  $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

		  if($this->form_validation->run() == FALSE){

				 //form validation failed         

		  }else{

		    //checking email exists in database

			$sql ="select * from users where email ='".$this->input->post('email')."'";

			$temp = $this->db->query($sql);

			$out  = $temp->result_array();

			if( count($out) > 0 ){

			  //get user name

			  $uquery ="select contact_name from clients where user_id =".$out[0]['id'];

			  $itemp = $this->db->query($uquery);

			  $uout  = $itemp->result_array();

			  //sending password

			  /*---------------------------------------------------*/

				    /* $this->load->library('email');

				     $config['wordwrap'] = TRUE;

					 $config['mailtype'] = 'html';

				     $this->email->initialize($config);

                     $this->email->from( 'thoughtbase@thoughtbase.net', 'Thoughtbase.com' );

                     $this->email->to( $out[0]['email'] );

                     $this->email->subject( 'Thoughtbase.com - Password Recovery' );

                     $this->email->message( $this->load->view( 'password_message',array('name'=>$uout[0]['contact_name'],'password'=>base64_decode($out[0]['password'])), true ) );

                     $this->email->send(); */

					 

					 

					 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $out[0]['email'];

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                     $bodyOfMessage = $this->load->view( 'password_message',array('name'=>$uout[0]['contact_name'],'password'=>base64_decode($out[0]['password'])), true );

	                 $mail = new PHPMailer();

	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "Thoughtbase.com - Password Recovery";

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	

			  /*---------------------------------------------------*/

			

			  $this->session->set_flashdata('success','Password has been sent to your email address.If you do not receive the email within a few minutes, please check your Junk , Spam E-mail folder just in case the email got delivered there instead of your inbox');

			  redirect('main/clientLogin');

			}else{

			  $this->session->set_flashdata('error','The email address you specified is not in system data.');

			  redirect('main/forgot_password');

			}

		

		  }

			 

		 }

		 $this->layout->view('forgotpassword');  

	   }

	   

	   

	   public function confirm($id=''){

	     if($id !=""){

		    $id  = base64_decode($id);

			$sql = "UPDATE users SET disable_flag=0 where id=".$id;

			$this->db->query($sql);

			

			$ano = 'select clients.contact_name,users.email from users inner join clients on clients.user_id = users.id where users.id ='.$id;

			$kout = $this->db->query($ano);

			$res  = $kout->result_array();

			

			 /*--------------------------------------------------------------------------------------------------------------*/

				    /* $this->load->library('email');

				     $config['wordwrap'] = TRUE;

					 $config['mailtype'] = 'html';

				     $this->email->initialize($config);

                     $this->email->from( 'thoughtbase@thoughtbase.net', 'Thoughtbase.com' );

                     $this->email->to( $res[0]['email'] );

                     $this->email->subject( 'Thoughtbase.com - Your Account activated successfully');

                     $this->email->message( $this->load->view( 'confirm_message',array('name'=>$res[0]['contact_name']), true ) );

                     $this->email->send(); */

					 

					 

					 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $res[0]['email'];

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                     $bodyOfMessage =  $this->load->view( 'confirm_message',array('name'=>$res[0]['contact_name']), true );

	                 $mail = new PHPMailer();

	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "Thoughtbase.com - Your Account activated successfully";

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	

			/*--------------------------------------------------------------------------------------------------------------*/

			

			$this->session->set_flashdata('success','your account is activated please login to continue');

			redirect('main/clientLogin');

		 }else{

		    redirect(base_url());

		 }

	   }
	   
	   
	   
	   
	    public function confirm1($id=''){

	     if($id !=""){

		    $id  = base64_decode($id);

			$sql = "UPDATE users SET disable_flag=0 where id=".$id;

			$this->db->query($sql);

			
/*
			$ano = 'select clients.contact_name,users.email from users inner join clients on clients.user_id = users.id where users.id ='.$id;

			$kout = $this->db->query($ano);

			$res  = $kout->result_array();

			*/

			 /*--------------------------------------------------------------------------------------------------------------*/

				    /* $this->load->library('email');

				     $config['wordwrap'] = TRUE;

					 $config['mailtype'] = 'html';

				     $this->email->initialize($config);

                     $this->email->from( 'thoughtbase@thoughtbase.net', 'Thoughtbase.com' );

                     $this->email->to( $res[0]['email'] );

                     $this->email->subject( 'Thoughtbase.com - Your Account activated successfully');

                     $this->email->message( $this->load->view( 'confirm_message',array('name'=>$res[0]['contact_name']), true ) );

                     $this->email->send(); */

					 

					 /*

					 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $res[0]['email'];

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                     $bodyOfMessage =  $this->load->view( 'confirm_message',array('name'=>$res[0]['contact_name']), true );

	                 $mail = new PHPMailer();

	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "Thoughtbase.com - Your Account activated successfully";

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	
*/
			/*--------------------------------------------------------------------------------------------------------------*/

			

			$this->session->set_flashdata('success','your account is activated please login to continue');

			redirect('main/vendorLogin');

		 }else{

		    redirect(base_url());

		 }

	   }

	   

	   

	   

}