<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin_Usuario extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-admin");
        $this->load->model('M_Usuario');
	}

	public function index()	{
        $this->load->model('admin/M_Admin_Usuario');
        $this->load->library('pagination');
		$modulo = new stdClass();
        
        $usuario = $this->M_Usuario->getByID($this->session->id_usuario);
        $modulo->datos_usuario = $usuario[0];
        
        /* Datos de la cabecera del panel de administrador*/
		$modulo->titulo_pagina = "TMO | Panel Principal - Usuarios Store";      
        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario = $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $usuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = "Take My Order";
        $modulo->nombre_empresa_corto = "TMO";      
        $modulo->url_signout = base_url()."admin/signOut";
        $modulo->url_main_panel = base_url()."admin";

		$modulo->nombre 					= "Usuarios Store";
		$modulo->titulo 					= "Usuarios Store";
		$modulo->titulo_registro 			= "Registro de Usuarios Store";
		$modulo->cabecera_registro 			= array("Nombre Usuario", "Email Usuario", "Nombre Empresa", "Url Admin Empresa", "Url Page Empresa", "Fecha Registro");
		$modulo->ruta_plantilla_registro 	= "admin/module/usuario/v-admin-usuario-rows";
		$modulo->base_url 					= "admin/usuario/";
		$modulo->api_rest_params 			= array("delete" => "id_empresa");
		$modulo->menu 						= array("menu" => 4, "submenu" => 0);
		$modulo->navegacion 				= array(
												array("nombre" => "Usuarios Store",
													"url" => "",
													"activo" => TRUE)
											);
        		
		$config 							= array();
		$config["base_url"] 				= base_url() . "admin/usuario-store/page";
		$total_row 							= $this->M_Admin_Usuario->getTotalUsuariosStore();
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
		
		$modulo->registros = $this->M_Admin_Usuario->fetchUsuariosStore($config["per_page"], ($page - 1) * 15);
		$str_links = $this->pagination->create_links();
		$modulo->links = explode('&nbsp;',$str_links );
		
		$data["modulo"] = $modulo;
        
		$this->load->view('admin/module/usuario/v-admin-usuario', $data);
	}

}
