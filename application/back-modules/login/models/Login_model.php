<?php
class Login_model extends CI_Model
{
	function isLogin($data){
        $email = $data["email"];
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $where = array('userName'=>$data['email'],'userType !='=>4,'userType !='=>5);
        }else{
            $where = array('email'=>$data['email'],'userType !='=>4,'userType !='=>5);
        }
		$sql = $this->db->select('*')->where($where)->get('users');
        if($sql->num_rows()):
            $user = $sql->row();
            //Sgbc0310nppp
          //  echo  $this->encrypt->decode($user->password);die;
                if($data['password'] == $this->encrypt->decode($user->password)){
					if($user->status):
						$this->db->where(array('id'=>$user->id))->update('users',array('authToken'=>$data['authToken']));
						$session_data['id']         = $user->id ;
						$session_data['email']		= $user->email ;
						$session_data['userType']	= $user->userType ;
						$session_data['authToken'] 	= $user->authToken ;
						$session_data['isLogin'] 	= TRUE ;
						$this->session->set_userdata($session_data);
						return 1;
                    endif;
                     return 2;
                }
        endif;
       return 0;
	}//End Function
}//End Class
?>
