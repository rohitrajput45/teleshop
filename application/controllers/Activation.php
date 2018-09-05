<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
    }
	public function index()
	{
		$data=array();
		$this->load->model('common_model');
		$id = $this->input->get('at');
		if(!empty($id)):
			$where = array('authToken'=>$id);
		$check =$this->common_model->getRow('users','*',$where);
		if(!empty($check)){
			$data['email'] = $check->email;
		$this->load->library('encrypt'); 
		$this->form_validation->set_rules('userName', 'user name', 'trim|required|is_unique[users.userName]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|matches[c_password]|min_length[6]');
			$this->form_validation->set_rules('c_password', 'password confirmation', 'trim|required|min_length[6]');
		$this->form_validation->set_message('is_unique', 'The %s is already exists.');
		$this->form_validation->set_error_delimiters('<div class="err_msg" style="color:red;">', '</div>');
		if ($this->form_validation->run() == FALSE){ 
			$data['error1'] = validation_errors();   	
		} else {  
			$data_val['userName'] = $this->input->post('userName');
			$data_val['password'] = $this->encrypt->encode($this->input->post('password'));
			$data_val['authToken']= $this->common_model->_generate_token();
			$data_val['isVerify'] = 1;
			
			 $update = $this->common_model->updateRow('users',array('email'=>$check->email),$data_val);
			 if($update):
				$this->session->set_flashdata('success', 'Authentication successfully done!,Please login.');
				if($check->userType==4){
					redirect('activation/success');
				}elseif($check->userType==5){
					redirect(base_url());
				}else{
				redirect('admin/login');
				}
			else:
				$data['error'] = "Something going wrong";
			 endif;
		}
		}else{
			$this->session->set_flashdata('error', 'Authentication key invalid.');
				redirect('admin/login');
		}
		endif;
	
		$this->load->view('activation',$data);
	}//End Function
	function success(){
		$data=array();
		$this->load->view('sucess',$data);
	}//End FUnction
}
?>
