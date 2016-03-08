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

        foreach( $modulo->registros as $producto ) {
            $galeriaProducto = $this->M_CompanyAdmin_Product->getGalleryByProduct(
                array(
                    "id_producto" => $producto->id_producto
                ));
            $producto->galeria_producto = $galeriaProducto;
        }

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

    public function editProduct($id_producto) {
        $this->load->model('company-admin/M_CompanyAdmin_Categorias');

        $modulo                     = $this->paneladmin->loadPanelCompany();
        $modulo->titulo_pagina      = $modulo->datos_empresa->organization." | Panel Administrativo - Editar Producto";
        $modulo->url_module_panel   = $modulo->url_main_panel."/product";
        $modulo->menu               = array("menu" => 3, "submenu" => 0);

        $datosProducto = $this->M_CompanyAdmin_Product->getProductByID(
            array(
                "id_empresa"  => $this->session->id_empresa,
                "id_producto" => $id_producto
            ));

        $datosCategorias            = $this->M_CompanyAdmin_Categorias->getAllCategorys(array( "id_empresa" => $this->session->id_empresa ));
        $modulo->data_categorias    = $datosCategorias;
        $modulo->data_tiendas       = $this->M_CompanyAdmin_Product->getAllStore($this->session->id_empresa);

        if (sizeof($datosProducto) > 0) {
            $modulo->existe_producto = TRUE;

            $modulo->data_producto = $datosProducto[0];

            $datosGaleria = $this->M_CompanyAdmin_Product->getGalleryByProduct(
                array(
                    "id_producto" => $datosProducto[0]->id_producto
                ));
            $modulo->data_galeria_producto = $datosGaleria;

            $datosTiendas = $this->M_CompanyAdmin_Product->getStoreByProduct(
                array(
                    "id_producto" => $datosProducto[0]->id_producto
                ));
            $modulo->data_tiendas_producto = $datosTiendas;

            $datosModifiers = $this->M_CompanyAdmin_Product->getModifiersByProduct(
                array(
                    "id_producto" => $datosProducto[0]->id_producto
                ));
            $modulo->data_modifiers_producto = $datosModifiers;

            $subCategoria = $this->M_CompanyAdmin_Categorias->getCategoryByID(
                array(
                    'id_empresa'        => $this->session->id_empresa,
                    'id_categoria'      => $datosProducto[0]->id_categoria
                )
            );
            $modulo->data_subcategoria_producto = $subCategoria;

            if (sizeof($subCategoria) > 0) {
                $categoria = $this->M_CompanyAdmin_Categorias->getCategoryByID(
                    array(
                        'id_empresa'        => $this->session->id_empresa,
                        'id_categoria'      => $subCategoria[0]->id_categoria_superior
                    )
                );

                $modulo->data_categoria_producto = $categoria;
            }
        } else {
            $modulo->existe_producto = FALSE;
        }

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/product/v-company-admin-product-editar', $data);
    }

    /* <---------------- AJAX ----------------> */

    public function ajaxAddProduct() {
        $json 				= new stdClass();
        $json->type 		= "Producto";
        $json->presentation = "";
        $json->action 		= "insert";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("txtNombreProducto") &&
            $this->input->post("txtDescripcionProducto") &&
            $this->input->post("txtStockProducto") &&
            $this->input->post("txtPrecioProducto") &&
            $this->input->post("cboCategoria") &&
            $this->input->post("cboTienda") ) {

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

                if ($this->input->post("totalModifiers")) {
                    for ($c = 1; $c <= trim($this->input->post("totalModifiers", TRUE)); $c++) {
                        $result = $this->M_CompanyAdmin_Product->insertModificadorProductos(
                            array(
                                'tipo_modificador' => trim($this->input->post("modifier_".$c."_type", TRUE))
                            )
                        );

                        $result = $this->M_CompanyAdmin_Product->insertDetalleModificadorProductos(
                            array(
                                'id_modificador_productos'  => $result,
                                'id_producto'               => $resultIDProducto,
                                'descripcion_modificador'   => trim($this->input->post("modifier_".$c."_name", TRUE)),
                                'costo_modificador'         => trim($this->input->post("modifier_".$c."_cost", TRUE)),
                                'stock'                     => 0
                            )
                        );
                    }
                }

                if ($this->input->post("totalImages")) {
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
                }

                $json->message = "El producto se agrego correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "Ocurrio un error al agregar el producto, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

    public function ajaxEditProduct() {
        $json 				= new stdClass();
        $json->type 		= "Producto";
        $json->presentation = "";
        $json->action 		= "update";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("id_producto") &&
            $this->input->post("txtNombreProducto") &&
            $this->input->post("txtDescripcionProducto") &&
            $this->input->post("txtStockProducto") &&
            $this->input->post("txtPrecioProducto") &&
            $this->input->post("cboCategoria") &&
            $this->input->post("cboTienda") ) {

            $resultIDProducto = $this->M_CompanyAdmin_Product->updateDatosProducto(
                array(
                    'id_producto'           => trim($this->input->post("id_producto", TRUE)),
                    'id_categoria'          => trim($this->input->post("cboCategoria", TRUE)),
                    'nombre_producto'       => trim($this->input->post("txtNombreProducto", TRUE)),
                    'descripcion_producto'  => trim($this->input->post("txtDescripcionProducto", TRUE)),
                    'stock'                 => trim($this->input->post("txtStockProducto", TRUE)),
                    'precio_producto'       => trim($this->input->post("txtPrecioProducto", TRUE))
                )
            );

            if ($resultIDProducto) {

                $datosTiendas = $this->M_CompanyAdmin_Product->getStoreByProduct(
                    array(
                        "id_producto" => trim($this->input->post("id_producto", TRUE))
                    ));

                foreach ($datosTiendas as $tienda) {
                    $result = $this->M_CompanyAdmin_Product->deleteDatosCatalogoProductos(
                        array(
                            'id_tienda'   => $tienda->id_tienda,
                            'id_producto' => trim($this->input->post("id_producto", TRUE))
                        )
                    );
                }

                $listaTiendas = explode(",", trim($this->input->post("cboTienda", TRUE)));

                foreach ($listaTiendas as $tienda) {
                    $result = $this->M_CompanyAdmin_Product->insertDatosCatalogoProductos(
                        array(
                            'id_tienda'   => $tienda,
                            'id_producto' => $resultIDProducto
                        )
                    );
                }

                if ($this->input->post("totalModifiers")) {
                    for ($c = 1; $c <= trim($this->input->post("totalModifiers", TRUE)); $c++) {
                        $result = $this->M_CompanyAdmin_Product->insertModificadorProductos(
                            array(
                                'tipo_modificador' => trim($this->input->post("modifier_".$c."_type", TRUE))
                            )
                        );

                        $result = $this->M_CompanyAdmin_Product->insertDetalleModificadorProductos(
                            array(
                                'id_modificador_productos'  => $result,
                                'id_producto'               => trim($this->input->post("id_producto", TRUE)),
                                'descripcion_modificador'   => trim($this->input->post("modifier_".$c."_name", TRUE)),
                                'costo_modificador'         => trim($this->input->post("modifier_".$c."_cost", TRUE)),
                                'stock'                     => 0
                            )
                        );
                    }
                }

                if ($this->input->post("totalImages")) {
                    $totalImages = intval(trim($this->input->post("totalImages", TRUE)));
                    if ( $totalImages > 0) {
                        $this->load->library('utils/UploadFile');

                        for ($i=0; $i <= $totalImages; $i++) {
                            if ( $this->uploadfile->validateFile("file_$i") ) {
                                $dataEmpresa = $this->M_Empresa->getByID($this->session->id_empresa);

                                $path = "uploads/company/".$this->session->id_empresa."/products/".intval(trim($this->input->post("id_producto", TRUE)))."/gallery/";

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
                }

                $json->message = "El producto se guardo correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "Ocurrio un error al guardar el producto, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

    public function ajaxDeleteImageProduct() {
        $json 				= new stdClass();
        $json->type 		= "Image Producto";
        $json->presentation = "";
        $json->action 		= "delete";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("id_image_product") &&
            $this->input->post("id_product") ) {

            $resultImageProduct = $this->M_CompanyAdmin_Product->getImageproductByID(
                array(
                    'id_producto' => trim($this->input->post("id_product", TRUE)),
                    'id_archivo'  => trim($this->input->post("id_image_product", TRUE))
                )
            );

            if (sizeof($resultImageProduct) > 0) {
                $result = $this->M_CompanyAdmin_Product->deleteImagenProducto(
                    array(
                        'id_archivo'  => trim($this->input->post("id_image_product", TRUE))
                    )
                );

                $json->message = "La imagen del producto se elimino correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "La imagen del producto que quiere eliminar no existe.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

    public function ajaxDeleteModifierProduct() {
        $json 				= new stdClass();
        $json->type 		= "Modifier Producto";
        $json->presentation = "";
        $json->action 		= "delete";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("id_modifier") &&
            $this->input->post("id_product") ) {

            $resultImageProduct = $this->M_CompanyAdmin_Product->getModifierByProduct(
                array(
                    'id_producto'               => trim($this->input->post("id_product", TRUE)),
                    'id_modifier'  => trim($this->input->post("id_modifier", TRUE))
                )
            );

            if (sizeof($resultImageProduct) > 0) {

                $result = $this->M_CompanyAdmin_Product->deleteDetalleModificadorProductos(
                    array(
                        'id_producto' => trim($this->input->post("id_product", TRUE)),
                        'id_modifier' => trim($this->input->post("id_modifier", TRUE))
                    )
                );

                $result = $this->M_CompanyAdmin_Product->deleteModificadorProductos(
                    array(
                        'id_modifier' => trim($this->input->post("id_modifier", TRUE))
                    )
                );

                $json->message = "El modificador del producto se elimino correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "El modificador del producto que quiere eliminar no existe.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

}