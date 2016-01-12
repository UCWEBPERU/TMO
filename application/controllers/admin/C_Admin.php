<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        
<<<<<<< HEAD
        $this->usersession->validateSessionBack("admin");
=======
        $this->usersession->loadSession($this->session);
        $this->usersession->validateSession();
>>>>>>> e768217b2db5318ee04e1d9959e90391cee280f2
		
	}

	public function index()	{	
		$this->load->view('login');
	}

	

}