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
        $modulo->url_module_panel = $modulo->url_main_panel."/company-profile";

        $modulo->data_geo_countries = $this->M_GEO_Data->getAllCountries();
        $modulo->data_geo_regions   = $this->M_GEO_Data->getRegionsByCountry($modulo->datos_empresa->pais);
        $modulo->data_geo_cities    = $this->M_GEO_Data->getCitiesByRegionAndCountry(
            array(
                "code_country"  => $modulo->datos_empresa->pais,
                "code_region"   => $modulo->datos_empresa->region
            )
        );

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/perfil-empresa/v-company-admin-perfil-empresa', $data);
    }

    public function ajaxUpdateLogoCompany() {
        $this->load->model("M_Archivo");
        $this->load->model("M_Empresa");
        $this->load->library('utils/UploadFile');

        $json 				= new stdClass();
        $json->type 		= "Logo Empresa";
        $json->presentation = "";
        $json->action 		= "update";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->uploadfile->validateFile("imgLogoStore") ) {
            $dataEmpresa = $this->M_Empresa->getByID($this->session->id_empresa);

            $path = "uploads/company/".$this->session->id_empresa."/logo/";

            $path = $this->uploadfile->upload("imgLogoStore", "logo", $path);

            $result = $this->M_Archivo->updateURLArchivo(
                array(
                    "id_archivo"   => $dataEmpresa[0]->id_archivo_logo,
                    "url_archivo"  => $path
                )
            );

            if ($result) {
                $json->message = "El logo de la empresa se actualizó correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "Ocurrio un error al al actualizar el logo de la empresa, intente de nuevo.";
            }
        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }


}