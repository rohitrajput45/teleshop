<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller {

    public function __construct() {
		parent::__construct();
		if($this->session->userdata('id') == null):
			redirect(site_url().'login');
		endif;
		$this->load->model('dashboard_model');
		
    }
	public function index(){ 

		$this->template->build('dashboard');	
	}//end of function

	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'Sign out successfully done! ');
		redirect('login');
	}//End functon
}//end  Class
/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
