<?php
class Service_model extends CI_Model {
	
	/**
	* Generate token for user
	*/
	public function _generate_token()
	{
		$this->load->helper('security');
		$salt = do_hash(time().mt_rand());
		$new_key = substr($salt, 0, config_item('rest_key_length'));
		return $new_key;
	}
	/**
	* Update user deviceid and auth token while login
	*/
    function updateDeviceIdToken($where, $set)
    {
		
		$req = $this->db->select('id')->where($where)->get('users');
		if($req->num_rows()){
			$this->db->update('users',$set,$where);
			return TRUE;
		}
		return FALSE;
	}
    function updateDuty($where,$set)
    {
		$update= $this->db->update('driverDetail',$set,$where);
		if($update):
			return TRUE;
		endif;
		return FALSE;
	}
	function checkDeviceToken($deviceToken){
		$req = $this->db->select('id')->where('deviceToken',$deviceToken)->get('users');
		if($req->num_rows()){
			$ids=array();
			foreach ($req->result() as $val) {
				$ids[]=$val->id;
			}
			$this->db->where_in('id',$ids);
			$this->db->update('users',array('deviceToken' =>''));
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}	
		}	
		return true;		
	}//Function for check Device Token 	
	
	/**
	* Function for check provided token is valid or not
	*/
	function isValidToken($authToken)
	{
		$this->db->select('*');
		$this->db->where('authToken',$authToken);
		if($query = $this->db->get('users')){
			if($query->num_rows() > 0){
				return $query->row();
			}
		}
		
		return FALSE;
	}//ENd Function	
	/**
	*Function for Retrive Valid data row
	*
	*/
	function getUser($table,$select="*",$where=array()){
		$this->db->select($select)->from($table);
		!empty($where) ?$this->db->where($where):'';
		$sql = $this->db->get();
		if($sql->num_rows()){
			$user = $sql->row();
			$image = $user->profileImage;
			if(!empty($image)):
				$user->profileImage = base_url().'uploads/profile/resize/'.$image;
				$user->profile = base_url().'uploads/profile/'.$image;
			
			endif; 
			$userDetail 	= $this->userDetail($user->id);
			$user ->onDuty 	= 0;
			if($userDetail){
				$user ->onDuty 	= $userDetail->duty;
			}
			
			
			return $user;
		}
		return false;
	}//ENd function
	function userDetail($userId){
		
		$this->db->select("*")->from('driverDetail');
		$this->db->where(array('userId'=>$userId));
		$sql = $this->db->get();
		if($sql->num_rows()){
			$detail = $sql->row();
			$licenseImage = $detail->licenseImage;
			if(!empty($licenseImage)):
			
				$detail->licenseImage = base_url().'uploads/license/resize/'.$licenseImage;
			
			endif; 
			return $detail;
		}
		return false;
	}//ENd FUnction
	/*
	* Function for User Registration Noramal + Social
	*/
	function userRegistration($createUser,$setDetail)
	{
		$select="id,fullName,email,contact,address,profileImage,status,authToken,isVerify,approval";
		if(!empty($createUser['socialId']) && !empty($createUser['socialType'])){
			$where = array('socialId' => $createUser['socialId']);
			$isExist =	$this->getUser('users',$select,$where);
			$set = array('fullName'=>$createUser['fullName'],'email'=>$createUser['email'],'contact'=>$createUser['contact'],'deviceToken'=>$createUser['deviceToken'], 'authToken'=>$createUser['authToken'],'deviceType' => $createUser['deviceType']);
			
			if(!empty($isExist)):
				if($isExist->userType !=4):
					return array('type'=>'AE', 'data'=>array());
				endif;
				$this->checkDeviceToken($createUser['deviceToken']);
				$this->updateDeviceIdToken($where,$set);
				//$this->updateDuty(array('userId'=>$res->id),array('duty'=>1));
				$responce = $this->getUser('users',$select,$where);
				$responce->register = 1;
				return array('type'=>'SL', 'data'=>$responce);
			else :
				
				$createUser['isVerify']=1;
				$userId = $this->createNewUser($createUser);
				
				if($userId){
					/// other information
					$setDetail['userId'] = $userId;
					$this->createdriverDetail($setDetail);
					//ohter 
					//Admin mail
						$subject = "New Driver Request";
						$message	=	"Hi Admin ,<br><br>Driver has registered from application, you have to assign office to the driver and approve it from admin account.<br><br> Below is Driver account information.<br><br><strong>Driver Info</strong><br><br><strong>Name:</strong> ".$createUser['fullName']."<br><strong>Address:</strong> ".((!empty($createUser['address']) && isset($createUser['address'])) ? $createUser['address']:"NA")."<br><strong>Phone Number:</strong> ".((!empty($createUser['contact']) && isset($createUser['contact'])) ? $createUser['contact']:"NA")."<br><br>";
						$path               = 'emails/mailsend.php';
						$data['link']="";

						$send =$this->email_model->mailSend('shefali.mindiii@gmail.com',$message,$subject,$data,$path,FALSE);
				//admin Mail
					$where = array('id' => $userId);
					$responce = $this->getUser('users',$select,$where);
					$responce->register = 0;
					return array('type'=>'SR', 'data'=>$responce);
				}
				
			endif;// isExist
			
			return FALSE;
			
		} else {
			
			$where = array('email' => $createUser['email']);
			$isExist = $this->getUser('users',$select,$where);
			
			if(!empty($isExist)){
				return array('type'=>'AE', 'data'=>array());
			}	
			$userId = $this->createNewUser($createUser);
				
			if($userId){
				/// other information
					$setDetail['userId'] = $userId;
					$this->createdriverDetail($setDetail);
				//ohter
				$subject1 = "Request for Login as Driver";
				$message1	=	"Hi ".$createUser['fullName'].",<br><br> Below is your Account information.<br><br><strong>Account Info</strong><br><br><strong>Name:</strong> ".$createUser['fullName']."<br><strong>Address:</strong> ".((!empty($createUser['address']) && isset($createUser['address'])) ? $createUser['address']:"NA")."<br><strong>Phone Number:</strong> ".((!empty($createUser['contact']) && isset($createUser['contact'])) ? $createUser['contact']:"NA")."<br><br><br><br>Click on the below button to complete your account registration.<br>";
				$path1               = 'emails/mail.php';
				$data1['link']= base_url()."index.php/activation?at=".$createUser['authToken'];
				
				 $send =$this->email_model->mailSend($createUser['email'] ,$message1,$subject1,$data1,$path1,FALSE);
				
				//Admin mail
						$subject = "New Driver Request";
						$message	=	"Hi Admin ,<br><br>Driver has registered from application, you have to assign office to the driver and approve it from admin account.<br><br> Below is Driver account information.<br><br><strong>Driver Info</strong><br><br><strong>Name:</strong> ".$createUser['fullName']."<br><strong>Address:</strong> ".((!empty($createUser['address']) && isset($createUser['address'])) ? $createUser['address']:"NA")."<br><strong>Phone Number:</strong> ".((!empty($createUser['contact']) && isset($createUser['contact'])) ? $createUser['contact']:"NA")."<br><br>";
						$path               = 'emails/mailsend.php';
						$data['link']="";

						$send =$this->email_model->mailSend('shefali.mindiii@gmail.com',$message,$subject,$data,$path,FALSE);
				//admin Mail
				$where = array('id' => $userId);
				$responce = $this->getUser('users',$select,$where);
				$responce->register = 0;
				return array('type'=>'NR', 'data'=>$responce);
			}
			
			return FALSE;
		}// End If !empty Social Id
	}//End Function 
	/*
	* Function  for Add User
	*/
	function createNewUser($insertData)
	{
		$this->db->insert('users', $insertData);
		
		$id = $this->db->insert_id();
		
		if($id){
			return $id;
		}
		
		return FALSE;
	}//End Function 
	
	function createdriverDetail($insertData)
	{
		$this->db->insert('driverDetail', $insertData);
		
		$id = $this->db->insert_id();
		
		if($id){
			return $id;
		}
		
		return FALSE;
	}//End Function 
	
	/*
	* User Login
 	**/
 	function userLogin($data){
 		$select="id,fullName,email,contact,address,profileImage,status,authToken,isVerify,approval";
		if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$where =array('email'=>$data['email']);
		}else{
			$where =array('userName'=>$data['email']);
		}
		$req = $this->db->select('id,email,password, status')->where($where)->get('users');
		$userData = array();
		if($req->num_rows()){

			$res = $req->row();
			
			if($this->encrypt->decode($res->password) == $data['password']){
				if($res->status){//if user is active
					//udating user deviceid and auth token
					$where = array('id'=>$res->id);
					$set = array('deviceToken'=>$data['deviceToken'], 'authToken'=>$data['authToken'],'deviceType' => $data['deviceType']);
					$this->updateDeviceIdToken($where, $set);
					//$this->updateDuty(array('userId'=>$res->id),array('duty'=>1));
					//get user record
					$userData = $this->getUser('users',$select,$where);
					
					return array('type'=>'LS','data'=>$userData); //login successfull
				} else {
					return array('type'=>'NA','data'=>array());
				}
			} else {
				return array('type'=>'WP','data'=>$userData); //wrong password
			}
		}	
		return FALSE;
	}//END funCtion
	function forgotPassword($where){
		$select="id,fullName,email,contact,address,profileImage,status,authToken,password";
		$user = $this->getUser('users',$select,$where);
		if(!empty($user)):
			if(empty($socialId)):
			$this->load->library('encrypt');
			$subject = "Forgot Password";
			$message	=	"Hi ".$user->fullName." ,<br><br> DNG App your Password is :".$this->encrypt->decode($user->password)."<br><br>";
			$path               = 'emails/mailsend.php';
			$data['link']="";
			return $this->email_model->mailSend($user->email,$message,$subject,$data,$path,FALSE);
			endif;
			return array('emailType'=>'WE','message'=>'Email is Social  registered');
		else:
		return array('emailType'=>'WE','message'=>'Email is Not registered');
		endif;
		return false;
	}//End FUnction
	function checkSocial($socialId){
			$select="id,fullName,email,contact,address,profileImage,status,authToken,isVerify,approval";
			$where = array('socialId' => $socialId);
			$isExist =	$this->getUser('users',$select,$where);
			if(!empty($isExist)):
				if($isExist->userType !=4):
					return array('type'=>'AE', 'data'=>array());
				endif;
				$responce = $this->getUser('users',$select,$where);
				$isExist->register = 1;
				return array('type'=>'SL', 'data'=>$isExist);
			endif;
			return array('type'=>'NL', 'data'=>array());
	}//ENd function
}//ENd Class
?>
