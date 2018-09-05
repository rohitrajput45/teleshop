<?php
class Home_model extends CI_Model { 
    function checkCard(){
        $my_session_id= $this->session->userdata('my_session_id');
        $userId = !empty($my_session_id)? $my_session_id:'';
        $rs = $this->db->get_where('cart',array('userId'=>$userId,'cartStatus'=>'0','orderId'=>''));
        return $rs->num_rows(); 

    }//End
    function emptyCard(){
        $my_session_id= $this->session->userdata('my_session_id');
        $userId = !empty($my_session_id)? $my_session_id:'';
        $this->db->where(array('userId'=>$userId));
        $delete = $this->db->delete('cart');
        return $delete; 
    }//End
    function checkCardempty($latitude,$longitude){
        $res= 0;
        $checkCard =  $this->checkCard();
        if($checkCard){
            $my_session_id= $this->session->userdata('my_session_id');
            $userId = !empty($my_session_id)? $my_session_id:'';
            $rs = $this->db->get_where('cart',array('userId'=>$userId,'cartStatus'=>'0','orderId'=>'','deliveryLatitude'=>$latitude,'deliveryLongitude'=>$longitude));

            if(!$rs->num_rows()){
                $res =1;
            }
        }
       echo $res;    
    }//End FUnction
}//End Function