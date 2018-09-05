<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//load rest library
require APPPATH . '/libraries/REST_Controller.php';

class Service extends REST_Controller {

	
    public function __construct() {
        parent::__construct();
		$this->load->model('service_model'); 
		
		     
    }
    function userRegistration_post()
    {
		$this->load->model('common_model');
		$this->load->model('email_model');    
		$this->load->model('image_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullName','full name','trim|required');
		$socialType = $this->post('socialType');
		
		if(!empty($socialType) && $socialType != 'facebook'){
			$responseArray = array('status'=>FAIL,'message'=>'Wronge social type');
			$response = $this->generate_response($responseArray);
			$this->response($response);
		}
		if(empty($socialType)){
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.email]');
			//$this->form_validation->set_rules('password', 'password','trim|required|min_length[6]');
			
		}
		$this->form_validation->set_message('is_unique', 'The %s is already registered.');
		if($this->form_validation->run() == FALSE){
			$responseArray = array('status'=>FAIL,'message'=>strip_tags(validation_errors()));
			$response = $this->generate_response($responseArray);
			$this->response($response);
		} else {
 
			$setProfile = array('fullName','email','socialId','socialType','contact','deviceToken','deviceType','address');
			$setDetail = array('driversLicense','licenseExpiryDate','emergencyName','emergencyRelationship','emergencyPhoneNumber');
			$newUser = array();
			foreach($setProfile as $val){
				$post = trim($this->post($val));
				$newUser[$val] = !empty($post) ? $post :'';
			}
			foreach($setDetail as $val){
				$post = trim($this->post($val));
				$detail[$val] = !empty($post) ? $post :'';
			}
			$authToken = $this->service_model->_generate_token();
			$newUser['isVerify'] 	= 0;			
			$newUser['authToken'] 	= $authToken;			
			$this->load->library('encrypt');
			$password 				= $this->post('password');
			$newUser['password'] 	= !empty($password) ?$this->encrypt->encode($password):'';
			$newUser['userType'] 	= 4;
			$newUser['status'] 		= 1;
			$profileImage='';
			if(!empty($_FILES['profileImage']['tmp_name'])):

				$folder 	= 'profile';
				$hieght	= $width = 215;
				$profileImage 	= $this->image_model->updateMedia('profileImage',$folder,$hieght,$width);
				
				if(is_array($profileImage)):
					$this->session->set_flashdata('error', $profileImage['error']);
					$responseArray = array('status'=>FAIL,'message'=>$profileImage['error']);
					$response = $this->generate_response($responseArray);
			$this->response($response);
				endif;
			endif;
			if(is_string($profileImage)&& !empty($profileImage)){
				
				$newUser['profileImage'] = $profileImage ;
			}
			
			$licenseImage='';
			if(!empty($_FILES['licenseImage']['tmp_name'])):

				$folder 	= 'license';
				$hieght	= $width = 215;
				$licenseImage 	= $this->image_model->updateMedia('licenseImage',$folder,$hieght,$width);
				
				if(is_array($profileImage)):
					$this->session->set_flashdata('error', $licenseImage['error']);
					$responseArray = array('status'=>FAIL,'message'=>$licenseImage['error']);
					$response = $this->generate_response($responseArray);
					$this->response($response);
				endif;
			endif;
			if(is_string($licenseImage)&& !empty($licenseImage)){
				
				$detail['licenseImage'] = $licenseImage ;
			}
			
			$isRegisterd = $this->service_model->userRegistration($newUser,$detail);
			if(is_array($isRegisterd)){
	
				switch ($isRegisterd['type']) {
					case "SR":
						$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(110),'data'=>$isRegisterd['data']);
						break;
					case "NR":
						$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(110),'data'=>$isRegisterd['data']);
						break;
					case "SL":
						$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(106),'data'=>$isRegisterd['data']);
						break;
					case "AE":
						$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(116),'data'=>$isRegisterd['data']);
						break;
					default:
						$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118),'data'=>$isRegisterd['data']);
				}
				
			} else {
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(109));
				
			}
			$response = $this->generate_response($responseArray);
			$this->response($response);
		}//ENd Validtion
	}//ENd Function
	function userLogin_post()
	{  
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','email','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		
		if($this->form_validation->run() == FALSE){
			$responseArray = array('status'=>FAIL,'message'=>strip_tags(validation_errors()));
			$response = $this->generate_response($responseArray);
			$this->response($response);
		} else {
			//load library for encryption
			$this->load->library('encrypt');
			
			$authToken = $this->service_model->_generate_token();
			
			$data['email']   = $this->post('email');
			$data['password']    = $this->post('password');
			$data['deviceType']  = $this->post('deviceType');
			$data['deviceToken'] = $this->post('deviceToken');
			$data['authToken']   = $authToken;

			$isLoggedIn = $this->service_model->userLogin($data);

			if(is_string($isLoggedIn['type']) && $isLoggedIn['type'] == 'NA'){
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(121), 'data'=>$isLoggedIn['data']);
			} elseif(is_string($isLoggedIn['type']) && $isLoggedIn['type'] == 'WP'){
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(105), 'data'=>$isLoggedIn['data']);
			} elseif(is_string($isLoggedIn['type']) && $isLoggedIn['type'] == 'LS'){
				$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(106),'data'=>$isLoggedIn['data']);
			}else{
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118), 'data'=>array());
			}

			$response = $this->generate_response($responseArray);
			$this->response($response);
		
		}
	}//ENd Function
	
	function forgotPassword_post(){
		$this->load->model('email_model');    
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','email','trim|required|valid_email');
		if($this->form_validation->run() == FALSE){
			$responseArray = array('status'=>FAIL,'message'=>strip_tags(validation_errors()));
			$response = $this->generate_response($responseArray);
			$this->response($response);
		} else {
			$data['email']   = $this->post('email');
			$data['userType']   = 4;
			$isLoggedIn = $this->service_model->forgotPassword($data);
			//print_r($isLoggedIn);
			if(is_string($isLoggedIn['emailType']) && $isLoggedIn['emailType'] == 'ES'){
				$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(120));
			} elseif(is_string($isLoggedIn['emailType']) && $isLoggedIn['emailType'] == 'WE'){
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(105),);
			} else{
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118), 'data'=>array());
			}
		}//end if
			$response = $this->generate_response($responseArray);
			$this->response($response);
	}//End Function
	function checkSocial_post(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('socialId','socialId','trim|required');
		if($this->form_validation->run() == FALSE){
			$responseArray = array('status'=>FAIL,'message'=>strip_tags(validation_errors()));
			$response = $this->generate_response($responseArray);
			$this->response($response);
		} else {
			$socialId = $this->post("socialId");
			$check = $this->service_model->checkSocial($socialId);
			if(is_array($check)){
				$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122),'data'=>$check['data']);
			}else{
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118), 'data'=>array());
			}

			
			$response = $this->generate_response($responseArray);
			$this->response($response);
		}
	}//End function
}//End Class 
/* End of file service.php */
/* Location: ./application/service-modules/service/controllers/service.php */
