<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_StoreAdmin_Productos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-store-admin");
        $this->load->model("store-admin/M_StoreAdmin_Productos");
        $this->load->model("store-admin/M_StoreAdmin_Categorias");
        $this->load->model('M_Archivo');
        $this->load->model('M_Empresa');
        $this->load->model('M_Usuario');
        $this->load->model('M_Tipo_Empresa');
	}
    
    public function index() {
		$this->load->library('pagination');
		$modulo = $this->loadDataPanel();
        
        $modulo->titulo_pagina              = $modulo->datos_empresa->nombre_empresa." | Panel Administrativo - Productos";
		$modulo->nombre 					= "Productos";
		$modulo->titulo 					= "Productos";
		$modulo->titulo_registro 			= "Registro de Productos";
		// $modulo->cabecera_registro 			= array("Nombre", "Descripcion", "Stock", "Precio", "Categoria");
		$modulo->cabecera_registro 			= array("Nombre", "Descripcion", "Stock", "Precio");
		$modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-products";
		$modulo->base_url 					= $modulo->url_main_panel."/products";
		$modulo->api_rest_params 			= array("delete" => "id_producto");
		$modulo->menu 						= array("menu" => 2, "submenu" => 0);
		$modulo->navegacion 				= array(
												array("nombre" => "Productos",
													"url" => "",
													"activo" => TRUE)
											);
                                            
		$config 							= array();
		$config["base_url"] 				= $modulo->url_main_panel."/page";
		$total_row 							= $this->M_StoreAdmin_Productos->getTotalProductos($this->session->id_empresa);
		$config["total_rows"] 				= $total_row;
		$config["per_page"] 				= 15;
		$config['use_page_numbers'] 		= TRUE;
		$config['cur_tag_open'] 			= '&nbsp;<a class="current">';
		$config['cur_tag_close'] 			= '</a>';
		$config['next_link'] 				= 'Siguiente';
		$config['prev_link'] 				= 'Anterior';
		$config['first_link'] 				= 'Primero';
		$config['last_link'] 				= 'Ultimo';
		$config["uri_segment"] 				= 5;
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
		
        $productos = $this->M_StoreAdmin_Productos->fetchProductos($config["per_page"], ($page - 1) * 15, $this->session->id_empresa);
        
        for ($i=0; $i < sizeof($productos); $i++) { 
            
            $subCategoria = $this->M_StoreAdmin_Categorias->getCategoryByID(
                            array(
                                'id_empresa'        => $this->session->id_empresa,
                                'id_categoria'      => $productos[$i]->id_categoria
                            )
                        );
                        
            
            if (sizeof($subCategoria) > 0) {
                $productos[$i]->nombre_sub_categoria = $subCategoria[0]->nombre_categoria;
                
                $categoria = $this->M_StoreAdmin_Categorias->getCategoryByID(
                        array(
                            'id_empresa'        => $this->session->id_empresa,
                            'id_categoria'      => $subCategoria[0]->id_categoria_superior
                        )
                    );
                    
                if (sizeof($categoria) > 0) {
                    $productos[$i]->nombre_categoria = $categoria[0]->nombre_categoria;
                } else {
                    $productos[$i]->nombre_categoria = "";
                }
                
            } else {
                $productos[$i]->nombre_categoria = "";
                $productos[$i]->nombre_sub_categoria = "";
            }
            
        }
        
		$modulo->registros = $productos;
		$str_links = $this->pagination->create_links();
		$modulo->links = explode('&nbsp;',$str_links );
		
		$data["modulo"] = $modulo;
		$this->load->view('store-admin/module/productos/v-store-admin-productos', $data);
    }
    
    public function addProduct() {
        $modulo = $this->loadDataPanel();
        $modulo->menu = array("menu" => 2, "submenu" => 0);
        $modulo->titulo_pagina = $modulo->datos_empresa->nombre_empresa." | Panel Administrativo - Agregar Producto";
        
        $datosCategorias = $this->M_StoreAdmin_Categorias->getAllCategorys(array( "id_empresa" => $this->session->id_empresa ));
        $modulo->data_categorias = $datosCategorias;
        
        $data["modulo"] = $modulo;
        $this->load->view('store-admin/module/productos/v-store-admin-productos-add', $data);
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
                $this->input->post("cboSubCategorias") ) {
                    
                $resultProducto = $this->M_StoreAdmin_Productos->insertDatosProducto(
                            array(
                                'id_categoria'        => trim($this->input->post("cboSubCategorias", TRUE)),
                                'nombre_producto'     => trim($this->input->post("txtNombreProducto", TRUE)),
                                'descripcion_producto' => trim($this->input->post("txtDescripcionProducto", TRUE)),
                                'stock'               => trim($this->input->post("txtStockProducto", TRUE)),
                                'precio_producto'     => trim($this->input->post("txtPrecioProducto", TRUE))
                            )
                        );
                        
                 if (is_int($resultProducto)) {
                    $result = $this->M_StoreAdmin_Productos->insertDatosCatalogoProductos(
                        array(
                            'id_empresa'  => $this->session->id_empresa,
                            'id_producto' => $resultProducto
                        )
                    );
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
    
    public function ajaxGetSubCategorysByIDCategory() {
        $json 				= new stdClass();
		$json->type 		= "Categorias";
		$json->presentation = "";
		$json->action 		= "list";
		$json->data 		= array();
		$json->status 		= FALSE;
            
        if ( $this->input->post("id_categoria") ) {
            
            $result = $this->M_StoreAdmin_Categorias->getCategoryByID(
                        array(
                            'id_empresa'        => $this->session->id_empresa,
                            'id_categoria'      => trim($this->input->post("id_categoria", TRUE))
                        )
                    );
            
            if (sizeof($result) > 0) {
                
                $subCategorias = $this->M_StoreAdmin_Categorias->getSubCategoryByIDCategory(
                    array( 
                        "id_empresa"            => $this->session->id_empresa,
                        "id_categoria_superior" => trim($this->input->post("id_categoria", TRUE))
                    )
                );
                
                if (sizeof($subCategorias) > 0) {
                    $json->message  = "Lista de Sub Categorias.";
                    $json->data     = $subCategorias;
                    $json->status   = TRUE;
                } else {
                    $json->message = "No hay Sub Categorias.";
                }
               
            } else {
                $json->message = "La categoria con lo que esta buscando no existe, intente de nuevo.";
            }
            
        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }
		
		echo json_encode($json);
    }
    
    /* <----------------- * -----------------> */
    
    public function loadDataPanel() {
        $modulo = new stdClass();
        
        $dataEmpresa        = $this->M_Empresa->getByID($this->session->id_empresa);
        $dataUsuario        = $this->M_Usuario->getByID($this->session->id_usuario);
        $dataLogoEmpresa    = $this->M_Archivo->getByID($dataEmpresa[0]->id_archivo_logo);
        
        if (sizeof($dataLogoEmpresa) > 0) {
            $modulo->icono_empresa = $dataLogoEmpresa[0]->url_archivo;
        } else {
            $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/image_not_found.png"; // Colocar logo de store por defecto
        }
        
        $modulo->datos_usuario = $dataUsuario[0];
        $modulo->datos_empresa = $dataEmpresa[0];
                
        /* Datos de la cabecera del panel de administrador */
        $modulo->nombres_usuario = $dataUsuario[0]->nombres_persona." ".$dataUsuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $dataUsuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = $dataEmpresa[0]->nombre_empresa;
        $modulo->nombre_empresa_corto = $dataEmpresa[0]->nombre_empresa;
        /* --------------------*-------------------- */
        
        $modulo->url_signout = base_url()."admin/signOut";
        $modulo->url_main_panel = base_url()."store/".$this->session->id_empresa."/admin";
        
        return $modulo;
    }

}