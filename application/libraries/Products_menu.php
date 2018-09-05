<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_menu {
    var $CI;
    public function __construct($params = array())
    {
        $this->CI =& get_instance();

       
    }
	public function productMenu(){
		$product = array();
		$category=$this->CI->db->select("*")->where(array('status'=>1))->get('category')->result_array();
		//echo $this->CI->db->last_query();die;
		if(!empty($category)):
			foreach ($category as $k => $v) {
				$pro = $this->CI->db->select("id,name")->where(array('status'=>1,'categoryId'=>$v['id']))->get('product')->result_array();
				if(!empty($pro)):
					$product[$k]['category']  = $v['name'];
					$product[$k]['product']   = $pro;
				endif;
			}
		//return $sql;
		endif;  
		return $product;
	}
}//End CLass