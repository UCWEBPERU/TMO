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

	public function getEmpresaByName($nombre_empresa) {
//		$this->db->select("Empresa.id_empresa,
//							Empresa.nombres_representante,
//							Empresa.apellidos_representante,
//							Empresa.email_representante,
//							Empresa.celular_personal,
//							Empresa.telefono,
//							Empresa.celular_trabajo,
//							Empresa.fax,
//							Empresa.direccion,
//							Empresa.direccion_2,
//							Tipo_Empresa.nombre_tipo_empresa");
		$this->db->join('Tipo_Empresa', 'Tipo_Empresa.id_tipo_empresa = Empresa.id_tipo_empresa');
		$this->db->where('Empresa.estado', '1');
		$this->db->where('Empresa.organization', $nombre_empresa);
		$query = $this->db->get('Empresa');
		return $query->result();
	}

	public function insert($data) {
		$data = array(
			"id_tipo_empresa"			=> $data["id_tipo_empresa"],
			"organization"				=> $data["organization"],
			"nombres_representante"		=> $data["nombres_representante"],
			"apellidos_representante"	=> $data["apellidos_representante"],
			"email_representante"		=> $data["email_representante"],
			"celular_personal"			=> $data["celular_personal"],
			"telefono"					=> $data["telefono"],
			"celular_trabajo"			=> $data["celular_trabajo"],
			"fax"						=> $data["fax"],
			"pais"						=> $data["pais"],
			"region"					=> $data["region"],
			"ciudad"					=> $data["ciudad"],
			"direccion"					=> $data["direccion"],
			"direccion_2"				=> $data["direccion_2"]
		);
		if ($this->db->insert('Empresa', $data)) {
			return $this->db->insert_id();
		}

		return FALSE;
	}

	public function update($data) {
		$data = array(
			"id_tipo_empresa"			=> $data["id_tipo_empresa"],
			"organization"				=> $data["organization"],
			"nombres_representante"		=> $data["nombres_representante"],
			"apellidos_representante"	=> $data["apellidos_representante"],
			"email_representante"		=> $data["email_representante"],
			"celular_personal"			=> $data["celular_personal"],
			"telefono"					=> $data["telefono"],
			"celular_trabajo"			=> $data["celular_trabajo"],
			"fax"						=> $data["fax"],
			"pais"						=> $data["pais"],
			"region"					=> $data["region"],
			"ciudad"					=> $data["ciudad"],
			"direccion"					=> $data["direccion"],
			"direccion_2"				=> $data["direccion_2"]
		);
		$this->db->where('id_empresa', $data["id_empresa"]);
		if ($this->db->update('Empresa', $data)) {
			return TRUE;
		}

		return FALSE;
	}
	
}