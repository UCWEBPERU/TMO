<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_StoreAdmin_Empresa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->load->model('admin/M_Admin_Empresa');
        
        $this->usersession->loadSession($this->session);
        if (!$this->usersession->validateSession()) {
            redirect("/admin/login");
        }
		
	}

	public function index()	{
		$this->load->library('pagination');
		$modulo = new stdClass();

		$modulo->titulo_pagina = "TMO | Panel Principal";      
        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario = "Nombres";
        $modulo->tipo_usuario = "Super Administrador";
        $modulo->nombre_empresa_largo = "Take My Order";
        $modulo->nombre_empresa_corto = "TMO";      
        $modulo->url_signout = base_url()."admin/signOut";


		$modulo->nombre 					= "Empresa";
		$modulo->titulo 					= "Empresa";
		$modulo->titulo_registro 			= "Registro de Empresas";
		$modulo->cabecera_registro 			= array("Nombre Empresa", "Representante", "Cuenta", "Tipo Empresa", "Direccion", "Telefono");
		$modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-store";
		$modulo->base_url 					= "admin/empresa/";
		$modulo->api_rest_params 			= array("delete" => "id_empresa");
		$modulo->menu 						= array("menu" => 1, "submenu" => 0);
		$modulo->navegacion 				= array(
												array("nombre" => "Empresa",
													"url" => "",
													"activo" => TRUE)
											);
        		
		$config 							= array();
		$config["base_url"] 				= base_url() . "admin/empresa/page";
		$total_row 							= $this->M_Admin_Empresa->getTotalEmpresas();
		$config["total_rows"] 				= $total_row;
		$config["per_page"] 				= 15;
		$config['use_page_numbers'] 		= TRUE;
		$config['cur_tag_open'] 			= '&nbsp;<a class="current">';
		$config['cur_tag_close'] 			= '</a>';
		$config['next_link'] 				= 'Siguiente';
		$config['prev_link'] 				= 'Anterior';
		$config['first_link'] 				= 'Primero';
		$config['last_link'] 				= 'Ultimo';
		$config["uri_segment"] 				= 4;
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		
		$modulo->registros = $this->M_Admin_Empresa->fetchEmpresas($config["per_page"], ($page - 1) * 15);
		$str_links = $this->pagination->create_links();
		$modulo->links = explode('&nbsp;',$str_links );
		
		$data["modulo"] = $modulo;
		$this->load->view('template/module/module-panel', $data);
	}
	
}