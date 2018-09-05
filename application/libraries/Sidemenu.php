<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Sidemenu
{
	/**
	 * Constructor - Sets Preferences
	 *
	 * The constructor can be passed an array of config values
	 */
	function __construct()
	{ 
            $this->_ci =& get_instance();
            
	}
	function sidemenubar($usertype=1){
		$this->_ci->db->select("*")->from('permission')->where("userType",$usertype);
		$result =$this->_ci->db->get()->row_array();	
	    return $result;	
	}//END function

    public function get_records_by_id($table,$single,$where,$select,$order_by_field,$order_by_value ){
        if(!empty($select)){
            $this->_ci->db->select($select);
        }

        if(!empty($where)){
            $this->_ci->db->where($where);
        }

        if(!empty($order_by_field) && !empty($order_by_value)){
            $this->_ci->db->order_by($order_by_field, $order_by_value);
        }

        $query = $this->_ci->db->get($table);
        $result = $query->result_array();

        if(!empty($result)){
            if($single){
                $result = $result[0];
            }else{
                $result = $result;
            }  
        } else{
            $result = 0; 
        }
        return $result;             
    }//End function 

    public function update_data($table,$whereCondition,$updateData){    
        $this->_ci->db->update($table, $updateData, $whereCondition);
        $row =  $this->_ci->db->affected_rows() ;
        return $row;
    }//End Function

    public function insert_data($table,$data){
        $this->_ci->db->insert($table, $data);
        $last_id =  $this->_ci->db->insert_id();
        return $last_id;          
    }//End Function      
    public function delete_data($table,$whereCondition){  
        $this->_ci->db->delete($table, $whereCondition); 
        $affected_rows  =  $this->_ci->db->affected_rows();
        return $affected_rows;      
    }//End Function
}// END class