<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		
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
		
		if ($this->input->post("nombre_usuario") && $this->input->post("contrasenia_usuario")) {

			$result = $this->M_Login->signIn(trim($this->input->post("nombre_usuario", TRUE)));

			if ( sizeof($result) > 0 ) {
				$Usuario = $result[0];
				if ($this->cryptography->validateHash($Usuario->contrasenia, trim($this->input->post("contrasenia_usuario", TRUE)))) {
					$sessionUser = array(
						'nombre_usuario'	=> $Usuario->nombre,
						'email'				=> $Usuario->nombre,
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
