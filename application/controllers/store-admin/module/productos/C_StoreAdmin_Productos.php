<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_StoreAdmin_Productos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-store-admin");
        $this->load->model("store-admin/M_StoreAdmin_Productos");
        $this->load->model('M_Archivo');
        $this->load->model('M_Empresa');
        $this->load->model('M_Usuario');
        $this->load->model('M_Tipo_Empresa');
	}
    
    public function index() {
		$this->load->library('pagination');
		$modulo = $this->loadDataPanel();
        
        $modulo->titulo_pagina              = $modulo->datos_empresa->nombre_empresa." | Panel Administrativo - Productos";
		$modulo->nombre 					= "Productos";
		$modulo->titulo 					= "Productos";
		$modulo->titulo_registro 			= "Registro de Productos";
		$modulo->cabecera_registro 			= array("Nombre", "Descripcion", "Stock", "Precio", "Categoria");
		$modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-products";
		$modulo->base_url 					= $modulo->url_main_panel."/products";
		$modulo->api_rest_params 			= array("delete" => "id_producto");
		$modulo->menu 						= array("menu" => 2, "submenu" => 0);
		$modulo->navegacion 				= array(
												array("nombre" => "Productos",
													"url" => "",
													"activo" => TRUE)
											);
                                            
		$config 							= array();
		$config["base_url"] 				= $modulo->url_main_panel."/page";
		$total_row 							= $this->M_StoreAdmin_Productos->getTotalProductos($this->session->id_empresa);
		$config["total_rows"] 				= $total_row;
		$config["per_page"] 				= 15;
		$config['use_page_numbers'] 		= TRUE;
		$config['cur_tag_open'] 			= '&nbsp;<a class="current">';
		$config['cur_tag_close'] 			= '</a>';
		$config['next_link'] 				= 'Siguiente';
		$config['prev_link'] 				= 'Anterior';
		$config['first_link'] 				= 'Primero';
		$config['last_link'] 				= 'Ultimo';
		$config["uri_segment"] 				= 5;
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
		
		$modulo->registros = $this->M_StoreAdmin_Productos->fetchProductos($config["per_page"], ($page - 1) * 15, $this->session->id_empresa);
		$str_links = $this->pagination->create_links();
		$modulo->links = explode('&nbsp;',$str_links );
		
		$data["modulo"] = $modulo;
		$this->load->view('store-admin/module/productos/v-store-admin-productos', $data);
    }
    
    public function loadDataPanel() {
        $modulo = new stdClass();
        
        $dataEmpresa        = $this->M_Empresa->getByID($this->session->id_empresa);
        $dataUsuario        = $this->M_Usuario->getByID($this->session->id_usuario);
        $dataLogoEmpresa    = $this->M_Archivo->getByID($dataEmpresa[0]->id_archivo_logo);
        
        if (sizeof($dataLogoEmpresa) > 0) {
            $modulo->icono_empresa = $dataLogoEmpresa[0]->url_archivo;
        } else {
            $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/image_not_found.png"; // Colocar logo de store por defecto
        }
        
        $modulo->datos_usuario = $dataUsuario[0];
        $modulo->datos_empresa = $dataEmpresa[0];
                
        /* Datos de la cabecera del panel de administrador */
        $modulo->nombres_usuario = $dataUsuario[0]->nombres_persona." ".$dataUsuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $dataUsuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = $dataEmpresa[0]->nombre_empresa;
        $modulo->nombre_empresa_corto = $dataEmpresa[0]->nombre_empresa;
        /* --------------------*-------------------- */
        
        $modulo->url_signout = base_url()."admin/signOut";
        $modulo->url_main_panel = base_url()."store/".$this->session->id_empresa."/admin";
        
        return $modulo;
    }

}