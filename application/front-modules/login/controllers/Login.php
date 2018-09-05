<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if($this->session->userdata('isLogin') == TRUE ){
            	redirect(base_url().'Dashboard');
        }
        $this->load->model('login_model');
        $this->load->library('encrypt');
    }
	
	public function index()
    {   
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_error_delimiters('<div class="">', '</div>');
        if ($this->form_validation->run() == FALSE){ 
            $data['error'] = validation_errors();       
        } else { 
            $data_val['email']      = $this->input->post('email');
            $data_val['password']   = $this->input->post('password');
            $isLogin = $this->login_model->isLogin($data_val);
            if($isLogin==1){
                $this->session->set_flashdata('success', 'User Login successfully.');
                 redirect('dashboard');
            }else if($isLogin==2){
                $data['error'] = "You're temporarily blocked from posting";
            }else {
                $data['error'] = "Invalid login credentials.";
            }
        }
        $this->load->view('login',$data);
    } //ENd FUnction
	
}//ENd FUnction
