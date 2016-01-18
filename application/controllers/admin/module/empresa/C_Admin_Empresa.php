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
        $modulo->url_signout = base_url()."admin/signOut";


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
		$modulo->titulo 			    = "Empresa";
		$modulo->titulo_pagina          = "TMO | Panel Principal";      
        $modulo->icono_empresa          = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
        $modulo->nombres_usuario        = "Nombres";
        $modulo->tipo_usuario           = "Super Administrador";
        $modulo->nombre_empresa_largo   = "Take My Order";
        $modulo->nombre_empresa_corto   = "TMO";      
        $modulo->url_signout            = base_url()."/admin/signOut";
        $modulo->nombreSeccion          = "Agregar";
        $modulo->base_url 		        = "admin/empresa/";
        
        $modulo->menu                   = array("menu" => 1, "submenu" => 0);


		$modulo->tipo_empresa		=$this->M_Admin_Empresa->getTipoEmpresa();



		$data["modulo"] 		= $modulo;

		$this->load->view('admin/module/empresa/v-admin-empresa-agregar', $data);
	}

	public function edit($idEmpresa) {

		
		if (isset($idEmpresa)) {
			$modulo = new stdClass();
			$modulo->titulo 					= "Empresa";
			$modulo->titulo_pagina = "TMO | Panel Principal";      
	        $modulo->icono_empresa = PATH_RESOURCE_ADMIN."img/icon/icon_app.png";
	        $modulo->nombres_usuario = "Nombres";
	        $modulo->tipo_usuario = "Super Administrador";
	        $modulo->nombre_empresa_largo = "Take My Order";
	        $modulo->nombre_empresa_corto = "TMO";      
	        $modulo->url_signout = base_url()."/admin/signOut";
	        $modulo->nombreSeccion = "Editar";
	        $modulo->base_url 		= "admin/empresa/";
		


			$result = $this->M_Admin_Empresa->getEmpresaByID($idEmpresa);
			if (count($result) > 0) {
				$data["dataEmpresa"] 	= $result[0];
				$data["existeEmpresa"]	= TRUE;
			} else {
				$data["dataEmpresa"] 	= NULL;
				$data["existeEmpresa"]	= FALSE;
			}
			$modulo->id_empresa 		= $idEmpresa;

			
			$data["modulo"] 		= $modulo;
			$this->load->view('admin/module/empresa/v-admin-empresa-agregar', $data);
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
			$json->message = $this->input->post("url_archivo");
			if ( $this->input->post("url_archivo") ) {
					 
				 //$existRow = $this->M_Admin_Empresa->getByID(trim($this->input->post("ruc", TRUE)));
				
				//if (count($existRow) <= 0) {
					$result1 = $this->M_Admin_Empresa->insertUsuario(
					trim($this->input->post("email_usuario", TRUE)), 
					trim($this->input->post("password_usuario", TRUE))
					);	
					if (is_int($result1)) {
						$result2 = $this->M_Admin_Empresa->insertPersona(
							$result1,
							trim($this->input->post("nombres_persona", TRUE)), 
							trim($this->input->post("apellido_persona", TRUE)) 
						);	
						if (is_int($result2)) {
							$result3 = $this->M_Admin_Empresa->insertArchivo(
								trim($this->input->post("url_archivo", TRUE))
							);	
							$this->cargar_archivo(trim($this->input->post("url_archivo", TRUE)));
							if (is_int($result3)) {
								$result4 = $this->M_Admin_Empresa->insertEmpresa(
									trim($this->input->post("id_tipo_empresa", TRUE)),
									$result1,
									$result3,
									trim($this->input->post("nombre_empresa", TRUE))							
								);	

								if (is_int($result4)) {
									$json->message = "La Empresa se Agrego Correctamente.";
									array_push($json->data, array("id_empresa" => $result4));
									$json->status 	= TRUE	;
								} else {
									$json->message = "Ocurrio un error al agregar la Empresa, intente de nuevo.";
								}
									
							} else {
								$json->message = "Ocurrio un error al agregar el Logo, intente de nuevo.";
							}
						} else {
							$json->message = "Ocurrio un error al agregar la Persona, intente de nuevo.";
						}						
					} else {
						$json->message = "Ocurrio un error al agregar el Usuario, intente de nuevo.";
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
	function cargar_archivo( $url_archivo) {

        $url_archivo = 'url_archivo';
        $config['upload_path'] = "resources/logosempresas/";
        $config['file_name'] = "url_archivo";
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($url_archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $data['uploadSuccess'] = $this->upload->data();
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