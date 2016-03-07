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

    /* <---------------- AJAX ----------------> */

    public function ajaxAddProduct() {
        $json 				= new stdClass();
        $json->type 		= "Producto";
        $json->presentation = "";
        $json->action 		= "add";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("txtNombreProducto") &&
            $this->input->post("txtDescripcionProducto") &&
            $this->input->post("txtStockProducto") &&
            $this->input->post("txtPrecioProducto") &&
            $this->input->post("cboCategoria") &&
            $this->input->post("cboTienda") &&
            $this->input->post("totalImages") &&
            $this->input->post("totalModifiers") ) {

            $resultIDProducto = $this->M_CompanyAdmin_Product->insertDatosProducto(
                array(
                    'id_categoria'          => trim($this->input->post("cboCategoria", TRUE)),
                    'nombre_producto'       => trim($this->input->post("txtNombreProducto", TRUE)),
                    'descripcion_producto'  => trim($this->input->post("txtDescripcionProducto", TRUE)),
                    'stock'                 => trim($this->input->post("txtStockProducto", TRUE)),
                    'precio_producto'       => trim($this->input->post("txtPrecioProducto", TRUE))
                )
            );

            if (is_int($resultIDProducto)) {

                $listaTiendas = explode(",", trim($this->input->post("cboTienda", TRUE)));

                foreach ($listaTiendas as $tienda) {
                    $result = $this->M_CompanyAdmin_Product->insertDatosCatalogoProductos(
                        array(
                            'id_tienda'   => $tienda,
                            'id_producto' => $resultIDProducto
                        )
                    );
                }

                for ($c = 1; $c <= trim($this->input->post("totalModifiers", TRUE)); $c++) {
                    $typeModifier = "modifier_".$c."_type";
                    $nameModifier = "modifier_".$c."_name";
                    $costModifier = "modifier_".$c."_cost";
                    $result = $this->M_CompanyAdmin_Product->insertModificadorProductos(
                        array(
                            'tipo_modificador' => trim($this->input->post($typeModifier, TRUE))
                        )
                    );

                    $result = $this->M_CompanyAdmin_Product->insertDetalleModificadorProductos(
                        array(
                            'id_modificador_productos'  => $result,
                            'id_producto'               => $resultIDProducto,
                            'descripcion_modificador'   => trim($this->input->post($nameModifier, TRUE)),
                            'costo_modificador'         => trim($this->input->post($costModifier, TRUE)),
                            'stock'                     => 0
                        )
                    );
                }

                $totalImages = intval(trim($this->input->post("totalImages", TRUE)));
                if ( $totalImages > 0) {
                    $this->load->library('utils/UploadFile');

                    for ($i=0; $i <= $totalImages; $i++) {
                        if ( $this->uploadfile->validateFile("file_$i") ) {
                            $dataEmpresa = $this->M_Empresa->getByID($this->session->id_empresa);

                            $path = "uploads/company/".$this->session->id_empresa."/products/".$resultIDProducto."/gallery/";

                            $path = $this->uploadfile->upload("file_$i", "imagen_$i", $path);

                            $resultIDArchivo = $this->M_CompanyAdmin_Product->insertImagenProducto(
                                array(
                                    'url_archivo'      => $path,
                                    'tipo_archivo'     => "image/png",
                                    'relacion_recurso' => "galeria",
                                    'nombre_archivo'   => "imagen_$i"
                                )
                            );

                            $result = $this->M_CompanyAdmin_Product->insertGaleriaProducto(
                                array(
                                    'id_producto' => $resultIDProducto,
                                    'id_archivo'  => $resultIDArchivo
                                )
                            );
                        }
                    }
                }

                $json->message = "El producto se agrego correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "Ocurrio un error al agregar el producto, intente de nuevo.";
            }

//            var_dump($this->input->post());

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

}