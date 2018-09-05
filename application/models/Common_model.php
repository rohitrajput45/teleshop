<?php
class Common_model extends CI_Model
{
	/**
	* Generate token for user
	*/
	public function _generate_token()
	{
		$this->load->helper('security');
		$salt = do_hash(time().mt_rand());
		$new_key = substr($salt, 0,40);
		return $new_key;
	}
	//Insert Data Query 
	function insertData($table,$data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}//End Function
	function batchDataInsert($table,$data){
		$insert=$this->db->insert_batch($table,$data);
		return $insert;
	}//End Function
	//Update 
	function updateRow($table,$where,$set){
		
		$this->db->where($where);
		$update=$this->db->update($table,$set);
		return $update;
	}//ENd FUnction
	function updateRowBatch($table,$where,$key,$check,$set){
		
		$this->db->where($where);
		$this->db->where_in($key,$check);
		$update=$this->db->update($table,$set);
		return $update;
	}//ENd FUnction
	///Get row
	function getRow($table,$select="*",$where=array()){
		$this->db->select($select)->from($table);
		!empty($where) ?$this->db->where($where):'';
		$sql = $this->db->get();
		if($sql->num_rows()){
			return $sql->row();
		}
		return false;
	}//ENd function
	function get_records($table,$select,$where=array(),$orderBy=''){
		$responce = array();
		$this->db->select($select)->from($table);
		!empty($where) ? $this->db->where($where):'';
		!empty($orderBy) ? $this->db->orderBy('id',$orderBy):'';
		$sql = $this->db->get();
		if($sql->num_rows()):
			$responce = $sql->result(); 
		endif;
		return $responce;
	}//End function
	function get_records_count($table,$select,$where=array()){
		$this->db->select($select)->from($table);
		!empty($where) ? $this->db->where($where):'';
		$sql = $this->db->get();
		return $sql->num_rows();
	}//End function
	public function get_records_by_id($table,$single,$where,$select,$order_by_field,$order_by_value ){
		if(!empty($select)){
			$this->db->select($select);
		}
		if(!empty($where)){
			$this->db->where($where);
		}
		if(!empty($order_by_field) && !empty($order_by_value)){
			$this->db->order_by($order_by_field, $order_by_value);
		}
		$query = $this->db->get($table);
		$result = $query->result_array();
		if(!empty($result)){
			if($single){
				$result = $result[0];
			}else{$result = $result;}
		} else{
			$result = 0;
		}
		return $result;
	}//End FUncttion
	function deleteRow($table,$where){
		$this->db->where($where);
        $delete=$this->db->delete($table);
        return $delete;
	}//End FUncttion
	function unlinkFile($path,$file){
		$main 	= $path.$file;
		$thumb 	= $path.'thumb/'.$file;
		$resize = $path.'resize/'.$file;
		if(file_exists(FCPATH.$main)):
			unlink( BASEPATH.$main);
		endif;
		if(file_exists(FCPATH.$thumb)):
			unlink( BASEPATH.$thumb);
		endif;
		if(file_exists(FCPATH.$resize)):
			unlink( BASEPATH.$resize);
		endif;
		return TRUE;
	}//End function

		public function getLatLong($address){ // get lat and long by city name

		if(!empty($address)){
	       
	        $formattedAddr = str_replace(' ','+',$address);

	        $url = 'http://maps.google.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			$output = json_decode($response);
			if(isset($output->results[0]->geometry->location->lat)){
				$data['address']  = $address; 
				$data['latitude']  = $output->results[0]->geometry->location->lat; 
				$data['longitude'] = $output->results[0]->geometry->location->lng;
				if(!empty($data)){
					return $data;
				} else{
					return false;
				}
			} else{
				return false;   
			}
		} else{
			return false;   
		}
	}
	function get_remote_ip_address()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
        else
        $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }//ENd FUnction
    function latlong(){
        $api_key = "AIzaSyBCKpfnLn74Hi2GBmTdmsZMJORZ5xyL1as";
        $ip_addr = $this->get_remote_ip_address();
        //$location = file_get_contents('http://freegeoip.net/json/'. $ip_addr);
        $url ='http://freegeoip.net/json/'. $ip_addr;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
        $location =json_decode($response,true);
        $lat = (isset($location['latitude']) && !empty($location['latitude']))? $location['latitude']:"22.7196";
        $long = (isset($location['longitude'])&& !empty($location['longitude']))? $location['longitude']:"75.8577";
        return array('lat'=>$lat,'long'=>$long);
    }//ENd FUnction

	
}//End Class
?>
