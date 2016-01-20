<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Usuario extends CI_Model{
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getByID($id_usuario) {
        $this->db->select("Usuario.email_usuario, 
            Usuario.id_tipo_usuario,
            Tipo_Usuario.nombre_tipo_usuario,
            Persona.nombres_persona,
            Persona.apellidos_persona,
            Persona.pais_region_persona,
            Persona.estado_region_persona,
            Persona.direccion_persona,
            Persona.movil_persona,
            Persona.telefono_persona");
            
		$this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
		$this->db->join('Tipo_Usuario', 'Tipo_Usuario.id_tipo_usuario = Usuario.id_tipo_usuario');
		$this->db->where('Usuario.id_usuario', $id_usuario);
		$this->db->where('Usuario.estado', '1');
		$this->db->where('Tipo_Usuario.estado', '1');
		$query = $this->db->get('Usuario');
        
		return $query->result();
	}
	
}