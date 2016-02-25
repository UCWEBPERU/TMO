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
        $this->load->model("M_Tipo_Empresa");
        $this->load->model("admin/M_Admin_Paquetes_TMO");
        $this->usersession->validateSession("panel-company-admin");
    }

    public function index()	{
        $modulo = $this->paneladmin->loadPanelCompany();

        $modulo->titulo_pagina = $modulo->datos_empresa->organization." | Panel Administrativo - Company Profile";
        $modulo->menu = array("menu" => 1, "submenu" => 0);
        $modulo->url_module_panel = $modulo->url_main_panel."/company-profile";

        $modulo->tipo_empresa               = $this->M_Tipo_Empresa->getTipoEmpresa();
        $modulo->paquetes_tmo               = $this->M_Admin_Paquetes_TMO->getPaquetesTMO();
        $modulo->suscripcion_paquete_tmo    = $this->M_Admin_Paquetes_TMO->getPaqueteTMOByEmpresa($this->session->id_empresa);
        $modulo->suscripcion_paquete_tmo    = $modulo->suscripcion_paquete_tmo[0];
        $modulo->data_geo_countries         = $this->M_GEO_Data->getAllCountries();
        $modulo->data_geo_regions           = $this->M_GEO_Data->getRegionsByCountry($modulo->datos_empresa->pais);
        $modulo->data_geo_cities            = $this->M_GEO_Data->getCitiesByRegionAndCountry(
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

    public function ajaxUpdateDataCompany() {
        $this->load->model('M_Empresa');
        $this->load->model('M_Tipo_Empresa');
        $this->load->model('M_GEO_Data');
        $this->load->library('security/Cryptography');

        $json 				= new stdClass();
        $json->type 		= "Empresa";
        $json->presentation = "";
        $json->action 		= "insert";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("txtFirstName") &&
            $this->input->post("txtLastName") &&
            $this->input->post("txtEmail") &&
            $this->input->post("txtOrganization") &&
            $this->input->post("cboTipoEmpresa") &&
            $this->input->post("cboPaqueteTmo") &&
            $this->input->post("txtMobilePhone") &&
            $this->input->post("cboCountry") &&
            $this->input->post("cboRegion") &&
            $this->input->post("cboCity") &&
            $this->input->post("txtAddress")) {

            $empresa = $this->M_Empresa->getByID($this->session->id_empresa);
            /* Validar Datos */
            $validate = $this->M_Empresa->getEmpresaByName(trim($this->input->post("txtOrganization", TRUE)));

            if ($empresa[0]->organization == $validate[0]->organization) {
                unset($validate);
                $validate = $this->M_Tipo_Empresa->getByID(trim($this->input->post("cboTipoEmpresa", TRUE)));

                if (sizeof($validate) > 0) {
                    unset($validate);
                    $validate = $this->M_GEO_Data->getCountryByCode(trim($this->input->post("cboCountry", TRUE)));

                    if (sizeof($validate) > 0) {
                        unset($validate);
                        $validate = $this->M_GEO_Data->getRegionByCodeAndCountry(
                            array(
                                "code_country"	=> trim($this->input->post("cboCountry", TRUE)),
                                "code_region"	=> trim($this->input->post("cboRegion", TRUE))
                            ));

                        if (sizeof($validate) > 0) {
                            unset($validate);
                            $validate = $this->M_GEO_Data->getCityByIDAndRegionAndCountry(
                                array(
                                    "id_city"		=> trim($this->input->post("cboCity", TRUE)),
                                    "code_country"	=> trim($this->input->post("cboCountry", TRUE)),
                                    "code_region"	=> trim($this->input->post("cboRegion", TRUE))
                                ));

                            if (sizeof($validate) > 0) {

                                /* Registrar Datos */

                                $result1 = $this->M_Admin_Empresa->insertEmpresa(
                                    array(
                                        "id_tipo_empresa"			=> trim($this->input->post("cboTipoEmpresa", TRUE)),
                                        "organization"				=> trim($this->input->post("txtOrganization", TRUE)),
                                        "nombres_representante"		=> trim($this->input->post("txtFirstName", TRUE)),
                                        "apellidos_representante"	=> trim($this->input->post("txtLastName", TRUE)),
                                        "email_representante"		=> trim($this->input->post("txtEmail", TRUE)),
                                        "celular_personal"			=> trim($this->input->post("txtMobilePhone", TRUE)),
                                        "telefono"					=> trim($this->input->post("txtHomePhone", TRUE)),
                                        "celular_trabajo"			=> trim($this->input->post("txtWorkPhone", TRUE)),
                                        "fax"						=> trim($this->input->post("txtFax", TRUE)),
                                        "pais"						=> trim($this->input->post("cboCountry", TRUE)),
                                        "region"					=> trim($this->input->post("cboRegion", TRUE)),
                                        "ciudad"					=> trim($this->input->post("cboCity", TRUE)),
                                        "direccion"					=> trim($this->input->post("txtAddress", TRUE)),
                                        "direccion_2"				=> trim($this->input->post("txtAddress2", TRUE))
                                    )
                                );

                                $json->message = "Los datos de la empresa se actualizo correctamente.";
                                array_push($json->data, array("id_empresa" => $result1));
                                $json->status = TRUE;

                            } else {
                                $json->message = "Lo sentimos la ciudad ingresada no existe, intente de nuevo.";
                            }

                        } else {
                            $json->message = "Lo sentimos el estado/region ingresado no existe, intente de nuevo.";
                        }

                    } else {
                        $json->message = "Lo sentimos el pais ingresado no existe, intente de nuevo.";
                    }

                } else {
                    $json->message = "Lo sentimos el tipo de empresa ingresado no existe, intente de nuevo.";
                }

            } else {
                $json->message = "Lo sentimos la nombre de empresa ingresado ya existe, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);

    }


}