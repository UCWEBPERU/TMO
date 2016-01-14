<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Admin_Empresa extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}

	public function getEmpresas() {
		$this->db->select("Empresa.id_empresa, 
							Persona.nombres_persona, 
							Pay_Account.pay_id, 
							Tipo_Empresa.nombre_tipo_empresa,
							Empresa.nombre_empresa, Empresa.direccion_empresa, 
							Empresa.telefono_empresa, Empresa.estado ");
		$this->db->join('Usuario', 'Usuario.id_usuario = Empresa.id_usuario');
		$this->db->join('Persona', 'Persona.id_usuario = Empresa.id_usuario');
		$this->db->join('Pay_Account', 'Pay_Account.id_pay_account = Empresa.id_pay_account');
		$this->db->join('Tipo_Empresa', 'Tipo_Empresa.id_tipo_empresa = Empresa.id_tipo_empresa');
		$this->db->where('Empresa.estado', '1');
		$query = $this->db->get('Empresa');
		return $query->result();
	}

	public function fetchEmpresas($limit, $start) {
		$this->db->select("Empresa.id_empresa, 
							Persona.nombres_persona, 
							Pay_Account.pay_id, 
							Tipo_Empresa.nombre_tipo_empresa,
							Empresa.nombre_empresa, Empresa.direccion_empresa, 
							Empresa.telefono_empresa, Empresa.estado ");
		$this->db->join('Usuario', 'Usuario.id_usuario = Empresa.id_usuario');
		$this->db->join('Persona', 'Persona.id_usuario = Empresa.id_usuario');
		$this->db->join('Pay_Account', 'Pay_Account.id_pay_account = Empresa.id_pay_account');
		$this->db->join('Tipo_Empresa', 'Tipo_Empresa.id_tipo_empresa = Empresa.id_tipo_empresa');
		$this->db->where('Empresa.estado', '1');
		$this->db->limit($limit, $start);
		$query = $this->db->get('Empresa');

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		
		return FALSE;
	}

	public function getTotalEmpresas() {
		$this->db->where('Empresa.estado', '1');
		$query = $this->db->get('Empresa');
		return $query->num_rows();
	}

	public function getByID($id_empresa) {
		$this->db->select("Empresa.id_empresa, 
							Persona.nombres_persona, 
							Pay_Account.pay_id, 
							Tipo_Empresa.nombre_tipo_empresa,
							Empresa.nombre_empresa, Empresa.direccion_empresa, 
							Empresa.telefono_empresa, Empresa.estado ");
		$this->db->join('Usuario', 'Usuario.id_usuario = Empresa.id_usuario');
		$this->db->join('Persona', 'Persona.id_usuario = Empresa.id_usuario');
		$this->db->join('Pay_Account', 'Pay_Account.id_pay_account = Empresa.id_pay_account');
		$this->db->join('Tipo_Empresa', 'Tipo_Empresa.id_tipo_empresa = Empresa.id_tipo_empresa');
		$this->db->where('Empresa.estado', '1');
		$this->db->where('Empresa.id_empresa', $id_empresa);
		$query = $this->db->get('Empresa');
		return $query->result();
	}

	


	public function insert($id_tipo_empresa, $id_usuario, $id_pay_account, $id_archivo_logo, 
							$nombre_empresa, $descripcion_empresa, $direccion_empresa, 
							$pais_region_empresa, $estado_region_empresa, $codigo_postal_empresa, 
							$telefono_empresa, $movil_empresa) {
		$data = array(
			'id_tipo_empresa'			=> $id_tipo_empresa, 
			'id_usuario'				=> $id_usuario,
			'id_pay_account'			=> $id_pay_account,
			'id_archivo_logo'			=> $id_archivo_logo,
			'nombre_empresa'			=> $nombre_empresa,
			'descripcion_empresa'		=> $descripcion_empresa,
			'direccion_empresa'			=> $direccion_empresa,
			'pais_region_empresa'		=> $pais_region_empresa,
			'estado_region_empresa'		=> $estado_region_empresa,
			'codigo_postal_empresa'		=> $codigo_postal_empresa,
			'telefono_empresa'			=> $telefono_empresa,
			'movil_empresa'				=> $movil_empresa

		);
		if ($this->db->insert('Empresa', $data)) {
			return $this->db->insert_id();
		}
		
		return FALSE;
	}

	public function update($id_empresa, $id_tipo_empresa, $id_usuario, $id_pay_account, $id_archivo_logo, 
							$nombre_empresa, $descripcion_empresa, $direccion_empresa, 
							$pais_region_empresa, $estado_region_empresa, $codigo_postal_empresa, 
							$telefono_empresa, $movil_empresa) {
		$data = array(
			'id_tipo_empresa'			=> $id_tipo_empresa, 
			'id_usuario'				=> $id_usuario,
			'id_pay_account'			=> $id_pay_account,
			'id_archivo_logo'			=> $id_archivo_logo,
			'nombre_empresa'			=> $nombre_empresa,
			'descripcion_empresa'		=> $descripcion_empresa,
			'direccion_empresa'			=> $direccion_empresa,
			'pais_region_empresa'		=> $pais_region_empresa,
			'estado_region_empresa'		=> $estado_region_empresa,
			'codigo_postal_empresa'		=> $codigo_postal_empresa,
			'telefono_empresa'			=> $telefono_empresa,
			'movil_empresa'				=> $movil_empresa,
			
		);

		$this->db->where('Empresa.id_empresa', $id_empresa);
		if ($this->db->update('Empresa', $data)) {
			return TRUE;
		}
		
		return FALSE;
	}

	public function updatePayAccount($id_pay_account, $pay_id, $tipo_metodo_pago) {
		$data = array(
			'id_pay_account'		=> $id_pay_account, 
			'pay_id'				=> $pay_id,
			'tipo_metodo_pago' 		=> $tipo_metodo_pago
		);
		$this->db->where('Pay_Account.id_pay_account', $id_pay_account);
		if ($this->db->update('Pay_Account', $data)) {
			return TRUE;
		}
		
		return FALSE;
	}

	public function updateLogo($id_archivo, $url_archivo) {
		$data = array(
			'id_archivo'		=> $id_archivo, 
			'url_archivo'		=> $url_archivo
		);

		$this->db->where('Archivo.id_archivo', $id_archivo);
		if ($this->db->update('Archivo', $data)) {
			return TRUE;
		}
		
		return FALSE;
	}

	public function delete($id_empresa) {
		$this->db->where('Empresa.id_empresa', $id_empresa);
		if ($this->db->update('Empresa', array('Empresa.estado'=> 0)))	{
			return TRUE;
		}
		return FALSE;
	}

	
}
