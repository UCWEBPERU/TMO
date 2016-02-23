<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Admin_Perfil extends CI_Model {
    
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
    
    public function updatePassWordUsuario($id_usuario, $password_usuario) {
		$data = array(
			'password_usuario'			=> $password_usuario
		);

		$this->db->where('Usuario.id_usuario', $id_usuario);
		if ($this->db->update('Usuario', $data)) {
			return TRUE;
		}
		
		return FALSE;
	}
    
    public function updatePerfilUsuario($datosUsuario) {
		$data = array(
			'nombres_persona'		=> $datosUsuario["nombres_persona"],
			'apellidos_persona'		=> $datosUsuario["apellidos_persona"],
			'pais_persona'			=> $datosUsuario["pais_persona"],
			'region_persona'		=> $datosUsuario["region_persona"],
			'ciudad_persona'		=> $datosUsuario["ciudad_persona"],
			'direccion_persona'		=> $datosUsuario["direccion_persona"],
			'celular_personal'		=> $datosUsuario["celular_personal"],
			'telefono'				=> $datosUsuario["telefono"],
			'celular_trabajo'		=> $datosUsuario["celular_trabajo"]
		);

		$this->db->where('Persona.id_usuario', $datosUsuario["id"]);
		if ($this->db->update('Persona', $data)) {
			return TRUE;
		}
		
		return FALSE;
	}

}