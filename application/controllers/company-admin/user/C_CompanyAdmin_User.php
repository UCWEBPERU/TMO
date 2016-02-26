<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_CompanyAdmin_User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-company-admin");
        $this->load->model("M_Usuario");
        $this->load->model('company-admin/M_CompanyAdmin_User');
        $this->load->library('utils/PanelAdmin');
    }

    public function index()	{
        $this->load->library('pagination');

        /* Datos de la cabecera del panel de administrador*/
        $modulo                     = $this->paneladmin->loadPanelCompany();
        $modulo->titulo_pagina      = $modulo->datos_empresa->organization." | Panel Administrativo - User";
        $modulo->url_module_panel   = $modulo->url_main_panel."/user";

        $modulo->nombre 					= "User";
        $modulo->titulo 					= "User";
        $modulo->titulo_registro 			= "Registro de Usuarios";
        $modulo->cabecera_registro 			= array("Nombres", "Apellidos", "Email", "Celular Personal", "Telefono", "Celular Trabajo", "Fecha Registro");
        $modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-user";
        $modulo->base_url 					= "admin/empresa/";
        $modulo->api_rest_params 			= array("delete" => "id_empresa");
        $modulo->menu 						= array("menu" => 3, "submenu" => 0);
        $modulo->navegacion 				= array(
            array("nombre" => "User",
                "url" => "",
                "activo" => TRUE)
        );

        $config 							= array();
        $config["base_url"] 				= $modulo->url_main_panel."/user/page";
        $total_row 							= $this->M_CompanyAdmin_User->getTotalUser($this->session->id_empresa);
        $config["total_rows"] 				= $total_row;
        $config["per_page"] 				= 15;
        $config['use_page_numbers'] 		= TRUE;
        $config['cur_tag_open'] 			= '&nbsp;<a class="current">';
        $config['cur_tag_close'] 			= '</a>';
        $config['next_link'] 				= 'Siguiente';
        $config['prev_link'] 				= 'Anterior';
        $config['first_link'] 				= 'Primero';
        $config['last_link'] 				= 'Ultimo';
        $config["uri_segment"] 				= 6;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 1;

        $modulo->registros = $this->M_CompanyAdmin_User->fetchUser($config["per_page"], ($page - 1) * 15, $this->session->id_empresa);
        $str_links = $this->pagination->create_links();
        $modulo->links = explode('&nbsp;',$str_links);

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/user/v-company-admin-user', $data);
    }

    public function addUser() {
        $this->load->model("M_GEO_Data");
        $this->load->model("admin/M_Admin_Paquetes_TMO");
        $this->load->model('M_Tipo_Empresa');

        /* Datos de la cabecera del panel de administrador*/
        $modulo                     = $this->paneladmin->loadPanelCompany();
        $modulo->titulo 			= "Store";
        $modulo->titulo_pagina      = $modulo->datos_empresa->organization." | Panel Administrativo - Store";
        $modulo->url_module_panel   = $modulo->url_main_panel."/store";
        $modulo->menu               = array("menu" => 2, "submenu" => 0);

        $modulo->data_geo_countries 	= $this->M_GEO_Data->getAllCountries();

        $data["modulo"] 				= $modulo;

        $this->load->view('company-admin/module/user/v-company-admin-user-agregar', $data);
    }

    public function ajaxAddUser() {
        $json 				= new stdClass();
        $json->type 		= "Store";
        $json->presentation = "";
        $json->action 		= "insert";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("txtNameStore") &&
            $this->input->post("cboCountry") &&
            $this->input->post("cboRegion") &&
            $this->input->post("cboCity") &&
            $this->input->post("txtAddress")) {

            $validate   = $this->M_CompanyAdmin_User->getSuscripcionPaqueteTMO($this->session->id_empresa);
            $totalStore = $this->M_CompanyAdmin_User->getTotalStore($this->session->id_empresa);

            if (sizeof($validate) > 0) {
                if ($totalStore < intval($validate[0]->total_store)) {
                    unset($validate);

                    $resul1 = $this->M_CompanyAdmin_User->insertPayAccount(
                        array(
                            'pay_id'             => trim($this->input->post("txtIDPayAccount", TRUE)),
                            'tipo_metodo_pago'   => trim($this->input->post("txtTypePayAccount", TRUE))
                        )
                    );

                    $resul2 = $this->M_CompanyAdmin_User->insertStore(
                        array(
                            "nombre_tienda"     => trim($this->input->post("txtNameStore", TRUE)),
                            "nro_celular"       => trim($this->input->post("txtMobilePhone", TRUE)),
                            "nro_telefono"      => trim($this->input->post("txtStorePhone", TRUE)),
                            "pais"              => trim($this->input->post("cboCountry", TRUE)),
                            "region"		    => trim($this->input->post("cboRegion", TRUE)),
                            "ciudad"		    => trim($this->input->post("cboCity", TRUE)),
                            "direccion"		    => trim($this->input->post("txtAddress", TRUE)),
                            "gps_latitud"       => trim($this->input->post("txtGPSLatitud", TRUE)),
                            "gps_longitud"      => trim($this->input->post("txtGPSLongitud", TRUE)),
                            "id_pay_account"    => $resul1
                        )
                    );

                    $resul3 = $this->M_CompanyAdmin_User->insertSucursales(
                        array(
                            "id_empresa" => $this->session->id_empresa,
                            "id_tienda"  => $resul2
                        )
                    );

                    $json->message = "La tienda se agrego correctamente.";
                    $json->status 	= TRUE;

                } else {
                    $json->message 	= "Lo sentimos su suscripción actual solo le permite tener (".$validate[0]->total_store.") tienda(s).";
                }
            } else {
                $json->message 	= "Lo sentimos al parecer no tiene una suscripción activa.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

}