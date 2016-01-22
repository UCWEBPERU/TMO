<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_StoreAdmin_Empresa extends CI_Model{
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
    
    public function getPayAccountByID($id_pay_account) {
        $this->db->where('id_pay_account', $id_pay_account);
        $this->db->where('estado', '1');
		$query = $this->db->get('Pay_Account');
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
			'nombres_persona'		=> $datosUsuario["nombres"],
			'apellidos_persona'		=> $datosUsuario["apellidos"],
			'pais_region_persona'	=> $datosUsuario["pais_region"],
			'estado_region_persona'	=> $datosUsuario["estado_Region"],
			'direccion_persona'		=> $datosUsuario["direccion"],
			'movil_persona'			=> $datosUsuario["movil"],
			'telefono_persona'		=> $datosUsuario["telefono"]
		);

		$this->db->where('Persona.id_usuario', $datosUsuario["id"]);
		if ($this->db->update('Persona', $data)) {
			return TRUE;
		}
		
		return FALSE;
	}
    
    
    public function updateDatosEmpresa($data_empresa) {
		$data = array(
			'nombre_empresa'			=> $data_empresa["nombre_empresa"],
			'id_tipo_empresa'			=> $data_empresa["id_tipo_empresa"], 
			'descripcion_empresa'		=> $data_empresa["descripcion_empresa"],
			'direccion_empresa'			=> $data_empresa["direccion_empresa"],
			'pais_region_empresa'		=> $data_empresa["pais_region_empresa"],
			'estado_region_empresa'		=> $data_empresa["estado_region_empresa"],
			'codigo_postal_empresa'		=> $data_empresa["codigo_postal_empresa"],
			'telefono_empresa'			=> $data_empresa["telefono_empresa"],
			'movil_empresa'				=> $data_empresa["movil_empresa"]
		);

		$this->db->where('id_empresa', $data_empresa["id_empresa"]);
		if ($this->db->update('Empresa', $data)) {
			return TRUE;
		}
		
		return FALSE;
	}

}