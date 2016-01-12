<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->library('utils/UserSession');
<<<<<<< HEAD
        
        $this->usersession->validateSessionEntry("/admin");
=======
>>>>>>> e768217b2db5318ee04e1d9959e90391cee280f2
		
	}
	
	public function index()	{
        $this->load->view('login');
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

			if ( sizeof($result) > 0 ) {
				$Usuario = $result[0];
				if ($this->cryptography->validateHash($Usuario->password_usuario, trim($this->input->post("contrasenia_usuario", TRUE)))) {
					$sessionUser = array(
						'nombre_usuario'	=> $Usuario->nombres_persona,
						'email'				=> $Usuario->email_usuario,
						'user_session'		=> TRUE,
						'logged_in' 		=> TRUE
					);
					
					$this->session->set_userdata($sessionUser);
					
					$json->message = "Inicio de sesion existosa.";
					$json->status 	= TRUE;
				} else {
					$json->message = "La contraseña del usuario es incorrecta.";
				}
			} else {
				$json->message = "La cuenta de usuario no existe.";
			}

		} else {
			$json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
		}

		echo json_encode($json);
	}
	
	public function signOut() {
		$sessionUser = array(
			'nombre_usuario',
			'email',
			'logged_in'
		);
		$this->session->unset_userdata($sessionUser);
		$this->session->sess_destroy();
		redirect('/');
	}

}
