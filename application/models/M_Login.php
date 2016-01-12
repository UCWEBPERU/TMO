<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Login extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()	{
		
		
			$this->load->view('login');
				
	}

	
}
