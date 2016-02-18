<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Admin_Empresa extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}

	public function getEmpresas() {
		$this->db->select("Empresa.id_empresa, 
							Empresa.nombres_representante, 
							Empresa.apellidos_representante, 
							Empresa.email_representante, 
							Empresa.celular_personal, 
							Empresa.telefono, 
							Empresa.celular_trabajo, 
							Empresa.fax, 
							Empresa.direccion, 
							Empresa.direccion_2, 
							Pay_Account.pay_id, 
							Tipo_Empresa.nombre_tipo_empresa");
        
        // GEO_Countries.code as 'code_pais',
        // GEO_Countries.name as 'nombre_pais',
        // GEO_Regions.ID as 'id_region',
        // GEO_Regions.name as 'nombre_region',
        // GEO_Cities.ID as 'id_ciudad',
        // GEO_Cities.name as 'nombre_ciudad',                            
                            
		// $this->db->join('GEO_Countries', 'GEO_Countries.code = Empresa.pais');
		// $this->db->join('GEO_Regions', 'GEO_Regions.ID = Empresa.region');
		// $this->db->join('GEO_Cities', 'GEO_Cities.ID = Empresa.ciudad');
		$this->db->join('Pay_Account', 'Pay_Account.id_pay_account = Empresa.id_pay_account');
		$this->db->join('Tipo_Empresa', 'Tipo_Empresa.id_tipo_empresa = Empresa.id_tipo_empresa');
		$this->db->where('Empresa.estado', '1');
		$query = $this->db->get('Empresa');
		return $query->result();
	}

	public function getTipoEmpresa() {
		$this->db->select(" Tipo_Empresa.id_tipo_empresa, 
							Tipo_Empresa.nombre_tipo_empresa");
		
		$this->db->where('Tipo_Empresa.estado', '1');
		$query = $this->db->get('Tipo_Empresa');
		return $query->result();
	}

	public function fetchEmpresas($limit, $start) {
		$this->db->select("Empresa.id_empresa, 
							Empresa.nombres_representante, 
							Empresa.apellidos_representante, 
							Empresa.email_representante, 
							Empresa.celular_personal, 
							Empresa.telefono, 
							Empresa.celular_trabajo, 
							Empresa.fax, 
							Empresa.direccion, 
							Empresa.direccion_2, 
							Pay_Account.pay_id, 
							Tipo_Empresa.nombre_tipo_empresa");
		$this->db->join('Pay_Account', 'Pay_Account.id_pay_account = Empresa.id_pay_account');
		$this->db->join('Tipo_Empresa', 'Tipo_Empresa.id_tipo_empresa = Empresa.id_tipo_empresa');
		$this->db->where('Empresa.estado', '1');
		$query = $this->db->get('Empresa');
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

	public function getEmpresaByID($id_empresa) {
		$this->db->select("Empresa.id_empresa, 
							Empresa.nombres_representante, 
							Empresa.apellidos_representante, 
							Empresa.email_representante, 
							Empresa.celular_personal, 
							Empresa.telefono, 
							Empresa.celular_trabajo, 
							Empresa.fax, 
							Empresa.direccion, 
							Empresa.direccion_2, 
							Pay_Account.pay_id, 
							Tipo_Empresa.nombre_tipo_empresa");
		$this->db->join('Pay_Account', 'Pay_Account.id_pay_account = Empresa.id_pay_account');
		$this->db->join('Tipo_Empresa', 'Tipo_Empresa.id_tipo_empresa = Empresa.id_tipo_empresa');
		$this->db->where('Empresa.estado', '1');
		$this->db->where('Empresa.id_empresa', $id_empresa);
		$query = $this->db->get('Empresa');
		return $query->result();
	}

	public function insertEmpresa($id_tipo_empresa, $id_usuario, $nombre_empresa) {
		$data = array(
			'id_tipo_empresa'			=> $id_tipo_empresa, 
			'id_usuario'				=> $id_usuario,
			'nombre_empresa'			=> $nombre_empresa
		);
		if ($this->db->insert('Empresa', $data)) {
			return $this->db->insert_id();
		}
		
		return FALSE;
	}

	public function insertUsuario($email_usuario, $password_usuario) {
		$data = array(
			'email_usuario'			 => $email_usuario, 
			'password_usuario'		 => $password_usuario,
			'id_tipo_usuario'		 => '2',
			'fecha_registro_usuario' => date("Y-m-d")
		);
		if ($this->db->insert('Usuario', $data)) {
			return $this->db->insert_id();
		}
		
		return FALSE;
	}
	public function insertPersona($id_usuario, $nombres_persona, $apellido_persona) {
		$data = array(
			'id_usuario'         => $id_usuario, 
			'nombres_persona'    => $nombres_persona, 
			'apellidos_persona'  => $apellido_persona
			
		);
		if ($this->db->insert('Persona', $data)) {
			return $this->db->insert_id();
		}
		
		return FALSE;
	}

	public function insertArchivo($dataArchivo) {
		$data = array(
			'url_archivo'			=> $dataArchivo["url_archivo"],
			'tipo_archivo'			=> $dataArchivo["tipo_archivo"],
			'relacion_recurso'	    => $dataArchivo["relacion_recurso"],
			'nombre_archivo'	    => $dataArchivo["nombre_archivo"]
		);
		if ($this->db->insert('Archivo', $data)) {
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

	public function updateIDLogo($id_empresa, $id_archivo_logo) {
		$data = array(
			'id_archivo_logo'		=> $id_archivo_logo
		);

		$this->db->where('Empresa.id_empresa', $id_empresa);
		if ($this->db->update('Empresa', $data)) {
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