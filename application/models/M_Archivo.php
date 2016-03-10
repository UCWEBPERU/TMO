<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Archivo extends CI_Model{
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getByID($id_archivo) {
		$this->db->where('id_archivo', $id_archivo);
		$this->db->where('estado', '1');
		$query = $this->db->get('Archivo');

		return $query->result();
	}

	public function insert($data) {
		$data = array(
			'url_archivo'		=> $data["url_archivo"],
			'tipo_archivo'		=> $data["tipo_archivo"],
			'relacion_recurso'	=> $data["relacion_recurso"],
			'nombre_archivo'	=> $data["nombre_archivo"]
		);

		if ($this->db->insert('Archivo', $data)) {
			return $this->db->insert_id();
		}

		return FALSE;
	}

	public function updateURLArchivo($url) {
		$data = array(
			'url_archivo' => $url["url_archivo"]
		);

		$this->db->where('id_archivo', $url["id_archivo"]);
		if ($this->db->update('Archivo', $data)) {
			return TRUE;
		}

		return FALSE;
	}
	
}
