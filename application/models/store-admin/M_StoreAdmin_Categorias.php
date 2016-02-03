<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_StoreAdmin_Categorias extends CI_Model{
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
    
    public function getAllCategories($id_empresa) {
		$this->db->where('Categoria_Productos.id_empresa', $id_empresa);
		$this->db->where('Categoria_Productos.estado', '1');
		$this->db->where('Categoria_Productos.nivel_categoria', 'categoria');
		$query = $this->db->get('Categoria_Productos');
        return $query->result();
    }
    
    public function getSubCategoryByIDCategory($id_category) {
		$this->db->where('Categoria_Productos.id_categoria_superior', $id_category);
		$this->db->where('Categoria_Productos.estado', '1');
		$this->db->where('Categoria_Productos.nivel_categoria', 'subcategoria');
		$query = $this->db->get('Categoria_Productos');
        return $query->result();
    }
    
    public function getPayAccountByID($id_pay_account) {
        $this->db->where('id_pay_account', $id_pay_account);
        $this->db->where('estado', '1');
		$query = $this->db->get('Pay_Account');
		return $query->result();
    }

}

