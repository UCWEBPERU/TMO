<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin_Perfil extends CI_Controller {

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
        $this->load->model("admin/M_Admin_Perfil");
        $modulo = new stdClass();
        $modulo->titulo_pagina = "TMO | Panel Principal - Perfil";
        
        $usuario = $this->M_Admin_Perfil->getByID($this->session->id_usuario);
        
        $modulo->datos_usuario = $usuario[0];
        
        /* Datos de la cabecera del panel de administrador*/
        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario = $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $usuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = "Take My Order";
        $modulo->nombre_empresa_corto = "TMO";
        /* --------------------*-------------------- */
        
        $modulo->url_signout = base_url()."admin/signOut";
        
        $data["modulo"] = $modulo;
        $this->load->view('admin/module/perfil/v-admin-perfil', $data);
	}

}