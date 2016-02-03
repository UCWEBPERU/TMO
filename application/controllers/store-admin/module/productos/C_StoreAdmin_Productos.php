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

	public function index()	{
        $this->load->model("store-admin/M_StoreAdmin_Empresa");

        $modulo = new stdClass();
        
        $dataEmpresa        = $this->M_Empresa->getByID($this->session->id_empresa);
        $dataUsuario        = $this->M_Usuario->getByID($this->session->id_usuario);
        $dataLogoEmpresa    = $this->M_Archivo->getByID($dataEmpresa[0]->id_archivo_logo);
        $dataPayAccount     = $this->M_StoreAdmin_Empresa->getPayAccountByID($dataEmpresa[0]->id_pay_account);
        $dataTipoEmpresa    = $this->M_Tipo_Empresa->getTipoEmpresa();
        
        if (sizeof($dataLogoEmpresa) > 0) {
            $modulo->icono_empresa = $dataLogoEmpresa[0]->url_archivo;
        } else {
            $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/image_not_found.png"; // Colocar logo de store por defecto
        }
        
        $modulo->titulo_pagina = $dataEmpresa[0]->nombre_empresa." | Panel Administrativo - Store";
        
        $modulo->datos_usuario = $dataUsuario[0];
        $modulo->datos_empresa = $dataEmpresa[0];
        $modulo->datos_tipo_empresa = $dataTipoEmpresa;
        if (sizeof($dataPayAccount) > 0) {
            $modulo->datos_pay_account = $dataPayAccount[0];
        }
                
        /* Datos de la cabecera del panel de administrador */
        $modulo->nombres_usuario = $dataUsuario[0]->nombres_persona." ".$dataUsuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $dataUsuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = $dataEmpresa[0]->nombre_empresa;
        $modulo->nombre_empresa_corto = $dataEmpresa[0]->nombre_empresa;
        /* --------------------*-------------------- */
        
        $modulo->url_signout = base_url()."admin/signOut";
        $modulo->url_main_panel = base_url()."store/".$this->session->id_empresa."/admin";
        $modulo->menu = array("menu" => 1, "submenu" => 0);
        
        $data["modulo"] = $modulo;
        $this->load->view('store-admin/module/empresa/v-store-admin-empresa', $data);
	}
    
    public function listAllCategories() {
        $modulo = $this->loadDataPanel();
        $modulo->menu = array("menu" => 3, "submenu" => 0);
        $modulo->titulo_pagina = $modulo->datos_empresa->nombre_empresa." | Panel Administrativo - Categorias";
        
        $datosCategorias = $this->M_StoreAdmin_Productos->getAllCategories($this->session->id_empresa);
        
        foreach ($datosCategorias as $categoria) {
            $subCategoria = $this->M_StoreAdmin_Productos->getSubCategoryByIDCategory($categoria->id_categoria);
            $categoria->total_subcategorias = count($subCategoria);
        }
        
        $modulo->data_categorias = $datosCategorias;
        
        $data["modulo"] = $modulo;
        $this->load->view('store-admin/module/productos/v-store-admin-categorias', $data);
    }
    
    public function addCategory() {
        $modulo = $this->loadDataPanel();
        $modulo->menu = array("menu" => 3, "submenu" => 0);
        $modulo->titulo_pagina = $modulo->datos_empresa->nombre_empresa." | Panel Administrativo - Agregar Categoria";
        
        $datosCategorias = $this->M_StoreAdmin_Productos->getAllCategories($this->session->id_empresa);
        $modulo->data_categorias = $datosCategorias;
        
        $data["modulo"] = $modulo;
        $this->load->view('store-admin/module/productos/v-store-admin-categorias-add', $data);
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