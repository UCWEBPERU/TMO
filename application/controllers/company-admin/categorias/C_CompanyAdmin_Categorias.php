<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_CompanyAdmin_Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-company-admin");
        $this->load->library('utils/PanelAdmin');
        $this->load->model("company-admin/M_CompanyAdmin_Categorias");
        $this->load->model('M_Archivo');
        $this->load->model('M_Empresa');
        $this->load->model('M_Usuario');
        $this->load->model('M_Tipo_Empresa');
    }

    public function index()	{
        $this->load->model("company-admin/M_CompanyAdmin_Empresa");

        $modulo = new stdClass();

        $dataEmpresa        = $this->M_Empresa->getByID($this->session->id_empresa);
        $dataUsuario        = $this->M_Usuario->getByID($this->session->id_usuario);
        $dataLogoEmpresa    = $this->M_Archivo->getByID($dataEmpresa[0]->id_archivo_logo);
        $dataPayAccount     = $this->M_CompanyAdmin_Empresa->getPayAccountByID($dataEmpresa[0]->id_pay_account);
        $dataTipoEmpresa    = $this->M_Tipo_Empresa->getTipoEmpresa();

        if (sizeof($dataLogoEmpresa) > 0) {
            $modulo->icono_empresa = $dataLogoEmpresa[0]->url_archivo;
        } else {
            $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/image_not_found.png"; // Colocar logo de store por defecto
        }

        $modulo->titulo_pagina = $dataEmpresa[0]->nombre_empresa." | Panel Administrativo - Store";

        $modulo->datos_usuario = $dataUsuario[0];
        $modulo->datos_empresa = $dataEmpresa[0];
        $modulo->datos_tipo_empresa = $dataTipoEmpresa;
        if (sizeof($dataPayAccount) > 0) {
            $modulo->datos_pay_account = $dataPayAccount[0];
        }

        /* Datos de la cabecera del panel de administrador */
        $modulo->nombres_usuario = $dataUsuario[0]->nombres_persona." ".$dataUsuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $dataUsuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = $dataEmpresa[0]->nombre_empresa;
        $modulo->nombre_empresa_corto = $dataEmpresa[0]->nombre_empresa;
        /* --------------------*-------------------- */

        $modulo->url_signout = base_url()."admin/signOut";
        $modulo->url_main_panel = base_url()."store/".$this->session->id_empresa."/admin";
        $modulo->menu = array("menu" => 1, "submenu" => 0);

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/empresa/v-company-admin-empresa', $data);
    }

    public function listAllCategories() {
        $modulo = $this->paneladmin->loadPanelCompany();
        $modulo->menu = array("menu" => 4, "submenu" => 0);
        $modulo->titulo_pagina = $modulo->datos_empresa->organization." | Panel Administrativo - Categorias demo";

        $modulo->url_module_panel = $modulo->url_main_panel."/category";

        $datosCategorias = $this->M_CompanyAdmin_Categorias->getAllPrimaryCategorys(
            array(
                "id_empresa"      => $this->session->id_empresa,
                "nivel_categoria" => 1
            )
        );

        foreach ($datosCategorias as $categoria) {
            $subCategoria = $this->M_CompanyAdmin_Categorias->getCategoryByCategoriaSuperior(
                array(
                    "id_empresa"            => $this->session->id_empresa,
                    "id_categoria_superior" => $categoria->id_categoria
                )
            );
            $categoria->total_subcategorias = count($subCategoria);
        }

        $modulo->data_categorias = $datosCategorias;

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/categorias/v-company-admin-categorias', $data);
    }

    public function addCategory() {
        $modulo = $this->paneladmin->loadPanelCompany();
        $modulo->menu = array("menu" => 4, "submenu" => 0);
        $modulo->titulo_pagina = $modulo->datos_empresa->organization." | Panel Administrativo - Agregar Categoria";
        $modulo->url_module_panel = $modulo->url_main_panel."/category";

        $datosCategorias = $this->M_CompanyAdmin_Categorias->getAllCategorys(array("id_empresa" => $this->session->id_empresa));
        $modulo->data_categorias = $datosCategorias;

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/categorias/v-company-admin-categorias-add', $data);
    }

    public function editCategory($id_category) {
        $modulo = $this->paneladmin->loadPanelCompany();
        $modulo->menu = array("menu" => 4, "submenu" => 0);
        $modulo->titulo_pagina = $modulo->datos_empresa->organization." | Panel Administrativo - Editar Categoria";
        $modulo->url_module_panel = $modulo->url_main_panel."/category";

        $datosCategoria = $this->M_CompanyAdmin_Categorias->getCategoryByID(
            array(
                'id_empresa'        => $this->session->id_empresa,
                'id_categoria'      => $id_category
            )
        );
        $modulo->data_categoria = $datosCategoria;

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/categorias/v-company-admin-categorias-edit', $data);
    }

    public function listSubCategoriesByCategory($id_category) {
        $modulo = $this->paneladmin->loadPanelCompany();
        $modulo->menu = array("menu" => 4, "submenu" => 0);
        $modulo->url_module_panel = $modulo->url_main_panel."/category";

        $datosCategorias = $this->M_CompanyAdmin_Categorias->getCategoryByCategoriaSuperior(
            array(
                'id_empresa'            => $this->session->id_empresa,
                'id_categoria_superior' => $id_category
            )
        );

        $modulo->titulo_pagina = $modulo->datos_empresa->organization." | Panel Administrativo - Category";

        foreach ($datosCategorias as $categoria) {
            $subCategoria = $this->M_CompanyAdmin_Categorias->getCategoryByCategoriaSuperior(
                array(
                    "id_empresa"            => $this->session->id_empresa,
                    "id_categoria_superior" => $categoria->id_categoria
                )
            );
            $categoria->total_subcategorias = count($subCategoria);
        }

        $modulo->data_categorias = $datosCategorias;

        $data["modulo"] = $modulo;
        $this->load->view('company-admin/module/categorias/v-company-admin-categorias', $data);
    }

    /* <--------------- AJAX ---------------> */

    public function ajaxAddCategory() {
        $json 				= new stdClass();
        $json->type 		= "Categorias";
        $json->presentation = "";
        $json->action 		= "add";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("txtNombreCategoria") ) {
            $capitalizeCategoryName = ucwords(strtolower(trim($this->input->post("txtNombreCategoria", TRUE))));

            $result = $this->M_CompanyAdmin_Categorias->getCategorysByName(
                array(
                    "id_empresa" => $this->session->id_empresa,
                    "nombre_categoria" => $capitalizeCategoryName
                )
            );

            if (sizeof($result) == 0) {
                $nivelCategoria = 1;

                $existeCategoriaSuperior = false;

                $categoriaSuperior = $this->M_CompanyAdmin_Categorias->getCategoryByID(
                        array(
                            "id_empresa" => $this->session->id_empresa,
                            "id_categoria" => trim($this->input->post("cboCategoriaSuperior", TRUE))
                        )
                    );

                if (sizeof($categoriaSuperior) > 0) {
                    $existeCategoriaSuperior = true;
                    $nivelCategoria = intval($categoriaSuperior[0]->nivel_categoria) + 1;
                }

                if (!$this->input->post("cboCategoriaSuperior") || $existeCategoriaSuperior) {
                    unset($result);
                    $result = $this->M_CompanyAdmin_Categorias->insertCategory(
                        array(
                            'id_categoria_superior'  => $this->input->post("cboCategoriaSuperior") ? trim($this->input->post("cboCategoriaSuperior", TRUE)) : NULL,
                            'id_empresa'             => $this->session->id_empresa,
                            'nombre_categoria'       => $capitalizeCategoryName,
                            'nivel_categoria'        => $nivelCategoria
                        )
                    );

                    if (is_int($result)) {
                        $json->message = "La categoria se agrego correctamente.";
                        $json->status = TRUE;
                    } else {
                        $json->message = "Ocurrio un error al grabar la categoria, intente de nuevo.";
                    }
                } else {
                    $json->message = "La categoria superior que selecciono no existe, intente de nuevo.";
                }
            } else {
                $json->message = "La categoria que quiere agregar ya existe, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

    public function ajaxEditCategory() {
        $json 				= new stdClass();
        $json->type 		= "Categoria";
        $json->presentation = "";
        $json->action 		= "edit";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("id_categoria") &&
            $this->input->post("txtNombreCategoria") ) {

            $result = $this->M_CompanyAdmin_Categorias->getCategoryByID(
                array(
                    "id_empresa" => $this->session->id_empresa,
                    "id_categoria" => trim($this->input->post("id_categoria", TRUE))
                )
            );

            if (sizeof($result) > 0) {
                $result = $this->M_CompanyAdmin_Categorias->updateNameCategory(
                    array(
                        'id_empresa'        => $this->session->id_empresa,
                        'id_categoria'      => trim($this->input->post("id_categoria", TRUE)),
                        'nombre_categoria'  => trim($this->input->post("txtNombreCategoria", TRUE))
                    )
                );

                if ($result) {
                    $json->message = "Los datos de la categoria se actualizo correctamente.";
                    $json->status = TRUE;
                } else {
                    $json->message = "Ocurrio un error al grabar la categoria, intente de nuevo.";
                }
            } else {
                $json->message = "La categoria que quiere editar no existe, intente de nuevo.";
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

            $result = $this->M_CompanyAdmin_Categorias->getCategoryByID(
                array(
                    'id_empresa'        => $this->session->id_empresa,
                    'id_categoria'      => trim($this->input->post("id_categoria", TRUE))
                )
            );

            if (sizeof($result) > 0) {

                $subCategorias = $this->M_CompanyAdmin_Categorias->getSubCategoryByIDCategory(
                    array(
                        "id_empresa"            => $this->session->id_empresa,
                        "id_categoria_superior" => trim($this->input->post("id_categoria", TRUE))
                    )
                );

                if (sizeof($subCategorias) == 0) {
                    unset($result);
                    $result = $this->M_CompanyAdmin_Categorias->deleteCategoryByID(
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

}