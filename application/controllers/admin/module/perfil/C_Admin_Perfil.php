<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin_Perfil extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-admin");
	}

	public function index()	{
        $this->load->model("M_Usuario");
        $this->load->model("M_GEO_Data");
        $modulo = new stdClass();
        $modulo->titulo_pagina = "TMO | Panel Principal - Perfil";
        
        $usuario = $this->M_Usuario->getByID($this->session->id_usuario);

        $modulo->datos_usuario      = $usuario[0];
        $modulo->data_geo_countries = $this->M_GEO_Data->getAllCountries();
        $modulo->data_geo_regions   = $this->M_GEO_Data->getRegionsByCountry($modulo->datos_usuario->pais_persona);
        $modulo->data_geo_cities    = $this->M_GEO_Data->getCitiesByRegionAndCountry(
                array(
                    "code_country"  => $modulo->datos_usuario->pais_persona,
                    "code_region"   => $modulo->datos_usuario->region_persona
                )
            );


        /* Datos de la cabecera del panel de administrador*/
        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario = $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $usuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = "Take My Order";
        $modulo->nombre_empresa_corto = "TMO";
        /* --------------------*-------------------- */
        
        $modulo->url_signout = base_url()."admin/signOut";
        $modulo->url_main_panel = base_url()."admin";
        $modulo->menu = array("menu" => 5, "submenu" => 0);
        
        $data["modulo"] = $modulo;
        $this->load->view('admin/module/perfil/v-admin-perfil', $data);
	}
    
    public function updateCuentaUsuario() {
        $this->load->helper('security');
		$this->load->model('admin/M_Admin_Perfil');
		$this->load->library('security/Cryptography');
		
		$json 				= new stdClass();
		$json->type 		= "Actualizar Datos de Usuario";
		$json->presentation = "";
		$json->data 		= array();
		$json->status 		= FALSE;
        
		if ($this->input->post("passwordUsuario") && $this->input->post("repeatPasswordUsuario") ) {

            $result = $this->M_Admin_Perfil->updatePassWordUsuario($this->session->id_usuario, $this->cryptography->Encrypt(trim($this->input->post("passwordUsuario", TRUE))));
            
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
    
    public function updatePerfil() {
        $this->load->helper('security');
		$this->load->model('admin/M_Admin_Perfil');
		
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

            $result = $this->M_Admin_Perfil->updatePerfilUsuario(array(
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

}