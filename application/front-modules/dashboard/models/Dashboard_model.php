<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function get_offices_count(){
		$userId =0;
        if($this->session->userdata('userType') ==2):
        $userId = $this->session->userdata('id');
        endif;
        $response = array();
        $this->db->select('*');
        $this->db->where(array('status'=>1));
       // !(empty($officeId)) ? $this->db->where(array('id'=>$officeId)):"";
        !(empty($userId)) ? $this->db->where(array('officeManager'=>$userId)):"";
        $sql=$this->db->get('offices');
        
        
        foreach ($sql->result() as $v) {
			//$p = explode(",",$v->associatedPitsId);
			//for ($i=0; $i <sizeof($p) ; $i++) { 
			 $response[] = $v->id;
			//}
          
        }
        return count($response);
		
	}//End FUnction
    function get_pit_count(){
		$userId =0;
		 $response = array();
        if($this->session->userdata('userType') ==2):
        
        $userId = $this->session->userdata('id');
         $this->db->select('*');
        $this->db->where(array('status'=>1));
       // !(empty($officeId)) ? $this->db->where(array('id'=>$officeId)):"";
        !(empty($userId)) ? $this->db->where(array('officeManager'=>$userId)):"";
        $sql=$this->db->get('offices');
        foreach ($sql->result() as $v) {
			$p = array_values(array_filter(explode(",",$v->associatedPitsId))) ;
			
			for ($i=0; $i <sizeof($p) ; $i++) { 
			 $response[] = $p[$i];
			} 
        }
       // echo $this->db->last_query();die;
        return sizeof(array_filter(array_unique($response)));	
        else:
			$this->db->select('*');
			//$this->db->where(array('status'=>1,'userType'=>2));
			$sql=$this->db->get('pits');
		//	if($this->session->userdata('userType') ==1):
			//$response=$sql->num_rows();
			//endif;

        return $sql->num_rows();	
        endif;
       
       
	}//End FUnction
	
    function get_officeManager_count(){
		$userId =0;
        $response =0;
        $this->db->select('*');
        $this->db->where(array('status'=>1,'userType'=>2));
        $sql=$this->db->get('users');
         if($this->session->userdata('userType') ==1):
         $response=$sql->num_rows();
        endif;
        return $response;	
	}//End FUnction
	
    function get_records_count(){
		$userId =0;
        $response =0;
        $this->db->select('*');
        $this->db->where(array('status'=>1,'userType'=>2));
        $sql=$this->db->get('users');
         if($this->session->userdata('userType') ==1):
         $response=$sql->num_rows();
        endif;
        return $response;	
	}//End FUnction
	function productIds(){
        $pits =array();
        $productIds =array();
        $userId =0;
        if($this->session->userdata('userType') ==2):
				$userId = $this->session->userdata('id');
				$response = array();
				$this->db->select('*');
				$this->db->from('offices');
				$this->db->where(array('status'=>1));
				!(empty($userId)) ? $this->db->where(array('officeManager'=>$userId)):"";
				$p1=$this->db->get();
				foreach ($p1->result() as $v) {
					$p = explode(",",$v->associatedPitsId);
					for ($i=0; $i <sizeof($p) ; $i++) { 
					$pits[] = $p[$i];
					}
				}
				$ids=array_values(array_filter(array_unique($pits)));
				if(!empty($ids)):
					$this->db->select('productId')->from('pitProducts');
					$this->db->where_in('pitId',$ids);
					$sql1=$this->db->get();
					if($sql1->num_rows()):
						foreach ($sql1->result() as $k) {
							$productIds[] = $k->productId;  
						}
					endif;
				endif;
          endif;
        return array_values(array_filter(array_unique($productIds)));
    }//End Function	
    function get_product_count(){
		$array =array();
		$productIds=array();
		if($this->session->userdata('userType') ==2):
			$productIds = $this->productIds();	
        endif;
		$this->db->select('product.*,unitType.unitType,category.name as categoryName');
		$this->db->from('product');
		$this->db->join('unitType','unitType.id=product.unitTypeId');
		$this->db->join('category','category.id=product.categoryId');
		if($this->session->userdata('userType') ==2):
			///$productIds = $this->productIds();
			!empty($productIds) ? $this->db->where_in('product.id',$productIds):"";
        endif;
		$this->db->order_by('product.id','desc');
		$sql = $this->db->get();
		return  (($this->session->userdata('userType') ==2) && empty($productIds)) ? 0 :$sql->num_rows();
	} //End Function
	function get_driver_count(){
		$officeId =0;
    	 if($this->session->userdata('userType') ==2):
			$officeId = $this->officeId();
    	 endif;
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where("userType",4);
		!empty($officeId) ?$this->db->where('officeId',$officeId):'';
		//$this->db->limit($limit,$start);
		$this->db->order_by('id','desc');
		$sql = $this->db->get();
		return ($this->session->userdata('userType') ==2 &&  empty($officeId)) ? 0 : $sql->num_rows();
	}//End Function
	function get_order_count($type){
		$officeId =0;
    	 if($this->session->userdata('userType') ==2):
			$officeId = $this->officeId();
    	 endif;
		$this->db->select('*');
		$this->db->from('customerOrder');
		!empty($officeId) ?$this->db->where('officeId',$officeId):'';
		$this->db->where('customerOrder.orderType',$type);
		$this->db->order_by('id','desc');
		$sql = $this->db->get();
		return ($this->session->userdata('userType') ==2 &&  empty($officeId)) ? 0 : $sql->num_rows();
	}//End Function

	function officeId(){
		 $response =0;
        if($this->session->userdata('userType') ==2):
        
			$userId = $this->session->userdata('id');
         $this->db->select('*');
        $this->db->where(array('status'=>1));
        !(empty($userId)) ? $this->db->where(array('officeManager'=>$userId)):"";
        $sql=$this->db->get('offices');
		if($sql->num_rows()):
			 $response = $sql->row()->id;
        
        endif;
        endif;
      //  $res = (!empty($response[0]) && isset($response[0])) ? $response[0]:0; 
        return   $response;
		
	}//End FUnction	
	
 	
}//End Class
?>
