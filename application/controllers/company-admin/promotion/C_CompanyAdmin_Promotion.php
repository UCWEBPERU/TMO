<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_CompanyAdmin_Promotion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-company-admin");
        $this->load->model("M_Usuario");
        $this->load->model('company-admin/M_CompanyAdmin_Promotion');
        $this->load->library('utils/PanelAdmin');
    }

    public function index()	{
        $this->load->library('pagination');

        /* Datos de la cabecera del panel de administrador*/
        $modulo                     = $this->paneladmin->loadPanelCompany();
        $modulo->titulo_pagina      = $modulo->datos_empresa->organization." | Panel Administrativo - Promotions";
        $modulo->url_module_panel   = $modulo->url_main_panel."/promotion";

        $modulo->nombre 					= "Promotions";
        $modulo->titulo 					= "Promotions";
        $modulo->titulo_registro 			= "Registro de promociones de productos";
        $modulo->cabecera_registro 			= array("Nombre", "Descripción", "Stock", "Precio Normal", "Precio Promoción", "Tienda");
        $modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-promotion";
        $modulo->menu 						= array("menu" => 4, "submenu" => 0);
        $modulo->navegacion 				= array(
            array("nombre" => "Promotion",
                "url" => "",
                "activo" => TRUE)
        );

        $config 							= array();
        $config["base_url"] 				= $modulo->url_main_panel."/promotion/page";
        $total_row 							= $this->M_CompanyAdmin_Promotion->getTotalProduct($this->session->id_empresa);
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

        $modulo->registros = $this->M_CompanyAdmin_Promotion->fetchProduct($config["per_page"], ($page - 1) * 15, $this->session->id_empresa);

        if (is_array($modulo->registros)) {
            foreach( $modulo->registros as $producto ) {
                $galeriaProducto = $this->M_CompanyAdmin_Promotion->getGalleryByProduct(
                    array(
                        "id_producto" => $producto->id_producto
                    ));
                $producto->galeria_producto = $galeriaProducto;
            }
        }

        $str_links = $this->pagination->create_links();
        $modulo->links = explode('&nbsp;',$str_links);

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/promotion/v-company-admin-promotion', $data);
    }

    public function addPromotion() {
        /* Datos de la cabecera del panel de administrador*/
        $modulo                     = $this->paneladmin->loadPanelCompany();
        $modulo->titulo 			= "Product";
        $modulo->titulo_pagina      = $modulo->datos_empresa->organization." | Panel Administrativo - Add Promotion";
        $modulo->url_module_panel   = $modulo->url_main_panel."/promotion";
        $modulo->menu               = array("menu" => 4, "submenu" => 0);

        $modulo->data_productos     = $this->M_CompanyAdmin_Promotion->getProducts($this->session->id_empresa);

        $data["modulo"] 		    = $modulo;

        $this->load->view('company-admin/module/promotion/v-company-admin-promotion-agregar', $data);
    }

    public function editPromotion($id_promocion) {
        /* Datos de la cabecera del panel de administrador*/
        $modulo                     = $this->paneladmin->loadPanelCompany();
        $modulo->titulo 			= "Product";
        $modulo->titulo_pagina      = $modulo->datos_empresa->organization." | Panel Administrativo - Add Promotion";
        $modulo->url_module_panel   = $modulo->url_main_panel."/promotion";
        $modulo->menu               = array("menu" => 4, "submenu" => 0);

        $modulo->data_productos     = $this->M_CompanyAdmin_Promotion->getProducts($this->session->id_empresa);
        $dataPromocion              = $this->M_CompanyAdmin_Promotion->getProductByPromotion(
            array(
                "id_empresa"    => $this->session->id_empresa,
                "id_oferta"     => $id_promocion
            )
        );

        if (sizeof($dataPromocion) > 0) {
            $modulo->existe_promocion = TRUE;

            $modulo->data_promocion = $dataPromocion[0];
        }

        $data["modulo"] 		    = $modulo;

        $this->load->view('company-admin/module/promotion/v-company-admin-promotion-editar', $data);
    }

    /* <---------------- AJAX ----------------> */

    public function ajaxAddPromotion() {
        $json 				= new stdClass();
        $json->type 		= "Promotion";
        $json->presentation = "";
        $json->action 		= "insert";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("cboProducto") &&
            $this->input->post("txtPrecioPromocion") &&
            $this->input->post("txtDescripcionPromocion") &&
            $this->input->post("txtFechaInicio") &&
            $this->input->post("txtFechaFin")) {

            $resultIDPromocion = $this->M_CompanyAdmin_Promotion->insertPromotion(
                array(
                    'precio_oferta'         => trim($this->input->post("txtPrecioPromocion", TRUE)),
                    'fecha_inicio'          => trim($this->input->post("txtFechaInicio", TRUE)),
                    'fecha_fin'             => trim($this->input->post("txtFechaFin", TRUE)),
                    'descripcion_oferta'    => trim($this->input->post("txtDescripcionPromocion", TRUE))
                )
            );

            if (is_int($resultIDPromocion)) {

                $result = $this->M_CompanyAdmin_Promotion->updatePromotionOnProduct(
                    array(
                        'id_oferta'     => $resultIDPromocion,
                        'id_producto'   => trim($this->input->post("cboProducto", TRUE))
                    )
                );

                $json->message = "La promocion se agrego correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "Ocurrio un error al agregar la promocion, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

    public function ajaxEditPromotion() {
        $json 				= new stdClass();
        $json->type 		= "Promotion";
        $json->presentation = "";
        $json->action 		= "update";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("id_oferta") &&
            $this->input->post("cboProducto") &&
            $this->input->post("txtPrecioPromocion") &&
            $this->input->post("txtDescripcionPromocion") &&
            $this->input->post("txtFechaInicio") &&
            $this->input->post("txtFechaFin")) {

            $resultIDPromocion = $this->M_CompanyAdmin_Promotion->updatePromotion(
                array(
                    'id_oferta'             => trim($this->input->post("id_oferta", TRUE)),
                    'precio_oferta'         => trim($this->input->post("txtPrecioPromocion", TRUE)),
                    'fecha_inicio'          => trim($this->input->post("txtFechaInicio", TRUE)),
                    'fecha_fin'             => trim($this->input->post("txtFechaFin", TRUE)),
                    'descripcion_oferta'    => trim($this->input->post("txtDescripcionPromocion", TRUE))
                )
            );

            if ($resultIDPromocion) {
                $json->message = "La promocion se guardo correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "Ocurrio un error al guardar la promocion, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

    public function ajaxDeletePromotion() {
        $json 				= new stdClass();
        $json->type 		= "Promotion";
        $json->presentation = "";
        $json->action 		= "delete";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("id_producto") &&
            $this->input->post("id_oferta")) {

            $result = $this->M_CompanyAdmin_Promotion->deletePromotion(
                array(
                    'id_oferta' => trim($this->input->post("id_oferta", TRUE))
                )
            );

            $result = $this->M_CompanyAdmin_Promotion->updatePromotionOnProduct(
                array(
                    'id_oferta'     => NULL,
                    'id_producto'   => trim($this->input->post("id_producto", TRUE))
                )
            );

            if ($result) {
                $json->message = "La promocion se elimino correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "Ocurrio un error al eliminar la promocion, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

}