<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_StoreAdmin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-store-admin");
	}

	public function index()	{
        $this->load->model("store-admin/M_StoreAdmin");
        $this->load->model('M_Archivo');
        $this->load->model('M_Empresa');
        
        $modulo = new stdClass();
        
        $dataEmpresa = $this->M_Empresa->getByID( $this->session->id_empresa );
            
        $validateLogoEmpresa = $this->M_Archivo->getByID($dataEmpresa[0]->id_archivo_logo);
        
        if (sizeof($validateLogoEmpresa) > 0) {
            $modulo->icono_empresa = $validateLogoEmpresa[0]->url_archivo;
        } else {
            // Colocar logo de store por defecto
            $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/image_not_found.png";
        }
        
        $modulo->titulo_pagina = $dataEmpresa[0]->nombre_empresa." | Panel Administrativo";
        
        $usuario = $this->M_StoreAdmin->getByID($this->session->id_usuario);
        
        $modulo->datos_usuario = $usuario[0];
        
        /* Datos de la cabecera del panel de administrador */
        $modulo->nombres_usuario = $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $usuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = $dataEmpresa[0]->nombre_empresa;
        $modulo->nombre_empresa_corto = $dataEmpresa[0]->nombre_empresa;
        /* --------------------*-------------------- */
        
        $modulo->url_signout = base_url()."admin/signOut";
        $modulo->url_main_panel = base_url()."store/".$this->session->id_empresa."/admin";
        
        $data["modulo"] = $modulo;
        $this->load->view('store-admin/v-store-admin-panel', $data);
	}

}