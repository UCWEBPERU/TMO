<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}
	
	public function index()	{
        $this->load->model('M_Empresa');
        $this->load->library('utils/UserSession');
        
        $modulo           = new stdClass();
		$modulo->url_logo = PATH_RESOURCE_ADMIN."img/icon/icon_app.png"; // Default: Logo TMO 
        
        $this->usersession->loadSession($this->session);
                
        if ($this->uri->segment(1) == "admin") {
            if ($this->usersession->validateSession() == 1) {
                redirect("/admin");
            } else if ($this->usersession->validateSession() == 2) {
                redirect("/store".$this->session->id_empresa."/admin");
            }
        } else if ($this->uri->segment(1) == "store" && $this->uri->segment(3) == "admin") {
            if ($this->usersession->validateSession() == 1) {
                redirect("/admin");
            } else if ($this->usersession->validateSession() == 2) {
                redirect("/store".$this->session->id_empresa."/admin");
            }
            
            $validateEmpresa = $this->M_Empresa->getByID( $this->uri->segment(2) );
            
            if (sizeof($validateEmpresa) > 0) {
                $this->load->model('M_Archivo');
                $validateLogoEmpresa = $this->M_Archivo->getByID($validateEmpresa[0]->id_empresa);
                
                if (sizeof($validateLogoEmpresa) > 0) {
                    $modulo->url_logo = $validateLogoEmpresa[0]->url_archivo;
                } else {
                    // Colocar logo de store por defecto
                    $modulo->url_logo = PATH_RESOURCE_ADMIN."img/image_not_found.png";
                }
                
            } else {
                redirect("not-found/store");
            }            
        }
        
        $data["modulo"] = $modulo;
        
        $this->load->view('v_login', $data);
	}

	public function signIn() {
		$this->load->helper('security');
		$this->load->model('M_Login');
		$this->load->library('security/Cryptography');
		
		$json 				= new stdClass();
		$json->type 		= "Iniciar Sesion";
		$json->presentation = "SignIn";
		$json->data 		= array();
		$json->status 		= FALSE;
		
		if ($this->input->post("email_usuario") && $this->input->post("contrasenia_usuario")) {

			$result = $this->M_Login->signIn(trim($this->input->post("email_usuario", TRUE)));

			if (sizeof($result) > 0 ) {
				$Usuario = $result[0];
				if ($this->cryptography->validateHash($Usuario->password_usuario, trim($this->input->post("contrasenia_usuario", TRUE)))) {
					$sessionUser = array(
                        'user_session'          => TRUE,
						'id_usuario'            => intval($Usuario->id_usuario),
						'nombres_usuario'       => $Usuario->nombres_persona,
						'apellidos_usuario'	    => $Usuario->apellidos_persona,
						'email_usuario'		    => $Usuario->email_usuario,
						'id_tipo_usuario'		=> $Usuario->id_tipo_usuario,
						'nombre_tipo_usuario'	=> $Usuario->nombre_tipo_usuario
					);
					
					$this->session->set_userdata($sessionUser);
                    
                    if ($Usuario->nombre_tipo_usuario == "SuperAdministrador") {
                        $json->data = array("url_redirect" => base_url()."admin");
                    } else if ($Usuario->nombre_tipo_usuario == "Administrador") {
                        $json->data = array("url_redirect" => base_url()."store/".$this->uri->segment(2)."/admin");
                    }
                    
					$json->message = "Inicio de sesion existosa.";
					$json->status 	= TRUE;
				} else {
					$json->message = "La contraseña del usuario es incorrecta.";
				}
			} else {
				$json->message = "La cuenta de usuario no existe.";
			}

		}else {
			$json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
		}

		echo json_encode($json);
	}
	
	public function signOut() {
		$sessionUser = array(
            'user_session',
            'id_usuario',
            'nombres_usuario',
            'apellidos_usuario',
            'email_usuario',
            'id_tipo_usuario',
            'nombre_tipo_usuario'
		);
		$this->session->unset_userdata($sessionUser);
		$this->session->sess_destroy();
		redirect('/');
	}

}
