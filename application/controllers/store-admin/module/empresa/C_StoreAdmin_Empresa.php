<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_StoreAdmin_Empresa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-store-admin");
	}

	public function index()	{
        $this->load->model("store-admin/M_StoreAdmin_Empresa");
        $this->load->model('M_Archivo');
        $this->load->model('M_Empresa');
        $this->load->model('M_Usuario');
        $this->load->model('M_Tipo_Empresa');
        
        $modulo = new stdClass();
        
        $dataEmpresa        = $this->M_Empresa->getByID($this->session->id_empresa);
        $dataUsuario        = $this->M_Usuario->getByID($this->session->id_usuario);
        $dataLogoEmpresa    = $this->M_Archivo->getByID($dataEmpresa[0]->id_archivo_logo);
        $dataPayAccount     = $this->M_StoreAdmin_Empresa->getPayAccountByID($dataEmpresa[0]->id_pay_account);
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
        $this->load->view('store-admin/module/empresa/v-store-admin-empresa', $data);
	}
    
    public function updateDatosStore() {
        $this->load->model("store-admin/M_StoreAdmin_Empresa");
        
		$json 				= new stdClass();
		$json->type 		= "Store";
		$json->presentation = "";
		$json->action 		= "update";
		$json->data 		= array();
		$json->status 		= FALSE;
            
        if ( $this->input->post("txtNombreEmpresa") ) {
                
                $result = $this->M_StoreAdmin_Empresa->updateDatosEmpresa(
                    array(
                        "id_empresa"            => $this->session->id_empresa,
                        "nombre_empresa"        => trim($this->input->post("txtNombreEmpresa", TRUE)),
                        "id_tipo_empresa"       => trim($this->input->post("cbo_tipo_empresa", TRUE)),
                        "descripcion_empresa"   => trim($this->input->post("txtDescripcion", TRUE)),
                        "direccion_empresa"     => trim($this->input->post("txtDireccion", TRUE)),
                        "pais_region_empresa"   => trim($this->input->post("txtPais", TRUE)),
                        "estado_region_empresa" => trim($this->input->post("txtEstado", TRUE)),
                        "codigo_postal_empresa" => trim($this->input->post("txtCodigoPostal", TRUE)),
                        "telefono_empresa"      => trim($this->input->post("txtNumeroCelular", TRUE)),
                        "movil_empresa"         => trim($this->input->post("txtNumeroTelefono", TRUE))
                    )
                );
                
                if ($result) {
                    $json->message = "Los datos de la empresa se actualizo correctamente.";
                    $json->status = TRUE;
                } else {
                    $json->message = "Ocurrio un error al actualizar los datos de la empresa, intente de nuevo.";
                }
            
        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }
		
		echo json_encode($json);
        
    }
    
    public function updateDatosPayAccount() {
        $this->load->model("store-admin/M_StoreAdmin_Empresa");
        $this->load->model("M_Empresa");
        
		$json 				= new stdClass();
		$json->type 		= "Pay Account";
		$json->presentation = "";
		$json->action 		= "insert/update";
		$json->data 		= array();
		$json->status 		= FALSE;
            
        if ( $this->input->post("txtIDPayAccount") &&
                $this->input->post("txtTipoPayAccount") ) {
                    
                $dataEmpresa = $this->M_Empresa->getByID($this->session->id_empresa);
                $dataPayAccount = $this->M_StoreAdmin_Empresa->getPayAccountByID($dataEmpresa[0]->id_pay_account);
                
                if (sizeof($dataPayAccount) > 0) {
                    $resultUpdate = $this->M_StoreAdmin_Empresa->updateDatosPayAccount(
                            array(
                                'id_pay_account'    => $dataEmpresa[0]->id_pay_account,
                                'pay_id'            => trim($this->input->post("txtIDPayAccount", TRUE)),
                                'tipo_metodo_pago'  => trim($this->input->post("txtTipoPayAccount", TRUE))
                            )
                        );
                    if ($resultUpdate) {
                        $json->message = "Sus datos de cuenta de pago se actualizo correctamente.";
                        $json->status = TRUE;
                    } else {
                        $json->message = "Ocurrio un error al actualizar sus datos de cuenta de pago, intente de nuevo.";
                    }
                } else {
                    $resultInsert = $this->M_StoreAdmin_Empresa->insertDatosPayAccount(
                            array(
                                'pay_id'           => trim($this->input->post("txtIDPayAccount", TRUE)),
                                'tipo_metodo_pago' => trim($this->input->post("txtTipoPayAccount", TRUE))
                            )
                        );
                    if (is_int($resultInsert)) {
                        $resultUpdate = $this->M_StoreAdmin_Empresa->updateIDPayAccountOnEmpresa(
                            array(
                                'id_empresa'     => $this->session->id_empresa,
                                'id_pay_account' => $resultInsert,
                            )
                        );
                        
                        if ($resultUpdate) {
                            $json->message = "Sus datos de cuenta de pago se guardo correctamente.";
                            $json->status = TRUE;
                        } else {
                            $json->message = "Ocurrio un error al guardar sus datos de cuenta de pago, intente de nuevo.";
                        }
                        
                    } else {
                        $json->message = "Ocurrio un error al guardar sus datos de cuenta de pago, intente de nuevo.";
                    }
                }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

		echo json_encode($json);
    }
    
    public function updateLogoStore() {
        $this->load->model("store-admin/M_StoreAdmin_Empresa");
        $this->load->model("M_Empresa");
        $this->load->library('utils/UploadFile');
        
		$json 				= new stdClass();
		$json->type 		= "Logo Empresa";
		$json->presentation = "";
		$json->action 		= "update";
		$json->data 		= array();
		$json->status 		= FALSE;
            
        if ( $this->uploadfile->validateFile("imgLogoStore") ) { 
            $dataEmpresa = $this->M_Empresa->getByID($this->session->id_empresa);
            
            $path = "uploads/store/".$this->session->id_empresa."/logo/";

            $path = $this->uploadfile->upload("imgLogoStore", "logo", $path);
            
            $result = $this->M_StoreAdmin_Empresa->updateLogoOnEmpresa(
                array(
                    "id_archivo"    => $dataEmpresa[0]->id_archivo_logo,
                    "path"          => $path["path"];
                )
            );
            
            if ($result) {
                $json->message = "El logo de la empresa se actualizó correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "Ocurrio un error al al actualizar el logo de la empresa, intente de nuevo.";
            }
        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

		echo json_encode($json);
    }

}