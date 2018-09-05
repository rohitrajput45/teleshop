<?php

class Login_model extends CI_Model {

   function isLogin($data){

        $sql = $this->db->select('*')->where('email',$data['email'])->get('users');
        if($sql->num_rows()):
            $user = $sql->row();
            $newpass=$this->encrypt->encode($data['password']);
            $pass=$this->encrypt->decode($user->password);
                if($data['password'] == $this->encrypt->decode($user->password)){
                    
                    if($user->status):
                        $session_data['id']         = $user->id ;
                        $session_data['username']   = $user->username;
                        $session_data['email']      = $user->email;
                        $session_data['role']      = $user->role;
                        $session_data['isLogin']    = TRUE ;
                        $this->session->set_userdata($session_data);
                        return 1;
                    endif;
                     return 2;
                }
        endif;
       return 0;
    }//End Function
}//ENd Function
