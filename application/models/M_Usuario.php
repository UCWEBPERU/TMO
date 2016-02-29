<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Usuario extends CI_Model {
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getByID($id_usuario) {
        $this->db->select("Usuario.id_usuario,
        	Usuario.email_usuario,
            Usuario.id_tipo_usuario,
            Tipo_Usuario.nombre_tipo_usuario,
            Persona.nombres_persona,
            Persona.apellidos_persona,
            Persona.pais_persona,
            Persona.region_persona,
            Persona.ciudad_persona,
            Persona.celular_personal,
            Persona.telefono,
            Persona.celular_trabajo,
            Persona.direccion_persona");
		$this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
		$this->db->join('Tipo_Usuario', 'Tipo_Usuario.id_tipo_usuario = Usuario.id_tipo_usuario');
		$this->db->where('Usuario.id_usuario', $id_usuario);
		$this->db->where('Usuario.estado', '1');
		$this->db->where('Tipo_Usuario.estado', '1');
		$query = $this->db->get('Usuario');
        
		return $query->result();
	}

	public function getByIDAndEmpresa($data) {
		$this->db->select("Usuario.id_usuario,
        	Usuario.email_usuario,
            Usuario.id_tipo_usuario,
            Tipo_Usuario.nombre_tipo_usuario,
            Persona.nombres_persona,
            Persona.apellidos_persona,
            Persona.pais_persona,
            Persona.region_persona,
            Persona.ciudad_persona,
            Persona.celular_personal,
            Persona.telefono,
            Persona.celular_trabajo,
            Persona.direccion_persona");
		$this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
		$this->db->join('Tipo_Usuario', 'Tipo_Usuario.id_tipo_usuario = Usuario.id_tipo_usuario');
		$this->db->join('Usuarios_Asignados', 'Usuarios_Asignados.id_usuario = Usuario.id_usuario');
		$this->db->join('Empresa', 'Empresa.id_empresa = Usuarios_Asignados.id_empresa');
		$this->db->where('Usuario.id_usuario', $data["id_usuario"]);
		$this->db->where('Empresa.id_empresa', $data["id_empresa"]);
		$this->db->where('Usuario.estado', '1');
		$this->db->where('Tipo_Usuario.estado', '1');
		$query = $this->db->get('Usuario');

		return $query->result();
	}

	public function getByEmail($email_usuario) {
		$this->db->select("Usuario.id_usuario,
			Usuario.email_usuario,
            Usuario.id_tipo_usuario,
            Tipo_Usuario.nombre_tipo_usuario,
            Persona.nombres_persona,
            Persona.apellidos_persona,
            Persona.pais_persona,
            Persona.region_persona,
            Persona.ciudad_persona,
            Persona.celular_personal,
            Persona.telefono,
            Persona.celular_trabajo,
            Persona.direccion_persona");
		$this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
		$this->db->join('Tipo_Usuario', 'Tipo_Usuario.id_tipo_usuario = Usuario.id_tipo_usuario');
		$this->db->where('Usuario.email_usuario', $email_usuario);
		$this->db->where('Usuario.estado', '1');
		$this->db->where('Tipo_Usuario.estado', '1');
		$query = $this->db->get('Usuario');

		return $query->result();
	}
	
}