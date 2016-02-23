<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Admin_Usuario extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getUsuariosStore() {
		$this->db->select("
       		Usuario.id_usuario,
            Usuario.email_usuario,
            Usuario.fecha_registro_usuario,
            Persona.nombres_persona,
            Persona.apellidos_persona,
            Empresa.id_empresa,
            Empresa.organization");
		$this->db->join('Usuarios_Asignados', 'Usuarios_Asignados.id_usuario = Usuario.id_usuario');
		$this->db->join('Empresa', 'Empresa.id_empresa = Usuarios_Asignados.id_empresa');
		$this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
		$this->db->join('Tipo_Usuario', 'Tipo_Usuario.id_tipo_usuario = Usuario.id_tipo_usuario');
		$this->db->where('Empresa.estado', '1');
		$this->db->where('Usuario.estado', '1');
		$this->db->where('Usuario.id_tipo_usuario', 2);
		$this->db->where('Tipo_Usuario.estado', '1');
		$query = $this->db->get('Usuario');
		return $query->result();
	}

	public function fetchUsuariosStore($limit, $start) {
		$this->db->select("
       		Usuario.id_usuario,
            Usuario.email_usuario,
            Usuario.fecha_registro_usuario,
            Persona.nombres_persona,
            Persona.apellidos_persona,
            Empresa.id_empresa,
            Empresa.organization");
		$this->db->join('Usuarios_Asignados', 'Usuarios_Asignados.id_usuario = Usuario.id_usuario');
		$this->db->join('Empresa', 'Empresa.id_empresa = Usuarios_Asignados.id_empresa');
		$this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
		$this->db->join('Tipo_Usuario', 'Tipo_Usuario.id_tipo_usuario = Usuario.id_tipo_usuario');
		$this->db->where('Empresa.estado', '1');
		$this->db->where('Usuario.estado', '1');
		$this->db->where('Usuario.id_tipo_usuario', 2);
		$this->db->where('Tipo_Usuario.estado', '1');
		$this->db->limit($limit, $start);
		$query = $this->db->get('Usuario');

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

		return FALSE;
	}

	public function getTotalUsuariosStore() {
		$this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
		$this->db->join('Tipo_Usuario', 'Tipo_Usuario.id_tipo_usuario = Usuario.id_tipo_usuario');
		$this->db->join('Empresa', 'Empresa.id_usuario = Usuario.id_usuario');
		$this->db->where('Usuario.estado', '1');
		$this->db->where('Usuario.id_tipo_usuario', 2);
		$this->db->where('Tipo_Usuario.estado', '1');
		$query = $this->db->get('Usuario');
		return $query->num_rows();
	}

}