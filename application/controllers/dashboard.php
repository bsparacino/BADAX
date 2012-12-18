<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->helper('url');
		$this->auth();
	}

	private function auth()
	{
		if(!$this->ion_auth->logged_in())
			redirect('login', 'refresh');
	}

	public function index()
	{
		$this->load->view('dashboard');
	}
}