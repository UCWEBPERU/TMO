<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin_Empresa extends CI_Controller {
	

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->load->model('admin/M_Admin_Empresa');
        
        $this->usersession->loadSession($this->session);
        if (!$this->usersession->validateSession()) {
            redirect("/admin/login");
        }
		
		
	}

	public function index()	{
		$this->load->library('pagination');
		$modulo = new stdClass();

		$modulo->titulo_pagina = "TMO | Panel Principal";      
        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario = "Nombres";
        $modulo->tipo_usuario = "Super Administrador";
        $modulo->nombre_empresa_largo = "Take My Order";
        $modulo->nombre_empresa_corto = "TMO";      
        $modulo->url_signout = "/admin/signOut";


		$modulo->nombre 					= "Empresa";
		$modulo->titulo 					= "Empresa";
		$modulo->titulo_registro 			= "Registro de Empresas";
		$modulo->cabecera_registro 			= array("Nombre Empresa", "Representante", "Cuenta", "Tipo Empresa", "Direccion", "Telefono");
		$modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-store";
		$modulo->base_url 					= "admin/empresa/";
		$modulo->api_rest_params 			= array("delete" => "id_empresa");
		$modulo->menu 						= array("menu" => 1, "submenu" => 0);
		$modulo->navegacion 				= array(
												array("nombre" => "Empresa",
													"url" => "",
													"activo" => TRUE)
											);



        		
		$config 							= array();
		$config["base_url"] 				= base_url() . "admin/empresa/page";
		$total_row 							= $this->M_Admin_Empresa->getTotalEmpresas();
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
		
		$modulo->registros = $this->M_Admin_Empresa->fetchEmpresas($config["per_page"], ($page - 1) * 15);
		$str_links = $this->pagination->create_links();
		$modulo->links = explode('&nbsp;',$str_links );
		
		$data["modulo"] = $modulo;
		$this->load->view('template/module/module-panel', $data);
	}


	public function agregar() {
		$modulo = new stdClass();
		$modulo->titulo 					= "Empresa";
		$modulo->titulo_pagina = "TMO | Panel Principal";      
        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario = "Nombres";
        $modulo->tipo_usuario = "Super Administrador";
        $modulo->nombre_empresa_largo = "Take My Order";
        $modulo->nombre_empresa_corto = "TMO";      
        $modulo->url_signout = "/admin/signOut";
        $modulo->nombreSeccion = "Agregar";
        $modulo->base_url 		= "admin/empresa/";

		$tipo_empresa		=$this->M_Admin_Empresa->getTipoEmpresa();

		$data["modulo"] 		= $modulo;

		$this->load->view('admin/module/empresa/v_admin_empresa_agregar', $data);
	}

	public function edit($idEmpresa) {
		
		if (isset($idEmpresa)) {
			$result = $this->M_Admin_Empresa->getEmpresaByID($idEmpresa);
			if (count($result) > 0) {
				$data["dataEmpresa"] 	= $result[0];
				$data["existeEmpresa"]	= TRUE;
			} else {
				$data["dataEmpresa"] 	= NULL;
				$data["existeEmpresa"]	= FALSE;
			}
			$data["id_empresa"] 		= $idEmpresa;
			$data["nombreSeccion"]		= "Editar";
			$this->load->view('admin/template/module/cliente/cliente-agregar', $data);
		} else {
			redirect('/');
		}
		
	}

	public function insert() {
		$json 				= new stdClass();
		$json->type 		= "Empresa";
		$json->presentation = "";
		$json->action 		= "insert";
		$json->data 		= array();
		$json->status 		= FALSE;
		
		if ( $this->input->method(TRUE) == "POST" ) {
			if ( $this->input->post("id_tipo_empresa") &&
				 $this->input->post("id_usuario") &&
				 $this->input->post("id_pay_account") &&
				 $this->input->post("id_archivo_logo") &&
				 $this->input->post("nombre_empresa") //&&
				 //$this->input->post("descripcion_empresa") &&
				 //$this->input->post("direccion_empresa") &&
				 //$this->input->post("pais_region_empresa") &&
				 //$this->input->post("estado_region_empresa") &&
				 //$this->input->post("codigo_postal_empresa") &&
				 //$this->input->post("telefono_empresa") &&
				 //$this->input->post("movil_empresa") 
				 ) {
					 
				 //$existRow = $this->M_Admin_Empresa->getByID(trim($this->input->post("ruc", TRUE)));
				
				//if (count($existRow) <= 0) {
					
					$result = $this->M_Admin_Empresa->insert(
					trim($this->input->post("id_tipo_empresa", TRUE)), 
					trim($this->input->post("id_usuario", TRUE)), 
					trim($this->input->post("id_pay_account", TRUE)), 
					trim($this->input->post("id_archivo_logo", TRUE)), 
					trim($this->input->post("nombre_empresa", TRUE)), 
					trim($this->input->post("descripcion_empresa", TRUE)), 
					trim($this->input->post("direccion_empresa", TRUE)), 
					trim($this->input->post("pais_region_empresa", TRUE)), 
					trim($this->input->post("estado_region_empresa", TRUE)), 
					trim($this->input->post("codigo_postal_empresa", TRUE)), 
					trim($this->input->post("telefono_empresa", TRUE)), 
					trim($this->input->post("movil_empresa", TRUE)) 
					);
			
					if (is_int($result)) {
						$json->message = "La Empresa se Agrego Correctamente.";
						array_push($json->data, array("id_empresa" => $result));
						$json->status 	= TRUE;
					} else {
						$json->message = "Ocurrio un error al agregar la empresa, intente de nuevo.";
					}
					
				//} else {
					//$json->message = "Lo sentimos el cliente que desea agregar tiene un ruc que ya existe.";
				//}
				
			} else {
				$json->message = "No se recibio ningun dato.";
			}
			
		} else {
			$json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
		}
		
		echo json_encode($json);
		
	}

	public function delete() {
		$json 				= new stdClass();
		$json->type 		= "Empresa";
		$json->presentation = "";
		$json->action 		= "delete";
		$json->data 		= array();
		$json->status 		= FALSE;
		
		if ( $this->input->post("id_empresa") ) {
			$result = $this->M_Admin_Empresa->delete(trim($this->input->post("id_empresa", TRUE)));
		
			if ($result) {
				$json->message = "Empresa eliminado correctamente.";
				$json->status 	= TRUE;
			} else {
				$json->message = "Ocurrio un error al eliminar la Empresa, intente de nuevo.";
			}
			
		} else {
			$json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
		}
		
		echo json_encode($json);
	}

	public function update() {
		
		$json 				= new stdClass();
		$json->type 		= "Empresa";
		$json->presentation = "";
		$json->action 		= "update";
		$json->data 		= array();
		$json->status 		= FALSE;
		
		if ( 	$this->input->post("id_tipo_empresa") &&
				$this->input->post("id_usuario") &&
				$this->input->post("id_pay_account") &&
				$this->input->post("id_archivo_logo") &&
				$this->input->post("nombre_empresa") &&
				$this->input->post("descripcion_empresa") &&
				$this->input->post("direccion_empresa") &&
				$this->input->post("pais_region_empresa") &&
				$this->input->post("estado_region_empresa") &&
				$this->input->post("codigo_postal_empresa") &&
				$this->input->post("telefono_empresa") &&
				$this->input->post("movil_empresa") 
				 ) {
					
			$result = $this->M_Admin_Empresa->getByID(trim($this->input->post("id_empresa", TRUE)));
			
			if (count($result) > 0) {
				
				$result = $this->M_Admin_Empresa->update(
					trim($this->input->post("id_tipo_empresa", TRUE)), 
					trim($this->input->post("id_usuario", TRUE)), 
					trim($this->input->post("id_pay_account", TRUE)), 
					trim($this->input->post("id_archivo_logo", TRUE)), 
					trim($this->input->post("nombre_empresa", TRUE)), 
					trim($this->input->post("descripcion_empresa", TRUE)), 
					trim($this->input->post("direccion_empresa", TRUE)), 
					trim($this->input->post("pais_region_empresa", TRUE)), 
					trim($this->input->post("estado_region_empresa", TRUE)), 
					trim($this->input->post("codigo_postal_empresa", TRUE)), 
					trim($this->input->post("telefono_empresa", TRUE)), 
					trim($this->input->post("movil_empresa", TRUE)) 
					);
			
				if ($result) {
					$json->message = "La Empresa se actualizo correctamente.";
					array_push($json->data, array("id_empresa" => $result));
					$json->status 	= TRUE;
				} else {
					$json->message = "Ocurrio un error al actualizar la Empresa, intente de nuevo.";
				}
				
			} else {
				$json->message = "Lo sentimos la Empresa que desea editar no existe.";
			}
			
		} else {
			$json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
		}
		
		echo json_encode($json);
		
	}

}
