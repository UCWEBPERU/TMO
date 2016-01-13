<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        
        $this->usersession->loadSession($this->session);
        
        if (!$this->usersession->validateSession()) {
            redirect("/admin/login");
        } else {
            if ($this->usersession->validateSession() == 2) {
                redirect("/store/".$this->uri->segment(2)."/admin");
            }
        }
		
	}

	public function index()	{	
        $this->load->view('admin');
	}

}