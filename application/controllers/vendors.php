<?php
class Vendors extends CI_Controller {
    // Layout used in this controller
	public $layout_view = 'layout/default';
	
	function __construct() {
	      parent::__construct();
		  $this->load->library('layout');
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->lang->load('message', 'english');
		  $this->load->helper('event');
		  //checking user session if not redirect to login
		  if(!$this->session->userdata('vendorAuth')){
		    redirect('main/vendorLogin');
		  }
	}
 
	//edit client user profile
	public function profile() {
	      $this->load->model('vendor');
		  $vendor_data = $this->vendor->getVendorById($this->session->userdata('vendor_id'));
    	 
		 if($this->input->post()){
		   //checking post for changepassword
		    if( $this->input->post('act') == 'changepassword' ){
			  	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
                if($this->form_validation->run() == FALSE){
				 //form validation failed         
				}else{
				  $this->vendor->updateVendorUser($this->session->userdata('vendor_id'),array('password'=>base64_encode($this->input->post('password'))));
				  $this->session->set_flashdata('success',$this->lang->line('account_edit'));
				  redirect('vendors/profile');
				}
		    }
			
			if( $this->input->post('act') == 'editaccount' ){
				  $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
				  $this->form_validation->set_rules('company', 'Company Name', 'trim|required');
				  $this->form_validation->set_rules('uen', 'Business Registration Number', 'trim|required');
				  $this->form_validation->set_rules('userName', 'Username', 'trim|required');
				if($this->form_validation->run() == FALSE){
				  //form validation failed   
				}else{
			      //check this email address exists
				  $this->vendor->updateVendor($this->session->userdata('vendor_id'),
				  array('contact_number'=>$this->input->post('contact_number'),'company_name'=>$this->input->post('company'),'uen'=>$this->input->post('uen'),'name'=>$this->input->post('userName')));
				  $this->session->set_flashdata('success',$this->lang->line('account_edit'));
				  redirect('vendors/profile');
				}		
			}
		   //end of password change check
		  }
	      $this->layout->title('Edit Account');
		  $this->layout->view('vendor_profile',array('result' => $vendor_data[0]));
	}
	
    public function dashboard(){
	    $this->load->model('vendor');
	    $vendor = $this->vendor->getVendorById($this->session->userdata('vendor_id'));
		if(!count($vendor) > 0 ){
		    redirect('main/index');
		}
		
		$this->load->model('event');
		$data['data'] = $this->event->loadPosts();
	    $this->layout->title('My Dashboard');
	    $this->layout->view('vendor_only/vendor_dashboard',array('profile'=>$vendor[0],'result' => $data['data'] )); 
    }	
	
	public function vendorProfile(){
	    $this->load->model('vendor');
	    $vendor = $this->vendor->getVendorById($this->session->userdata('vendor_id'));
		if(!count($vendor) > 0 ){
		    redirect('main/index');
		}
		
		$vct = $this->vendor->vendorCatType();
		$vc  = $this->vendor->vendorCat();
				
	    $this->layout->title('Profile');
	    $this->layout->view('vendor_only/vendor_profile',array('profile'=>$vendor[0],'ctype'=>$vct,'cat'=>$vc)); 
    }	
	
	public function logoupload(){
	  if(isset($_POST['act']) && $_POST['act'] == 'logo'){
	     if(isset($_FILES['logo']['name']) && $_FILES['logo']['name']!="" ){
		    $ext = strtolower(end(explode('.',$_FILES['logo']['name'])));
			$et  = array('png','gif','jpg','jpeg');
		    if(!in_array($ext,$et))
			{
			    $this->session->set_flashdata('error',$this->lang->line('image_empty'));
			    redirect('vendors/vendorProfile');
			}
			else
			{
			   if( $_POST['pre_logo'] !=""){
			     @unlink(SITE_ROOT.'/uploads/vendor/'.$_POST['pre_logo']);
			   }
			   $name = time().$_FILES['logo']['name'];
			   $this->load->model('vendor');
			   $this->vendor->updateVendor($this->session->userdata('vendor_id'),array('logo' => $name ));
			   move_uploaded_file($_FILES["logo"]["tmp_name"], SITE_ROOT.'/uploads/vendor/'.$name );
			   $this->session->set_flashdata('success',$this->lang->line('image_upload'));
			   redirect('vendors/vendorProfile');   
			}	 
		 }
		 else
		 {
		    $this->session->set_flashdata('error',$this->lang->line('image_empty'));
			redirect('vendors/vendorProfile');
		 
		 }
		 
		 
		 
		 
	  }  
	}
	
	public function updatepro(){
	  if(isset($_POST)){
	  
	     if($_POST['catType']=="" || (!isset($_POST['cat'])) || (isset($_POST['cat'][0]) && $_POST['cat'][0] ==""  )  ){
		   $this->session->set_flashdata('error',$this->lang->line('vendor_cat_mess'));
		   redirect('vendors/vendorProfile');
		   exit;
		 }
	  
	     $this->load->model('vendor');
		 $vendor_cat_type = $_POST['catType'];
		 $vendor_cat = $_POST['cat'];
		 
		 $this->vendor->deleteVendorCatList($this->session->userdata('vendor_id'));
		 
     	 foreach($vendor_cat as $row => $val ){
		   
		   $this->vendor->insertVendorCatList(array('vendor_id'=> $this->session->userdata('vendor_id'),'category_id' => $val ));
		 }
		 
		 unset($_POST['catType']);
		 unset($_POST['cat']);
		 
		 $this->vendor->updateVendor($this->session->userdata('vendor_id'),$_POST);
	     $this->session->set_flashdata('success',$this->lang->line('image_empty'));
		}	
		redirect('vendors/vendorProfile');
			
	}
	
	
	 public function ajaxSubCat(){
 		  $options ='<option value=""></option>';
	      if(isset($_POST['id'])  && $_POST['id'] > 0  ){
		     $this->load->model('vendor');
		     $sub_events = $this->vendor->vendorCatId($_POST['id']);
			 
			  $this->load->database();
			  $out = $this->db->query('select vendor_cat_list.*,vendor_categories.*,vendor_category_types.* from vendor_cat_list 
			  left join vendor_categories on category_id = vc_id
			  left join vendor_category_types on vc_parent = cat_id
			  where vendor_id='.$this->session->userdata('vendor_id'));
			  $res = $out->result_array();
			  $dim =array();
			  if(count( $res > 0 )){
			    if(isset($res[0]['vc_parent']) == $_POST['id'] ){
				  foreach($res as $key => $val ){
				    $dim[] = $val['vc_id'];
                  }				  			
				}
			  }
			  
			 
			 if(count($sub_events) > 0 ){
			   foreach($sub_events as $row => $val){
			     if(in_array($val['vc_id'],$dim)){
				  $options .='<option value="'.$val['vc_id'].'" selected >'.$val['vc_name'].'</opion>';
				 }else{
			      $options .='<option value="'.$val['vc_id'].'">'.$val['vc_name'].'</opion>';
				}
			   }
			 }
		  }
		  echo $options;
	   }
	   
	   
	   
	  public function glogoupload(){
	  if(isset($_POST['act']) && $_POST['act'] == 'logo'){
	   
	     
	  
	  
	     if(isset($_FILES['logo']['name']) && count($_FILES['logo']['name']) > 0 ){
		 
		    for($i=0;$i< count($_FILES['logo']['name']) ; $i++ ){
		 
		    $ext = strtolower(end(explode('.',$_FILES['logo']['name'][$i])));
			$et  = array('png','gif','jpg','jpeg');
		    if(!in_array($ext,$et))
			{
			   
			}
			else
			{
			   $name = time().$_FILES['logo']['name'][$i];
			   $this->load->model('vendor');
			   $this->vendor->updateVendorImages( array('vendor_id'=>$this->session->userdata('vendor_id'),'image' => $name ));
			   move_uploaded_file($_FILES["logo"]["tmp_name"][$i], SITE_ROOT.'/uploads/vendor/'.$name );
			     
			}	

         
          }//end of loop
		       $this->session->set_flashdata('success',$this->lang->line('image_upload'));
			   redirect('vendors/vendorProfile');
			
		 }
		 else
		 {
		    $this->session->set_flashdata('error',$this->lang->line('image_empty'));
			redirect('vendors/vendorProfile');
		 
		 }
		 
		 
		 
		 
	  } else{
	    	redirect('vendors/vendorProfile');
	  } 
	}
	
	public function delimg($id=0){
	  if($id > 0){
	    $this->load->model('vendor');
		$out = $this->vendor->getVendorImages($this->session->userdata('vendor_id'),$id);
		if(isset($out[0]['image']) && $out[0]['image'] !="" ){
		  @unlink(SITE_ROOT.'/uploads/vendor/'.$out[0]['image']);
		}
		
		
		$this->vendor->deleteVendorImages($this->session->userdata('vendor_id'),$id);
		$this->session->set_flashdata('success',$this->lang->line('image_deleted'));
	    redirect('vendors/vendorProfile');
	  }else{
	    redirect('vendors/vendorProfile');
	  }
	}
	
	
	
	
	
	  
}