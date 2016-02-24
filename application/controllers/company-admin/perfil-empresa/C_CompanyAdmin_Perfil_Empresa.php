<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_CompanyAdmin_Perfil_Empresa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->load->library('utils/PanelAdmin');
        $this->usersession->validateSession("panel-company-admin");
    }

    public function index()	{
        $modulo = $this->paneladmin->loadData();

        $modulo->titulo_pagina = $modulo->datos_empresa->organization." | Panel Administrativo - Company Profile";
        $modulo->menu = array("menu" => 1, "submenu" => 0);

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/perfil-empresa/v-company-admin-perfil-empresa', $data);
    }

}