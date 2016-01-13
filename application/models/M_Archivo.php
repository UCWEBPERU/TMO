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
	
}
