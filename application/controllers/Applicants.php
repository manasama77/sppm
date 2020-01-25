<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicants extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_core', 'mcore');
		$this->load->model('M_applicants', 'mapplicants');
		$this->load->library('Template');
	}

	public function index()
	{
		$data['content'] = 'employees/main';
		$data['vitamin'] = 'employees/main_vitamin';
		$this->template->template($data);
	}

}

/* End of file Applicants.php */
/* Location: ./application/controllers/Applicants.php */