<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin_Paquetes_TMO extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-admin");
        $this->load->model('M_Usuario');
        $this->load->model('admin/M_Admin_Paquetes_TMO');
    }

    public function index()	{
        $this->load->library('pagination');
        $modulo = new stdClass();

        $usuario = $this->M_Usuario->getByID($this->session->id_usuario);

        $modulo->datos_usuario = $usuario[0];

        /* Datos de la cabecera del panel de administrador*/
        $modulo->titulo_pagina = "TMO | Panel Principal - Paquetes TMO";
        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario = $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $usuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = "Take My Order";
        $modulo->nombre_empresa_corto = "TMO";
        $modulo->url_signout = base_url()."admin/signOut";
        $modulo->url_main_panel = base_url()."admin";

        $modulo->nombre 					= "Paquetes TMO";
        $modulo->titulo 					= "Paquetes TMO";
        $modulo->titulo_registro 			= "Registro de Paquetes TMO";
        $modulo->cabecera_registro 			= array("Nombre Paquete", "Descripción", "Total Store", "Total Products", "Total Users", "Total Categorias", "Tiempo Suscripción", "Precio");
        $modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-paquetes-tmo";
        $modulo->base_url 					= "admin/paquetes-tmo/";
        $modulo->api_rest_params 			= array("delete" => "id_paquete_tmo");
        $modulo->menu 						= array("menu" => 3, "submenu" => 0);
        $modulo->navegacion 				= array(
            array("nombre" => "Paquetes TMO",
                "url" => "",
                "activo" => TRUE)
        );

        $config 							= array();
        $config["base_url"] 				= base_url() . "admin/paquetes-tmo/page";
        $total_row 							= $this->M_Admin_Paquetes_TMO->getTotalPaquetesTMO();
        $config["total_rows"] 				= $total_row;
        $config["per_page"] 				= 15;
        $config['use_page_numbers'] 		= TRUE;
        $config['cur_tag_open'] 			= '&nbsp;<a class="current">';
        $config['cur_tag_close'] 			= '</a>';
        $config['next_link'] 				= 'Siguiente';
        $config['prev_link'] 				= 'Anterior';
        $config['first_link'] 				= 'Primero';
        $config['last_link'] 				= 'Ultimo';
        $config["uri_segment"] 				= 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $modulo->registros = $this->M_Admin_Paquetes_TMO->fetchPaquetesTMO($config["per_page"], ($page - 1) * 15);
        $str_links = $this->pagination->create_links();
        $modulo->links = explode('&nbsp;',$str_links );

        $data["modulo"] = $modulo;
        $this->load->view('admin/module/paquetes-tmo/v-admin-paquetes-tmo', $data);
    }

    public function agregar() {
        $modulo = new stdClass();

        $usuario = $this->M_Usuario->getByID($this->session->id_usuario);
        $modulo->datos_usuario = $usuario[0];

        $modulo->titulo 				= "Paquetes TMO";
        $modulo->titulo_pagina			= "TMO | Panel Principal - Paquetes TMO";
        $modulo->icono_empresa 			= PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario 		= $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
        $modulo->tipo_usuario 			= $usuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo 	= "Take My Order";
        $modulo->nombre_empresa_corto 	= "TMO";
        $modulo->url_signout 			= base_url()."admin/signOut";
        $modulo->nombreSeccion 			= "Agregar";
        $modulo->base_url 				= "admin/paquetes-tmo/";
        $modulo->url_signout 			= base_url()."admin/signOut";
        $modulo->url_main_panel 		= base_url()."admin";
        $modulo->menu 					= array("menu" => 3, "submenu" => 0);

        $data["modulo"] 		= $modulo;

        $this->load->view('admin/module/paquetes-tmo/v-admin-paquetes-tmo-agregar', $data);
    }

    public function insert() {
        $json 				= new stdClass();
        $json->type 		= "Paquete TMO";
        $json->presentation = "";
        $json->action 		= "insert";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("txtNombre") &&
            $this->input->post("txtTotalTiendas") &&
            $this->input->post("txtTotalProductos") &&
            $this->input->post("txtTotalUsuarios") &&
            $this->input->post("txtTotalCategorias") &&
            $this->input->post("txtTiempoSuscripcion") &&
            $this->input->post("txtPrecio") ) {

                $existRow = $this->M_Admin_Paquetes_TMO->getPaqueteTMOByName(trim($this->input->post("txtNombre", TRUE)));

                if (count($existRow) <= 0) {

                    $result = $this->M_Admin_Paquetes_TMO->insert(
                        array(
                            'nombre_paquete'        => trim($this->input->post("txtNombre", TRUE)),
                            'descripcion_paquete'   => trim($this->input->post("txtDescripcion", TRUE)),
                            'total_store'           => trim($this->input->post("txtTotalTiendas", TRUE)),
                            'total_products'        => trim($this->input->post("txtTotalProductos", TRUE)),
                            'total_users'           => trim($this->input->post("txtTotalUsuarios", TRUE)),
                            'total_categorias'      => trim($this->input->post("txtTotalCategorias", TRUE)),
                            'tiempo_meses_paquete'  => trim($this->input->post("txtTiempoSuscripcion", TRUE)),
                            'precio_paquete'        => trim($this->input->post("txtPrecio", TRUE))
                        )

                    );

                    if (is_int($result)) {
                        $json->message = "El Paquete TMO se agrego correctamente.";
                        array_push($json->data, array("id" => $result));
                        $json->status 	= TRUE;
                    } else {
                        $json->message = "Ocurrio un error al agregar el Paquete TMO, intente de nuevo.";
                    }

                } else {
                    $json->message = "Lo sentimos el paquete que desea agregar ya existe.";
                }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);

    }

    public function edit($idTipoEmpresa) {

        if (isset($idTipoEmpresa)) {

            $modulo = new stdClass();

            $usuario = $this->M_Usuario->getByID($this->session->id_usuario);
            $modulo->datos_usuario = $usuario[0];

            $modulo->titulo 				= "Empresa";
            $modulo->titulo_pagina 			= "TMO | Panel Principal";
            $modulo->icono_empresa 			= PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
            $modulo->nombres_usuario 		= $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
            $modulo->tipo_usuario 			= $usuario[0]->nombre_tipo_usuario;
            $modulo->nombre_empresa_largo 	= "Take My Order";
            $modulo->nombre_empresa_corto 	= "TMO";
            $modulo->url_signout 			= base_url()."admin/signOut";
            $modulo->nombreSeccion 			= "Editar";
            $modulo->base_url 				= "admin/tipoempresa/";
            $modulo->url_signout 			= base_url()."admin/signOut";
            $modulo->url_main_panel 		= base_url()."admin";
            $modulo->menu 					= array("menu" => 2, "submenu" => 0);

            $result = $this->M_Admin_Paquetes_TMO->getTipoEmpresaByID($idTipoEmpresa);
            if (count($result) > 0) {
                $data["dataTipo"] 	= $result[0];

                $data["existeTipo"]	= TRUE;
            } else {
                $data["dataTipo"]  	= NULL;
                $data["existeTipo"]	= FALSE;
            }

            $data["idTipo"] 		= $idTipoEmpresa;
            $data["modulo"] 		=	$modulo;

            $this->load->view('admin/module/tipoempresa/v-admin-tipoempresa-agregar', $data);
        } else {
            redirect('/');
        }

    }

    public function update() {

        $json 				= new stdClass();
        $json->type 		= "Tipo Empresa";
        $json->presentation = "";
        $json->action 		= "update";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( 	$this->input->post("id_tipo") &&
            $this->input->post("nombre_tipo_empresa")

        ) {

            $result = $this->M_Admin_Paquetes_TMO->getTipoEmpresaByID(trim($this->input->post("id_tipo", TRUE)));

            if (count($result) > 0) {

                $result = $this->M_Admin_Paquetes_TMO->update(
                    trim($this->input->post("id_tipo", TRUE)),
                    trim($this->input->post("nombre_tipo_empresa", TRUE))

                );

                if ($result) {
                    $json->message = "El Tipo de Empresa se actualizo correctamente.";
                    array_push($json->data, array("id_tipo" => $result));
                    $json->status 	= TRUE;
                } else {
                    $json->message = "Ocurrio un error al actualizar el Tipo de Empresa, intente de nuevo.";
                }

            } else {
                $json->message = "Lo sentimos el Tipo de Empresa que desea editar no existe.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);

    }

    public function delete() {
        $json 				= new stdClass();
        $json->type 		= "Tipo Empresa";
        $json->presentation = "";
        $json->action 		= "delete";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("id_tipo_empresa") ) {
            $result = $this->M_Admin_Paquetes_TMO->delete(trim($this->input->post("id_tipo_empresa", TRUE)));

            if ($result) {
                $json->message = "Tipo de Empresa eliminado correctamente.";
                $json->status 	= TRUE;
            } else {
                $json->message = "Ocurrio un error al eliminar el Tipo de Empresa, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }


}