<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Login extends CI_Model{
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function signIn($nombre_usuario) {
		$this->db->select("usuario.id, usuario.nombre, usuario.contrasenia");
		$this->db->where('usuario.nombre', $nombre_usuario);
		$this->db->where('usuario.estado', '1');
		$query = $this->db->get('usuario');
		return $query->result();
	}

	public function signOut($nombre_usuario) {
		$this->db->select("usuario.nombre, usuario.contrasenia");
		$this->db->where('usuario.nombre', $nombre_usuario);
		$query = $this->db->get('usuario');
		return $query->result();
	}
	
}