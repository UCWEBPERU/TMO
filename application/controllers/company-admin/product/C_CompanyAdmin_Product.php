<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_CompanyAdmin_Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-company-admin");
        $this->load->model("M_Usuario");
        $this->load->model('company-admin/M_CompanyAdmin_Product');
        $this->load->library('utils/PanelAdmin');
    }

    public function index()	{
        $this->load->library('pagination');

        /* Datos de la cabecera del panel de administrador*/
        $modulo                     = $this->paneladmin->loadPanelCompany();
        $modulo->titulo_pagina      = $modulo->datos_empresa->organization." | Panel Administrativo - Product";
        $modulo->url_module_panel   = $modulo->url_main_panel."/product";

        $modulo->nombre 					= "Product";
        $modulo->titulo 					= "Product";
        $modulo->titulo_registro 			= "Registro de Productos";
        $modulo->cabecera_registro 			= array("Nombre", "Descripción", "Stock", "Precio", "Tienda");
        $modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-product";
        $modulo->menu 						= array("menu" => 3, "submenu" => 0);
        $modulo->navegacion 				= array(
            array("nombre" => "Product",
                "url" => "",
                "activo" => TRUE)
        );

        $config 							= array();
        $config["base_url"] 				= $modulo->url_main_panel."/product/page";
        $total_row 							= $this->M_CompanyAdmin_Product->getTotalProduct($this->session->id_empresa);
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

        $modulo->registros = $this->M_CompanyAdmin_Product->fetchProduct($config["per_page"], ($page - 1) * 15, $this->session->id_empresa);
        $str_links = $this->pagination->create_links();
        $modulo->links = explode('&nbsp;',$str_links);

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/product/v-company-admin-product', $data);
    }

    public function addProduct() {
        $this->load->model("M_GEO_Data");
        $this->load->model("admin/M_Admin_Paquetes_TMO");
        $this->load->model('M_Tipo_Empresa');
        $this->load->model('company-admin/M_CompanyAdmin_Categorias');

        /* Datos de la cabecera del panel de administrador*/
        $modulo                     = $this->paneladmin->loadPanelCompany();
        $modulo->titulo 			= "Product";
        $modulo->titulo_pagina      = $modulo->datos_empresa->organization." | Panel Administrativo - Add Product";
        $modulo->url_module_panel   = $modulo->url_main_panel."/product";
        $modulo->menu               = array("menu" => 3, "submenu" => 0);

        $modulo->data_geo_countries = $this->M_GEO_Data->getAllCountries();
        $modulo->data_tiendas       = $this->M_CompanyAdmin_Product->getAllStore($this->session->id_empresa);

        $modulo->data_categorias    = $this->M_CompanyAdmin_Categorias->getAllCategorys(array("id_empresa" => $this->session->id_empresa));

        $data["modulo"] 		    = $modulo;

        $this->load->view('company-admin/module/product/v-company-admin-product-agregar', $data);
    }

    public function editUser($id_usuario) {
        $this->load->model("M_GEO_Data");
        $this->load->model("admin/M_Admin_Paquetes_TMO");
        $this->load->model('M_Tipo_Empresa');

        /* Datos de la cabecera del panel de administrador*/
        $modulo                     = $this->paneladmin->loadPanelCompany();
        $modulo->titulo 			= "Product";
        $modulo->titulo_pagina      = $modulo->datos_empresa->organization." | Panel Administrativo - Edit Product";
        $modulo->url_module_panel   = $modulo->url_main_panel."/product";
        $modulo->menu               = array("menu" => 3, "submenu" => 0);

        $result  = $this->M_Usuario->getByID($id_usuario);

        if (count($result) > 0) {
            $data["dataUsuario"] 	= $result[0];
            $data["existeUsuario"]	= TRUE;

            $modulo->data_geo_countries = $this->M_GEO_Data->getAllCountries();
            $modulo->data_geo_regions   = $this->M_GEO_Data->getRegionsByCountry($result[0]->pais_persona);
            $modulo->data_geo_cities    = $this->M_GEO_Data->getCitiesByRegionAndCountry(
                array(
                    "code_country"  => $result[0]->pais_persona,
                    "code_region"   => $result[0]->region_persona
                )
            );

        } else {
            $data["dataUsuario"]  	= NULL;
            $data["existeUsuario"]	= FALSE;
        }

        $data["modulo"]             = $modulo;

        $this->load->view('company-admin/module/user/v-company-admin-user-editar', $data);
    }

    public function ajaxAddUser() {
        $this->load->library('security/Cryptography');
        $json 				= new stdClass();
        $json->type 		= "User";
        $json->presentation = "";
        $json->action 		= "insert";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("txtFirstName") &&
            $this->input->post("txtLastName") &&
            $this->input->post("txtEmail") &&
            $this->input->post("txtPassword") &&
            $this->input->post("txtRepeatPassword") &&
            $this->input->post("txtMobilePhone") &&
            $this->input->post("cboCountry") &&
            $this->input->post("cboRegion") &&
            $this->input->post("cboCity")) {

            $validate   = $this->M_CompanyAdmin_Product->getSuscripcionPaqueteTMO($this->session->id_empresa);
            $totalStore = $this->M_CompanyAdmin_Product->getTotalUser($this->session->id_empresa);

            if (sizeof($validate) > 0) {
                if ($totalStore < intval($validate[0]->total_users)) {
                    unset($validate);

                    $resul1 = $this->M_CompanyAdmin_Product->insertUsuario(
                        array(
                            'email_usuario'    => trim($this->input->post("txtEmail", TRUE)),
                            'password_usuario' => $this->cryptography->Encrypt(trim($this->input->post("txtPassword", TRUE)))
                        )
                    );

                    $resul2 = $this->M_CompanyAdmin_Product->insertPersona(
                        array(
                            'id_usuario'		    => $resul1,
                            'nombres_persona'		=> trim($this->input->post("txtFirstName", TRUE)),
                            'apellidos_persona'		=> trim($this->input->post("txtLastName", TRUE)),
                            'pais_persona'			=> trim($this->input->post("cboCountry", TRUE)),
                            'region_persona'		=> trim($this->input->post("cboRegion", TRUE)),
                            'ciudad_persona'		=> trim($this->input->post("cboCity", TRUE)),
                            'direccion_persona'		=> '',
                            'celular_personal'		=> trim($this->input->post("txtMobilePhone", TRUE)),
                            'telefono'				=> trim($this->input->post("txtHomePhone", TRUE)),
                            'celular_trabajo'		=> trim($this->input->post("txtWorkPhone", TRUE))
                        )
                    );

                    $resul3 = $this->M_CompanyAdmin_Product->insertUsuariosAsignados(
                        array(
                            "id_empresa" => $this->session->id_empresa,
                            "id_usuario" => $resul1
                        )
                    );

                    $json->message = "El usuario se agrego correctamente.";
                    $json->status 	= TRUE;

                } else {
                    $json->message 	= "Lo sentimos su suscripción actual solo le permite tener (".$validate[0]->total_store.") usuario(s).";
                }
            } else {
                $json->message 	= "Lo sentimos al parecer no tiene una suscripción activa.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

    public function ajaxEditUser() {
        $this->load->library('security/Cryptography');
        $json 				= new stdClass();
        $json->type 		= "User";
        $json->presentation = "";
        $json->action 		= "update";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ($this->input->post("id_usuario") &&
            $this->input->post("txtFirstName") &&
            $this->input->post("txtLastName") &&
            $this->input->post("txtMobilePhone") &&
            $this->input->post("cboCountry") &&
            $this->input->post("cboRegion") &&
            $this->input->post("cboCity")) {

            $dataUsuario = $this->M_Usuario->getByIDAndEmpresa(
                array(
                    "id_usuario" => trim($this->input->post("id_usuario", TRUE)),
                    "id_empresa" => $this->session->id_empresa
                )
            );

            if (sizeof($dataUsuario) > 0) {

                if ($this->input->post("txtPassword")) {
                    $resul1 = $this->M_CompanyAdmin_Product->updatePassWordUsuario(
                        array(
                            'id_usuario'    => trim($this->input->post("id_usuario", TRUE)),
                            'password_usuario' => $this->cryptography->Encrypt(trim($this->input->post("txtPassword", TRUE)))
                        )
                    );
                }

                $resul2 = $this->M_CompanyAdmin_Product->updateUsuario(
                    array(
                        'id_usuario'        => trim($this->input->post("id_usuario", TRUE)),
                        'nombres_persona'	=> trim($this->input->post("txtFirstName", TRUE)),
                        'apellidos_persona'	=> trim($this->input->post("txtLastName", TRUE)),
                        'pais_persona'		=> trim($this->input->post("cboCountry", TRUE)),
                        'region_persona'	=> trim($this->input->post("cboRegion", TRUE)),
                        'ciudad_persona'	=> trim($this->input->post("cboCity", TRUE)),
                        'direccion_persona' => '',
                        'celular_personal'  => trim($this->input->post("txtMobilePhone", TRUE)),
                        'telefono'          => trim($this->input->post("txtHomePhone", TRUE)),
                        'celular_trabajo'   => trim($this->input->post("txtWorkPhone", TRUE))
                    )
                );

                $json->message  = "El usuario se actualizo correctamente.";
                $json->status   = TRUE;

            } else {
                $json->message = "Lo sentimos el usuario que desea editar no existe.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

    public function ajaxGeneratePassword() {
        $this->load->library("utils/Password");

        $json 				= new stdClass();
        $json->type 		= "Generate Password";
        $json->presentation = "data";
        $json->action 		= "";
        $json->data 		= array("password" => $this->password->generate());
        $json->message 		= "Contraseña generada correctamente.";
        $json->status 		= TRUE;

        echo json_encode($json);
    }

}