<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Empresa extends CI_Model{
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getByID($id_empresa) {
        
		// $this->db->select("Usuario.id_usuario, Usuario.email_usuario, Usuario.password_usuario, Usuario.id_tipo_usuario, Tipo_Usuario.nombre_tipo_usuario, Persona.nombres_persona, Persona.apellidos_persona");
		// $this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
		// $this->db->join('Tipo_Usuario', 'Tipo_Usuario.id_tipo_usuario = Usuario.id_tipo_usuario');
		$this->db->where('Empresa.id_empresa', $id_empresa);
		$this->db->where('Empresa.estado', '1');
		$query = $this->db->get('Empresa');

		return $query->result();
	}
	
}