<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//load rest library
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {

	
    public function __construct() {
        parent::__construct();
			$this->load->model('user_model');   
    }
   
	function logout_get(){
		$logout = $this->user_model->logout();
			if($logout):
				$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(200));
			else:
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
			endif;
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//end FUnction
	function duty_get(){
		$duty = $this->user_model->dutyCheck();
			if(is_array($duty)):
				$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(200),'duty'=>$duty['status']);
			else:
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
			endif;
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//end FUnction
	
	function userInfo_get(){
			$select="id,fullName,email,contact,address,profileImage,status,authToken,isVerify,approval";
			$where = array('id' =>$this->authData->id);
			$responce = $this->user_model->getUser('users',$select,$where);

			if($responce):
				$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(200),'data'=>$responce);
			else:
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
			endif;
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//end FUnction
	
	function test_get(){
		$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122),'data'=>array(),'totalPoints'=>120);
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//End Function
	function delivery_get(){
		$deliveryId = $this->get('deliveryId');
		$orderId = $this->get('orderId');
		$deliveryId  = !empty($deliveryId) ? $deliveryId :0;
		$orderId  = !empty($orderId) ? $orderId :0;
		$result = $this->user_model->deliveryInfo($deliveryId,$orderId);
			if(!empty($result)):
				$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(200),'data'=>$result);
			else:
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
			endif;
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//end Function
	
	function deliveryHistory_get(){
		$deliveryId = $this->get('deliveryId');
		$orderId = $this->get('orderId');
		$deliveryId  = !empty($deliveryId) ? $deliveryId :0;
		$orderId  = !empty($orderId) ? $orderId :0;
		$result = $this->user_model->deliveryHistory($deliveryId,$orderId);
			if(!empty($result)):
				$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(200),'data'=>$result);
			else:
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
			endif;
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//end Function
	
	function deliveryRequest_post(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('deliveryId','Delivery Id','trim|required');
		$this->form_validation->set_rules('status','Delivery status','trim|required');
		if($this->form_validation->run() == FALSE){
			$responseArray = array('status'=>FAIL,'message'=>strip_tags(validation_errors()));
			
		} else {
			$deliveryId = $this->post('deliveryId');
			$status 	= $this->post('status');
			$result 	= $this->user_model->deliveryRequest($deliveryId,$status);
			if(is_array($result)):
				$responseArray = array('status'=>SUCCESS,'message'=>$result['message'],'data'=>$result['status']);
			else:
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
			endif;
		}
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//end Function
	function updateInfo_post(){
		$this->load->model('image_model');
		$this->load->model('common_model');
		$user = $userDetail = $orderInfo = array();
		$res=0;
		$fullName 	= $this->post('fullName');
		$contact 	= $this->post('contact');
		$address 	= $this->post('address');
		
		if(isset($fullName) && !empty($fullName)){
			$user['fullName'] = $fullName; 
		}//endif
		if(isset($contact) && !empty($contact)){
			$user['contact'] = $contact; 
		}//endif
		if(isset($address) && !empty($address)){
			$user['address'] = $address; 
		}//endif
		$profileImage = '';
		if(!empty($_FILES['profileImage']['tmp_name'])):

			$folder 	= 'profile';
			$hieght	= $width = 215;
			$profileImage 	= $this->image_model->updateMedia('profileImage',$folder,$hieght,$width);
		/*	echo "<pre>";
			print_r($profileImage);die;
*/			if(is_array($profileImage)):
				//$profileImage['error']
				$responseArray = array('status'=>FAIL,'message'=>$profileImage['error']);
				$response = $this->generate_response($responseArray);
				$this->response($response);
			endif;
		endif;
		if(is_string($profileImage)&& !empty($profileImage)){
			if(!empty($this->authData->profileImage)):
				$path = '../uploads/profile/'; 
				$this->common_model->unlinkFile($path,$this->authData->profileImage);
			endif;
			$user['profileImage']		= $profileImage;
		}

		/*userinfo*/
			if(!empty($user)){
				$res = $this->user_model->updateRow('users',array('id' =>$this->authData->id),$user);
			}

		/*userinfo*/
		if($res){
			$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122));
		}else{
			$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
		}
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//ENd FUnction
	function moneyFromManager_post(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('moneyFromManager','Delivery Id','trim|required');
		$this->form_validation->set_rules('moneyStatus','Delivery Id','trim|required');
		if($this->form_validation->run() == FALSE){
			$responseArray = array('status'=>FAIL,'message'=>strip_tags(validation_errors()));
			
		} else {
			$moneyFromManager = $this->post('moneyFromManager');
			$moneyStatus = $this->post('moneyStatus');
			if($moneyStatus=="debit"){
				$moneyFromManager = "-".$moneyFromManager ;
			}
			$result 	= $this->user_model->moneyFromManager($moneyFromManager);
			if(is_array($result)):
				$responseArray = array('status'=>SUCCESS,'message'=>$result['message'],'data'=>$result['res']);
			else:
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
			endif;
		}
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//end Function
	function dailyReport_get(){
		$dateOfReport = $this->get('dateOfReport');
		
		$dateOfReport  = !empty($dateOfReport) ? date("Y-m-d",strtotime($dateOfReport)) :date("Y-m-d");
		$result = $this->user_model->getdailyReport($dateOfReport);
			if(!empty($result)):
				$responseArray = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(200),'data'=>$result);
			else:
				$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
			endif;
		$response = $this->generate_response($responseArray);
		$this->response($response);
	}//end Function
	function customerPayment_post(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('orderId','order','trim|required');
		$this->form_validation->set_rules('paymentMode','Payment mode','trim|required');
		$this->form_validation->set_rules('paymentType','payment type','trim|required');
		$this->form_validation->set_rules('amount','amount','trim|required');
		if($this->form_validation->run() == FALSE){
		$responseArray = array('status'=>FAIL,'message'=>strip_tags(validation_errors()));

		} else {
			$orderId 		= $this->post('orderId');
			$paymentMode 	= $this->post('paymentMode');
			$paymentType 	= $this->post('paymentType');
			$amount 		= $this->post('amount');
			$description 	= $this->post('description');
			$receiptImage = '';
		if(!empty($_FILES['receiptImage']['tmp_name'])):
			$this->load->model('image_model');
			$folder 	= 'receipt';
			$hieght	= $width = 215;
			$receiptImage 	= $this->image_model->updateMedia('receiptImage',$folder,$hieght,$width);
	
		if(is_array($receiptImage)):
				//$profileImage['error']
				$responseArray = array('status'=>FAIL,'message'=>$receiptImage['error']);
				$response = $this->generate_response($responseArray);
				$this->response($response);
			endif;
		endif;
		$receipt		= (is_string($receiptImage)&& !empty($receiptImage))?$receiptImage:"";
		$result  = $this->user_model->customerPayment($orderId,$paymentMode,$paymentType,$amount,$receiptImage,$description);
		if(is_array($result)){
			$responseArray = array('status'=>SUCCESS,'message'=>$result['message'],'data'=>$result['data']);
		}else{
			$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
		}

		}
		$response = $this->generate_response($responseArray);
				$this->response($response);
	}//end Function
	
	function pitPayment_post(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subOrderId','sub-order id','trim|required');
		$this->form_validation->set_rules('paymentMode','Payment mode','trim|required');
		$this->form_validation->set_rules('paymentType','payment type','trim|required');
		$this->form_validation->set_rules('amount','amount','trim|required');
		if($this->form_validation->run() == FALSE){
		$responseArray = array('status'=>FAIL,'message'=>strip_tags(validation_errors()));

		} else {
			$subOrderId 	= $this->post('subOrderId');
			$paymentMode 	= $this->post('paymentMode');
			$paymentType 	= $this->post('paymentType');
			$amount 		= $this->post('amount');
			$description 	= $this->post('description');
			$receiptImage = '';
		if(!empty($_FILES['receiptImage']['tmp_name'])):
			$this->load->model('image_model');
			$folder 	= 'receipt';
			$hieght	= $width = 215;
			$receiptImage 	= $this->image_model->updateMedia('receiptImage',$folder,$hieght,$width);
	
		if(is_array($receiptImage)):
				//$profileImage['error']
				$responseArray = array('status'=>FAIL,'message'=>$receiptImage['error']);
				$response = $this->generate_response($responseArray);
				$this->response($response);
			endif;
		endif;
		$receipt		= (is_string($receiptImage)&& !empty($receiptImage))?$receiptImage:"";
		$result  = $this->user_model->pitPayment($subOrderId,$paymentMode,$paymentType,$amount,$receiptImage,$description);
		if(is_array($result)){
			$responseArray = array('status'=>SUCCESS,'message'=>$result['message'],'data'=>$result['data']);
		}else{
			$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
		}

		}
		$response = $this->generate_response($responseArray);
				$this->response($response);
	}//end Function
	
	function deliveryReport_post(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('deliveryId','delivery Id','trim|required');
		$this->form_validation->set_rules('shiftNumber','shift number','trim|numeric|required');
		//$this->form_validation->set_rules('reportImage','report Image','trim|required');
		$this->form_validation->set_rules('reportType','reportType','trim|required');
		if(empty($_FILES['reportImage']['tmp_name'])):
			$this->form_validation->set_rules('reportImage','report Image','trim|required');
		endif;
		if($this->form_validation->run() == FALSE){
		$responseArray = array('status'=>FAIL,'message'=>strip_tags(validation_errors()));

		} else {
			///print_r($_FILES);die;
			$deliveryId 	= $this->post('deliveryId');
			$shiftNumber 	= $this->post('shiftNumber');
			$reportType 	= $this->post('reportType');
			//$date 			= date("Y-m-d H:i:s");
			$reportImage 	= '';
		if(!empty($_FILES['reportImage']['tmp_name'])):
			$this->load->model('image_model');
			$folder 	= 'report';
			$hieght	= $width = 150;
			$reportImage 	= $this->image_model->updateMedia('reportImage',$folder,$hieght,$width);
	
		if(is_array($reportImage)):
				//$profileImage['error']
				$responseArray = array('status'=>FAIL,'message'=>$reportImage['error']);
				$response = $this->generate_response($responseArray);
				$this->response($response);
			endif;
		endif;
		$reportImage		= (is_string($reportImage)&& !empty($reportImage))? $reportImage:"";
		$result  = $this->user_model->deliveryReport($deliveryId,$shiftNumber,$reportType,$reportImage);
		if(is_array($result)){
			$responseArray = array('status'=>SUCCESS,'message'=>$result['message'],'data'=>$result['data']);
		}else{
			$responseArray = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
		}

		}
		$response = $this->generate_response($responseArray);
				$this->response($response);
	}//End Function
	
} // End of class
/* End of file user.php */
/* Location: ./application/service-modules/service/controllers/user.php */
