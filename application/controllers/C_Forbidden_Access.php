<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Forbidden_Access extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function store() {
        
        $modulo = new stdClass();
		$modulo->titulo      = "Access Denied!";
        $modulo->mensaje     = "You do not have permission to view this resource.";
        $modulo->url_go_back = $this->agent->referrer();
        
        $data["modulo"] = $modulo;        
        $this->load->view('template/v-forbidden-access', $data);
	}

}