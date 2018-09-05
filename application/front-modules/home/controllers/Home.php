<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('home_model');
    }
	
	public function index()
	{	

		$this->template->build('home');
	}//End Function

}//End Class
