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
		$this->load->model('common_model');
		$data['addCss'] = array();
		$data['offices'] = $this->dashboard_model->get_offices_count();
		$data['pits'] =  $this->dashboard_model->get_pit_count();
		$data['products'] =  $this->dashboard_model->get_product_count();
		$data['customers'] = 0;
		$data['officeManager'] = $this->dashboard_model->get_officeManager_count();
		$data['drivers'] = $this->dashboard_model->get_driver_count();
		$data['orders'] = $this->dashboard_model->get_order_count(1);
		$data['preorders'] = $this->dashboard_model->get_order_count(0);
		$data['categories'] = $this->common_model->get_records_count('category','id',array());
		$data['coupons'] = 0;
		
		/*$data['addJs'] = array('plugins/sparkline/jquery.sparkline.min.js','plugins/jvectormap/jquery-jvectormap-1.2.2.min.js','plugins/jvectormap/jquery-jvectormap-world-mill-en.js','plugins/slimScroll/jquery.slimscroll.min.js','plugins/chartjs/Chart.min.js','dist/js/pages/dashboard2.js');*/
		$this->template->build('dashboard',$data);	
	}//end of function
	function blank(){
		$this->template->build('blank');		
	}//End FUnction
	function maintenance(){
		$this->template->build('maintenance');		
	}//End Function
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'Sign out successfully done! ');
		redirect('login');
	}//End functon
}//end  Class
/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
