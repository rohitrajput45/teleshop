<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_session {
    var $CI;
    public function __construct($params = array())
    {
        $this->CI =& get_instance();

       
    }
    public function isLogin($userId){
      $sql=$this->CI->db->select("*")->where(array('id'=>$userId,'status'=>1))->get('users')->row_array();
      //echo $this->CI->db->last_query();die;
      if(!empty($sql)):
            $userType = $this->CI->db->select("*")->where(array('id'=>$sql['userType']))->get('userType')->row_array(); 
            $sql['userType'] = !empty($userType['userType']) ? $userType['userType']:'Admin';
            $sql['image'] = base_url().ADMIN_THEME.'dist/img/avatar5.png';
            if(!empty($sql['profileImage'])):
               $sql['image'] = base_url()."../uploads/profile/thumb/".$sql['profileImage'];
            endif;
        return $sql;
        else:
          $this->CI->session->sess_destroy();
          redirect('login');
      endif;  
      return false;
    }
     
    public function isOffice($userId){
      $sql=$this->CI->db->select("*")->where(array('id'=>$userId,'userType'=>2))->get('users')->row_array();
      //echo $this->CI->db->last_query();die;
      if(!empty($sql)):
            $offices = $this->CI->db->select("*")->where(array('officeManager'=>$sql['id']))->get('offices')->row_array(); 
           if(!empty($offices)):
				if($offices['status']==1):
				return "AS";//Active Success
				else:
				return "NA";//Active Success
				endif;
           endif;  
      endif;  
      return "SA";//SuperAdmin
    }
}//End CLass
