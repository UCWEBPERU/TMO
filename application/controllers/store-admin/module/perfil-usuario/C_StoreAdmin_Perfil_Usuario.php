<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_StoreAdmin_Perfil_Usuario extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-store-admin");
        $this->load->helper('security');
        $this->load->model("store-admin/M_StoreAdmin_Perfil_Usuario");
        $this->load->model('M_Archivo');
        $this->load->model('M_Empresa');
        $this->load->model('M_Usuario');
        $this->load->model('M_Tipo_Empresa');
	}

	public function index()	{
        $modulo = $this->loadDataPanel();
        $modulo->menu = array("menu" => 4, "submenu" => 0);
        $modulo->titulo_pagina = $modulo->datos_empresa->nombre_empresa." | Panel Administrativo - Perfil de Usuario";
        
        $datosUsuario = $this->M_StoreAdmin_Perfil_Usuario->getByID($this->session->id_usuario);
        $modulo->data_usuario = $datosUsuario[0];
        
        $data["modulo"] = $modulo;
        $this->load->view('store-admin/module/perfil-usuario/v-store-admin-perfil-usuario', $data);
    }
    
    public function addCategory() {
        $modulo = $this->loadDataPanel();
        $modulo->menu = array("menu" => 3, "submenu" => 0);
        $modulo->titulo_pagina = $modulo->datos_empresa->nombre_empresa." | Panel Administrativo - Agregar Categoria";
        
        $datosCategorias = $this->M_StoreAdmin_Categorias->getAllCategorys(array( "id_empresa" => $this->session->id_empresa ));
        $modulo->data_categorias = $datosCategorias;
        
        $data["modulo"] = $modulo;
        $this->load->view('store-admin/module/categorias/v-store-admin-categorias-add', $data);
    }
    
    public function editCategory($id_category) {
        $modulo = $this->loadDataPanel();
        $modulo->menu = array("menu" => 3, "submenu" => 0);
        $modulo->titulo_pagina = $modulo->datos_empresa->nombre_empresa." | Panel Administrativo - Editar Categoria";
        
        $datosCategoria = $this->M_StoreAdmin_Categorias->getCategoryByID(
                array(
                    'id_empresa'        => $this->session->id_empresa,
                    'id_categoria'      => $id_category
                )
            );
        $modulo->data_categoria = $datosCategoria;
        
        $data["modulo"] = $modulo;
        $this->load->view('store-admin/module/categorias/v-store-admin-categorias-edit', $data);
    }
    
    public function listSubCategoriesByCategory($id_category) {
        $modulo = $this->loadDataPanel();
        $modulo->menu = array("menu" => 3, "submenu" => 0);
        
        $datosCategoria = $this->M_StoreAdmin_Categorias->getCategoryByIDAndNivel(
                        array(
                            'id_empresa'        => $this->session->id_empresa,
                            'nivel_categoria'   => "categoria",
                            'id_categoria'      => $id_category
                        )
                    );
        
        $modulo->titulo_pagina = $modulo->datos_empresa->nombre_empresa." | Panel Administrativo - Categoria: ".$datosCategoria[0]->nombre_categoria;          
        
        $datosSubCategoria = $this->M_StoreAdmin_Categorias->getSubCategoryByIDCategory(
                    array( 
                        "id_empresa"            => $this->session->id_empresa,
                        "id_categoria_superior" => $id_category
                    )
                );
        $modulo->data_categoria = $datosCategoria[0];
        $modulo->data_sub_categorias = $datosSubCategoria;
        
        $data["modulo"] = $modulo;
        $this->load->view('store-admin/module/categorias/v-store-admin-sub-categorias', $data);
    }
    
    /* <--------------- AJAX ---------------> */
    
    public function ajaxUpdateUserProfile() {
		$json 				= new stdClass();
		$json->type 		= "Actualizar Perfil de Usuario";
		$json->presentation = "";
		$json->data 		= array();
		$json->status 		= FALSE;
        
        if ($this->input->post("txtNombres") &&
            $this->input->post("txtApellidos") &&
            $this->input->post("txtPais") &&
            $this->input->post("txtEstado") &&
            $this->input->post("txtDireccion") &&
            $this->input->post("txtNumeroCelular") &&
            $this->input->post("txtNumeroTelefono") ) {

            $result = $this->M_StoreAdmin_Perfil_Usuario->updatePerfilUsuario(array(
                            "id"            => $this->session->id_usuario,
                            "nombres"       => trim($this->input->post("txtNombres", TRUE)),
                            "apellidos"     => trim($this->input->post("txtApellidos", TRUE)),
                            "pais_region"   => trim($this->input->post("txtPais", TRUE)),
                            "estado_Region" => trim($this->input->post("txtEstado", TRUE)),
                            "direccion"     => trim($this->input->post("txtDireccion", TRUE)),
                            "movil"         => trim($this->input->post("txtNumeroCelular", TRUE)),
                            "telefono"      => trim($this->input->post("txtNumeroTelefono", TRUE)))
                        );
                        
			if ($result) {
                $json->message = "Sus datos personales se han actualizado correctamente.";
                $json->status 	= TRUE;
			} else {
				$json->message = "Ocurrio un error al intentar actualizar sus datos personales. Intentelo de nuevo o mas tarde.";
			}

		} else {
			$json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
		}

		echo json_encode($json);
    }
    
    public function ajaxUpdateUserAccount() {
		$this->load->library('security/Cryptography');
		
		$json 				= new stdClass();
		$json->type 		= "Actualizar Datos de Usuario";
		$json->presentation = "";
		$json->data 		= array();
		$json->status 		= FALSE;
        
		if ($this->input->post("passwordUsuario") && $this->input->post("repeatPasswordUsuario") ) {

            $result = $this->M_StoreAdmin_Perfil_Usuario->updatePassWordUsuario($this->session->id_usuario, $this->cryptography->Encrypt(trim($this->input->post("passwordUsuario", TRUE))));
            
			if ($result) {
                $json->message = "Los datos de su cuenta de usuario se actualizo correctamente.";
                $json->status 	= TRUE;
			} else {
				$json->message = "Ocurrio un error al intentar actualizar los datos de su cuenta de usuario. Intentelo de nuevo o mas tarde.";
			}

		} else {
			$json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
		}

		echo json_encode($json);
    }
    
    public function ajaxDeleteCategory() {
        $json 				= new stdClass();
		$json->type 		= "Categoria";
		$json->presentation = "";
		$json->action 		= "delete";
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
                
                if (sizeof($subCategorias) == 0) {
                    unset($result);
                    $result = $this->M_StoreAdmin_Categorias->deleteCategoryByID(
                            array(
                                'id_empresa'    => $this->session->id_empresa,
                                'id_categoria'  => trim($this->input->post("id_categoria", TRUE))
                            )
                        );
                    
                    if ($result) {
                        $json->message = "La categoria se elimino correctamente.";
                        $json->status = TRUE;
                    } else {
                        $json->message = "Ocurrio un error al eliminar la categoria, intente de nuevo.";
                    }
                    
                } else {
                    $json->message = "La categoria que quiere eliminar esta siendo utilizado como categoria superior, para eliminar no debe tener asignado sub categorias.";
                }
               
            } else {
                $json->message = "La categoria que quiere eliminar no existe, intente de nuevo.";
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