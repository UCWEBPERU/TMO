<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_StoreAdmin_Empresa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-store-admin");
	}

	public function index()	{
		$this->load->library('pagination');
		$modulo = new stdClass();

		$modulo->titulo_pagina = "TMO | Panel Principal - Store";      
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
		
		$data["modulo"] = $modulo;
		$this->load->view('template/module/module-panel', $data);
	}
	
}