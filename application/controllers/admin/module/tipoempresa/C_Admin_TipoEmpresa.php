<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin_TipoEmpresa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->usersession->validateSession("panel-admin");
        $this->load->model('M_Usuario');
		$this->load->model('admin/M_Admin_TipoEmpresa');
	}

	public function index()	{
		$this->load->library('pagination');
		$modulo = new stdClass();
        
        $usuario = $this->M_Usuario->getByID($this->session->id_usuario);
        
        $modulo->datos_usuario = $usuario[0];
        
        /* Datos de la cabecera del panel de administrador*/
		$modulo->titulo_pagina = "TMO | Panel Principal - Tipo Empresa";      
        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario = $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
        $modulo->tipo_usuario = $usuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo = "Take My Order";
        $modulo->nombre_empresa_corto = "TMO";      
        $modulo->url_signout = base_url()."admin/signOut";
        $modulo->url_main_panel = base_url()."admin";

		$modulo->nombre 					= "Tipo Empresa";
		$modulo->titulo 					= "Tipo Empresa";
		$modulo->titulo_registro 			= "Registro de Tipo de Empresas";
		$modulo->cabecera_registro 			= array("Tipo Empresa");
		$modulo->ruta_plantilla_registro 	= "template/module/module-panel-rows-tipo";
		$modulo->base_url 					= "admin/tipoempresa/";
		$modulo->api_rest_params 			= array("delete" => "id_tipo_empresa");
		$modulo->menu 						= array("menu" => 2, "submenu" => 0);
		$modulo->navegacion 				= array(
												array("nombre" => "Empresa",
													"url" => "",
													"activo" => TRUE)
											);



        		
		$config 							= array();
		$config["base_url"] 				= base_url() . "admin/tipoempresa/page";
		$total_row 							= $this->M_Admin_TipoEmpresa->getTotalTipoEmpresas();
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
		
		$modulo->registros = $this->M_Admin_TipoEmpresa->fetchTipoEmpresas($config["per_page"], ($page - 1) * 15);
		$str_links = $this->pagination->create_links();
		$modulo->links = explode('&nbsp;',$str_links );
		
		$data["modulo"] = $modulo;
		$this->load->view('template/module/module-panel', $data);
	}

	public function agregar() {
		$modulo = new stdClass();
        
        $usuario = $this->M_Usuario->getByID($this->session->id_usuario);
        $modulo->datos_usuario = $usuario[0];
        
		$modulo->titulo 				= "Tipo Empresa";
		$modulo->titulo_pagina			= "TMO | Panel Principal";
        $modulo->icono_empresa 			= PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario 		= $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
        $modulo->tipo_usuario 			= $usuario[0]->nombre_tipo_usuario;
        $modulo->nombre_empresa_largo 	= "Take My Order";
        $modulo->nombre_empresa_corto 	= "TMO";
        $modulo->url_signout 			= base_url()."admin/signOut";
        $modulo->nombreSeccion 			= "Agregar";
        $modulo->base_url 				= "admin/tipoempresa/";
		$modulo->url_signout 			= base_url()."admin/signOut";
		$modulo->url_main_panel 		= base_url()."admin";
		$modulo->menu 					= array("menu" => 2, "submenu" => 0);

		$data["modulo"] 		= $modulo;

		$this->load->view('admin/module/tipoempresa/v-admin-tipoempresa-agregar', $data);
	}

	public function insert() {
		$json 				= new stdClass();
		$json->type 		= "Tipo Empresa";
		$json->presentation = "";
		$json->action 		= "insert";
		$json->data 		= array();
		$json->status 		= FALSE;
		
		if ( $this->input->method(TRUE) == "POST" ) {
			if ( $this->input->post("nombre_tipo_empresa")  ) {
					 
				//$existRow = $this->M_Cliente->getByRUC(trim($this->input->post("ruc", TRUE)));
				
				//if (count($existRow) <= 0) {
					
					$result = $this->M_Admin_TipoEmpresa->insertTipoEmpresa(
					trim($this->input->post("nombre_tipo_empresa", TRUE))
					);
			
					if (is_int($result)) {
						$json->message = "El Tipo de Empresa se agrego correctamente.";
						array_push($json->data, array("id" => $result));
						$json->status 	= TRUE;
					} else {
						$json->message = "Ocurrio un error al agregar el tipo de empresa, intente de nuevo.";
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

	public function edit($idTipoEmpresa) {

		if (isset($idTipoEmpresa)) {
            
			$modulo = new stdClass();
            
            $usuario = $this->M_Usuario->getByID($this->session->id_usuario);
            $modulo->datos_usuario = $usuario[0];
            
			$modulo->titulo 					= "Empresa";
			$modulo->titulo_pagina = "TMO | Panel Principal";      
	        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
            $modulo->nombres_usuario = $usuario[0]->nombres_persona." ".$usuario[0]->apellidos_persona;
            $modulo->tipo_usuario = $usuario[0]->nombre_tipo_usuario;
	        $modulo->nombre_empresa_largo = "Take My Order";
	        $modulo->nombre_empresa_corto = "TMO";      
	        $modulo->url_signout = base_url()."admin/signOut";
	        $modulo->nombreSeccion = "Editar";
	        $modulo->base_url 		= "admin/tipoempresa/";
		


			$result = $this->M_Admin_TipoEmpresa->getTipoEmpresaByID($idTipoEmpresa);
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
					
			$result = $this->M_Admin_TipoEmpresa->getTipoEmpresaByID(trim($this->input->post("id_tipo", TRUE)));
			
			if (count($result) > 0) {
				
				$result = $this->M_Admin_TipoEmpresa->update(
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
			$result = $this->M_Admin_TipoEmpresa->delete(trim($this->input->post("id_tipo_empresa", TRUE)));
		
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