<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_StoreAdmin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        
        $this->usersession->loadSession($this->session);
        
        if (!$this->usersession->validateSession()) {
            redirect("/store/".$this->uri->segment(2)."/admin/login");
        } else {
            if ($this->usersession->validateSession() == 1) {
                redirect("admin");
            }
        }
		
	}

	public function index()	{	
        $this->load->view('store-admin/v-store-admin-panel');
	}

}