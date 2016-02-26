<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_CompanyAdmin_Store extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-company-admin");
        $this->load->model("M_Usuario");
        $this->load->model('company-admin/M_CompanyAdmin_Store');
    }

    public function index()	{
        $this->load->library('pagination');
        $this->load->library('utils/PanelAdmin');

        /* Datos de la cabecera del panel de administrador*/
        $modulo = $this->paneladmin->loadPanelCompany();

        $modulo->titulo_pagina = $modulo->datos_empresa->organization." | Panel Administrativo - Store";
        $modulo->url_module_panel = $modulo->url_main_panel."/store";

        $modulo->nombre 					= "Store";
        $modulo->titulo 					= "Store";
        $modulo->titulo_registro 			= "Registro de Tiendas";
        $modulo->cabecera_registro 			= array("Nombre Store", "Nro Celular", "Direccion", "GPS - Latitud", "GPS - Longitud");
        $modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-store";
        $modulo->base_url 					= "admin/empresa/";
        $modulo->api_rest_params 			= array("delete" => "id_empresa");
        $modulo->menu 						= array("menu" => 2, "submenu" => 0);
        $modulo->navegacion 				= array(
            array("nombre" => "Store",
                "url" => "",
                "activo" => TRUE)
        );

        $config 							= array();
        $config["base_url"] 				= $modulo->url_main_panel."/store/page";
        $total_row 							= $this->M_CompanyAdmin_Store->getTotalStore($this->session->id_empresa);
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

        $modulo->registros = $this->M_CompanyAdmin_Store->fetchStore($config["per_page"], ($page - 1) * 15, $this->session->id_empresa);
        $str_links = $this->pagination->create_links();
        $modulo->links = explode('&nbsp;',$str_links);

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/store/v-company-admin-store', $data);
    }

//    public function agregar() {
//        $this->load->model("M_GEO_Data");
//        $this->load->model("admin/M_Admin_Paquetes_TMO");
//        $modulo = new stdClass();
//
//        $usuario = $this->M_Usuario->getByID($this->session->id_usuario);
//        $modulo->datos_usuario = $usuario[0];
//
//        $modulo->titulo 			    = "Empresa";
//        $modulo->titulo_pagina          = "TMO | Panel Principal - Empresa";
//        $modulo->icono_empresa          = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
//        $modulo->nombres_usuario        = $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
//        $modulo->tipo_usuario           = $usuario[0]->nombre_tipo_usuario;
//        $modulo->nombre_empresa_largo   = "Take My Order";
//        $modulo->nombre_empresa_corto   = "TMO";
//        $modulo->url_signout            = base_url()."/admin/signOut";
//        $modulo->nombreSeccion          = "Agregar";
//        $modulo->base_url 		        = "admin/empresa/";
//        $modulo->url_main_panel         = base_url()."admin";
//
//        $modulo->menu                   = array("menu" => 1, "submenu" => 0);
//        $modulo->tipo_empresa		    = $this->M_Admin_Empresa->getTipoEmpresa();
//        $modulo->paquetes_tmo 			= $this->M_Admin_Paquetes_TMO->getPaquetesTMO();
//
//        $modulo->data_geo_countries 	= $this->M_GEO_Data->getAllCountries();
//
//        $data["modulo"] 				= $modulo;
//
//        $this->load->view('admin/module/empresa/v-admin-empresa-agregar', $data);
//    }
//
//    public function edit($idEmpresa) {
//        if (isset($idEmpresa)) {
//            $modulo = new stdClass();
//
//            $usuario = $this->M_Usuario->getByID($this->session->id_usuario);
//            $modulo->datos_usuario = $usuario[0];
//
//            $modulo->titulo 				= "Empresa";
//            $modulo->titulo_pagina 			= "TMO | Panel Principal - Empresa";
//            $modulo->icono_empresa 			= PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
//            $modulo->nombres_usuario        = $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
//            $modulo->tipo_usuario           = $usuario[0]->nombre_tipo_usuario;
//            $modulo->nombre_empresa_largo	= "Take My Order";
//            $modulo->nombre_empresa_corto 	= "TMO";
//            $modulo->url_signout 			= base_url()."/admin/signOut";
//            $modulo->nombreSeccion 			= "Editar";
//            $modulo->base_url 				= "admin/empresa/";
//            $modulo->url_main_panel         = base_url()."admin";
//            $modulo->menu                   = array("menu" => 1, "submenu" => 0);
//
//            $result = $this->M_Admin_Empresa->getEmpresaByID($idEmpresa);
//            if (count($result) > 0) {
//                $data["dataEmpresa"] 	= $result[0];
//                $data["existeEmpresa"]	= TRUE;
//            } else {
//                $data["dataEmpresa"] 	= NULL;
//                $data["existeEmpresa"]	= FALSE;
//            }
//            $modulo->id_empresa 		= $idEmpresa;
//
//
//            $data["modulo"] 		= $modulo;
//            $this->load->view('admin/module/empresa/v-admin-empresa-agregar', $data);
//        } else {
//            redirect('/');
//        }
//    }
//
//    public function insert() {
//        $this->load->model('M_Empresa');
//        $this->load->model('M_Tipo_Empresa');
//        $this->load->model('M_GEO_Data');
//        $this->load->model('admin/M_Admin_Paquetes_TMO');
//        $this->load->library('security/Cryptography');
//
//        $json 				= new stdClass();
//        $json->type 		= "Empresa";
//        $json->presentation = "";
//        $json->action 		= "insert";
//        $json->data 		= array();
//        $json->status 		= FALSE;
//
//        if ( $this->input->post("txtFirstName") &&
//            $this->input->post("txtLastName") &&
//            $this->input->post("txtEmail") &&
//            $this->input->post("txtPassword") &&
//            $this->input->post("txtRepeatPassword") &&
//            $this->input->post("txtOrganization") &&
//            $this->input->post("cboTipoEmpresa") &&
//            $this->input->post("txtMobilePhone") &&
//            $this->input->post("cboCountry") &&
//            $this->input->post("cboRegion") &&
//            $this->input->post("cboCity") &&
//            $this->input->post("txtAddress") &&
//            $this->input->post("cboPaqueteTmo")) {
//
//            /* Validar Datos */
//            $validate = $this->M_Empresa->getEmpresaByName(trim($this->input->post("txtOrganization", TRUE)));
//
//            if (sizeof($validate) == 0) {
//                unset($validate);
//                $validate = $this->M_Usuario->getByEmail(trim($this->input->post("txtEmail", TRUE)));
//
//                if (sizeof($validate) == 0) {
//                    unset($validate);
//                    $validate = $this->M_Tipo_Empresa->getByID(trim($this->input->post("cboTipoEmpresa", TRUE)));
//
//                    if (sizeof($validate) > 0) {
//                        unset($validate);
//                        $validate = $this->M_Admin_Paquetes_TMO->getPaqueteTMOByID(trim($this->input->post("cboPaqueteTmo", TRUE)));
//
//                        if (sizeof($validate) > 0) {
//                            unset($validate);
//                            $validate = $this->M_GEO_Data->getCountryByCode(trim($this->input->post("cboCountry", TRUE)));
//
//                            if (sizeof($validate) > 0) {
//                                unset($validate);
//                                $validate = $this->M_GEO_Data->getRegionByCodeAndCountry(
//                                    array(
//                                        "code_country"	=> trim($this->input->post("cboCountry", TRUE)),
//                                        "code_region"	=> trim($this->input->post("cboRegion", TRUE))
//                                    ));
//
//                                if (sizeof($validate) > 0) {
//                                    unset($validate);
//                                    $validate = $this->M_GEO_Data->getCityByIDAndRegionAndCountry(
//                                        array(
//                                            "id_city"		=> trim($this->input->post("cboCity", TRUE)),
//                                            "code_country"	=> trim($this->input->post("cboCountry", TRUE)),
//                                            "code_region"	=> trim($this->input->post("cboRegion", TRUE))
//                                        ));
//
//                                    if (sizeof($validate) > 0) {
//
//                                        /* Registrar Datos */
//                                        $result1 = $this->M_Admin_Empresa->insertUsuario(
//                                            array(
//                                                "email" 	=> trim($this->input->post("txtEmail", TRUE)),
//                                                "password" 	=> $this->cryptography->Encrypt(trim($this->input->post("txtPassword", TRUE)))
//                                            )
//                                        );
//
//                                        $result2 = $this->M_Admin_Empresa->insertPersona(
//                                            array(
//                                                'id_usuario'         => $result1,
//                                                'nombres_persona'    => trim($this->input->post("txtFirstName", TRUE)),
//                                                'apellidos_persona'  => trim($this->input->post("txtLastName", TRUE))
//                                            )
//                                        );
//
//                                        $result3 = $this->M_Admin_Empresa->insertEmpresa(
//                                            array(
//                                                "id_tipo_empresa"			=> trim($this->input->post("cboTipoEmpresa", TRUE)),
//                                                "organization"				=> trim($this->input->post("txtOrganization", TRUE)),
//                                                "nombres_representante"		=> trim($this->input->post("txtFirstName", TRUE)),
//                                                "apellidos_representante"	=> trim($this->input->post("txtLastName", TRUE)),
//                                                "email_representante"		=> trim($this->input->post("txtEmail", TRUE)),
//                                                "celular_personal"			=> trim($this->input->post("txtMobilePhone", TRUE)),
//                                                "telefono"					=> trim($this->input->post("txtHomePhone", TRUE)),
//                                                "celular_trabajo"			=> trim($this->input->post("txtWorkPhone", TRUE)),
//                                                "fax"						=> trim($this->input->post("txtFax", TRUE)),
//                                                "pais"						=> trim($this->input->post("cboCountry", TRUE)),
//                                                "region"					=> trim($this->input->post("cboRegion", TRUE)),
//                                                "ciudad"					=> trim($this->input->post("cboCity", TRUE)),
//                                                "direccion"					=> trim($this->input->post("txtAddress", TRUE)),
//                                                "direccion_2"				=> trim($this->input->post("txtAddress2", TRUE))
//                                            )
//                                        );
//
//                                        $result4 = $this->M_Admin_Empresa->insertUsuarioAsignado(
//                                            array(
//                                                "id_usuario" => $result1,
//                                                "id_empresa" => $result3
//                                            )
//                                        );
//
//                                        $result5 = $this->M_Admin_Empresa->insertSuscripcionPaqueteTMO(
//                                            array(
//                                                'id_empresa' 				=> $result3,
//                                                'id_paquete_tmo' 			=> trim($this->input->post("cboPaqueteTmo", TRUE)),
//                                                'fecha_inicio_suscripcion' 	=> date("Y-m-d"),
//                                                'fecha_fin_suscripcion' 	=> date('Y-m-d', strtotime("+30 days"))
//                                            )
//                                        );
//
//                                        $path = $this->uploadImage($result3);
//
//                                        $result4 = $this->M_Admin_Empresa->insertArchivo(
//                                            array(
//                                                "url_archivo"     	=> $path["path"],
//                                                "tipo_archivo"      => "image/png",
//                                                "relacion_recurso"  => "logo",
//                                                "nombre_archivo"    => "logo.png"
//                                            )
//                                        );
//
//                                        $this->M_Admin_Empresa->updateIDLogo($result3, $result4);
//
//                                        $json->message = "La empresa se creo correctamente.";
//                                        array_push($json->data, array("id_empresa" => $result4));
//                                        $json->status = TRUE;
//
//                                    } else {
//                                        $json->message = "Lo sentimos la ciudad ingresada no existe, intente de nuevo.";
//                                    }
//
//                                } else {
//                                    $json->message = "Lo sentimos el estado/region ingresado no existe, intente de nuevo.";
//                                }
//
//                            } else {
//                                $json->message = "Lo sentimos el pais ingresado no existe, intente de nuevo.";
//                            }
//
//                        } else {
//                            $json->message = "Lo sentimos el paquete tmo ingresado no existe, intente de nuevo.";
//                        }
//
//                    } else {
//                        $json->message = "Lo sentimos el tipo de empresa ingresado no existe, intente de nuevo.";
//                    }
//
//                } else {
//                    $json->message = "Lo sentimos el email ingresado ya existe, intente de nuevo.";
//                }
//
//            } else {
//                $json->message = "Lo sentimos la nombre de empresa ingresado ya existe, intente de nuevo.";
//            }
//
//        } else {
//            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
//        }
//
//        echo json_encode($json);
//    }
//
//    private function uploadImage($id_empresa) {
//        $this->load->library('utils/UploadFile');
//
//        if ( isset($_FILES["fileLogoEmpresa"]) && !empty($_FILES["fileLogoEmpresa"]) ) {
//            $path = "uploads/company/".$id_empresa."/logo/";
//            $path = $this->uploadfile->upload("fileLogoEmpresa", "logo", $path);
//            return array("state" => TRUE, "path" => $path);
//        }
//
//        return array("state" => FALSE, "path" => base_url()."resources/admin/img/image_not_found.png");
//    }
//
//// 	function cargar_archivo( $url_archivo) {
////
////         $url_archivo = 'logo_empresa';
////         $config['upload_path'] = "/resources/store/$id_empresa/logo/";
////         $config['file_name'] = "logo_store";
////         $config['allowed_types'] = "gif|jpg|jpeg|png";
////         $config['max_size'] = "50000";
////         $config['max_width'] = "3000";
////         $config['max_height'] = "3000";
////         $config['remove_spaces'] = TRUE;
////
////         $this->load->library('upload', $config);
////
////         if (!$this->upload->do_upload($url_archivo)) {
////             //*** ocurrio un error
////             $data['uploadError'] = $this->upload->display_errors();
////             echo $this->upload->display_errors();
////             return;
////         }
////
////         $data['uploadSuccess'] = $this->upload->data();
////     }
//
//    public function delete() {
//        $json 				= new stdClass();
//        $json->type 		= "Empresa";
//        $json->presentation = "";
//        $json->action 		= "delete";
//        $json->data 		= array();
//        $json->status 		= FALSE;
//
//        if ( $this->input->post("id_empresa") ) {
//
//            $result = $this->M_Admin_Empresa->getEmpresaByID(trim($this->input->post("id_empresa", TRUE)));
//
//            if (sizeof($result) > 0) {
//                unset($result);
//                $result = $this->M_Admin_Empresa->delete(trim($this->input->post("id_empresa", TRUE)));
//
//                if ($result) {
//                    $json->message = "La empresa fue eliminado correctamente.";
//                    $json->status 	= TRUE;
//                } else {
//                    $json->message = "Ocurrio un error al eliminar la empresa, intente de nuevo.";
//                }
//            } else {
//                $json->message = "Lo sentimos la empresa que desea eliminar no existe, intente de nuevo.";
//            }
//        } else {
//            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
//        }
//
//        echo json_encode($json);
//    }
//
//    public function update() {
//        $json 				= new stdClass();
//        $json->type 		= "Empresa";
//        $json->presentation = "";
//        $json->action 		= "update";
//        $json->data 		= array();
//        $json->status 		= FALSE;
//
//        if ( $this->input->post("id_tipo_empresa") &&
//            $this->input->post("id_usuario") &&
//            $this->input->post("id_pay_account") &&
//            $this->input->post("id_archivo_logo") &&
//            $this->input->post("nombre_empresa") &&
//            $this->input->post("descripcion_empresa") &&
//            $this->input->post("direccion_empresa") &&
//            $this->input->post("pais_region_empresa") &&
//            $this->input->post("estado_region_empresa") &&
//            $this->input->post("codigo_postal_empresa") &&
//            $this->input->post("telefono_empresa") &&
//            $this->input->post("movil_empresa") ) {
//
//            $result = $this->M_Admin_Empresa->getByID(trim($this->input->post("id_empresa", TRUE)));
//
//            if (count($result) > 0) {
//
//                $result = $this->M_Admin_Empresa->update(
//                    trim($this->input->post("id_tipo_empresa", TRUE)),
//                    trim($this->input->post("id_usuario", TRUE)),
//                    trim($this->input->post("id_pay_account", TRUE)),
//                    trim($this->input->post("id_archivo_logo", TRUE)),
//                    trim($this->input->post("nombre_empresa", TRUE)),
//                    trim($this->input->post("descripcion_empresa", TRUE)),
//                    trim($this->input->post("direccion_empresa", TRUE)),
//                    trim($this->input->post("pais_region_empresa", TRUE)),
//                    trim($this->input->post("estado_region_empresa", TRUE)),
//                    trim($this->input->post("codigo_postal_empresa", TRUE)),
//                    trim($this->input->post("telefono_empresa", TRUE)),
//                    trim($this->input->post("movil_empresa", TRUE))
//                );
//
//                if ($result) {
//                    $json->message = "La Empresa se actualizo correctamente.";
//                    array_push($json->data, array("id_empresa" => $result));
//                    $json->status 	= TRUE;
//                } else {
//                    $json->message = "Ocurrio un error al actualizar la Empresa, intente de nuevo.";
//                }
//
//            } else {
//                $json->message = "Lo sentimos la Empresa que desea editar no existe.";
//            }
//
//        } else {
//            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
//        }
//
//        echo json_encode($json);
//    }
//
//    public function ajaxGeneratePassword() {
//        $this->load->library("utils/Password");
//
//        $json 				= new stdClass();
//        $json->type 		= "Generate Password";
//        $json->presentation = "data";
//        $json->action 		= "";
//        $json->data 		= array("password" => $this->password->generate());
//        $json->message 		= "Contraseña generada correctamente.";
//        $json->status 		= TRUE;
//
//        echo json_encode($json);
//    }

}