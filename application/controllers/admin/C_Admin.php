<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        
        $this->usersession->loadSession($this->session);
        $this->usersession->validateSession("/admin");
		
	}

	public function index()	{	
		
	}

}