<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Usuario extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('session');
		$this->load->model('admin/M_Usuario');
		
		
	}

	public function index()	{
		$this->load->view('admin/main-panel/header');
	}

}
