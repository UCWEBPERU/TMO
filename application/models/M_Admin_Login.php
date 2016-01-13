<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Admin_Login extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}

	public function signIn($email_usuario) {
		$this->db->select("Usuario.id_usuario, Usuario.id_tipo_usuario ,Usuario.email_usuario, Usuario.password_usuario, Persona.nombres_persona");
		$this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
		$this->db->where('Usuario.email_usuario', $email_usuario);
		$this->db->where('Usuario.estado', '1');
		$this->db->where('Usuario.id_tipo_usuario', '1');
		$query = $this->db->get('Usuario');

		return $query->result();
	}

	
	
}
