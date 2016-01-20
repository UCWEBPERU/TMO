<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        
        // $this->usersession->loadSession($this->session);
        
        if (!$this->usersession->validateSession()) {
            redirect("/admin/login");
        } else {
            if ($this->usersession->validateSession() == 2) {
                redirect("/store/".$this->session->id_empresa."/admin");
            }
        }
	}

	public function index()	{
        $modulo = new stdClass();
        $modulo->titulo_pagina = "TMO | Panel Principal";
        
        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario = "Nombres";
        $modulo->tipo_usuario = "Super Administrador";
        $modulo->nombre_empresa_largo = "Take My Order";
        $modulo->nombre_empresa_corto = "TMO";
        
        $modulo->url_signout = base_url()."admin/signOut";
        
        $data["modulo"] = $modulo;
        $this->load->view('admin/v-admin-panel', $data);
	}

}