<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Tipo_Empresa extends CI_Model{
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getTipoEmpresa() {
		$this->db->where('estado', '1');
		$query = $this->db->get('Tipo_Empresa');
		return $query->result();
	}
	
}