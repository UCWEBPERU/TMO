<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_CompanyAdmin_Perfil_Empresa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->load->library('utils/PanelAdmin');
        $this->load->model("M_GEO_Data");
        $this->usersession->validateSession("panel-company-admin");
    }

    public function index()	{
        $modulo = $this->paneladmin->loadPanelCompany();

        $modulo->titulo_pagina = $modulo->datos_empresa->organization." | Panel Administrativo - Company Profile";
        $modulo->menu = array("menu" => 1, "submenu" => 0);

        $modulo->data_geo_countries = $this->M_GEO_Data->getAllCountries();
        $modulo->data_geo_regions   = $this->M_GEO_Data->getRegionsByCountry($modulo->datos_usuario->pais_persona);
        $modulo->data_geo_cities    = $this->M_GEO_Data->getCitiesByRegionAndCountry(
            array(
                "code_country"  => $modulo->datos_usuario->pais_persona,
                "code_region"   => $modulo->datos_usuario->region_persona
            )
        );

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/perfil-empresa/v-company-admin-perfil-empresa', $data);
    }

}