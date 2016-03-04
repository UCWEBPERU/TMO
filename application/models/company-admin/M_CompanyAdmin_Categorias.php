<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_CompanyAdmin_Categorias extends CI_Model {
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
    
    public function getAllCategorys($category_data) {
		$this->db->where('Categoria_Productos.id_empresa', $category_data["id_empresa"]);
		$this->db->where('Categoria_Productos.estado', '1');
		$this->db->where('Categoria_Productos.nivel_categoria', $category_data["nivel_categoria"]);
		$query = $this->db->get('Categoria_Productos');
        return $query->result();
    }
    
    public function getSubCategoryByIDCategory($category_data) {
		$this->db->where('Categoria_Productos.id_empresa', $category_data["id_empresa"]);
		$this->db->where('Categoria_Productos.id_categoria_superior', $category_data["id_categoria_superior"]);
		$this->db->where('Categoria_Productos.estado', '1');
		$this->db->where('Categoria_Productos.nivel_categoria', 'subcategoria');
		$query = $this->db->get('Categoria_Productos');
        return $query->result();
    }

	public function getCategoryByCategoriaSuperior($category_data) {
		$this->db->where('Categoria_Productos.id_empresa', $category_data["id_empresa"]);
		$this->db->where('Categoria_Productos.id_categoria_superior', $category_data["id_categoria_superior"]);
		$this->db->where('Categoria_Productos.estado', '1');
		$query = $this->db->get('Categoria_Productos');
		return $query->result();
	}
    
    public function getCategorysByName($category_data) {
		$this->db->where('Categoria_Productos.id_empresa', $category_data["id_empresa"]);
		$this->db->where('Categoria_Productos.nombre_categoria', $category_data["nombre_categoria"]);
		$this->db->where('Categoria_Productos.estado', '1');
		$query = $this->db->get('Categoria_Productos');
        return $query->result();
    }
    
   public function getCategoryByIDAndNivel($category_data) {
		$this->db->where('Categoria_Productos.id_empresa', $category_data["id_empresa"]);
		$this->db->where('Categoria_Productos.id_categoria', $category_data["id_categoria"]);
		$this->db->where('Categoria_Productos.nivel_categoria', $category_data["nivel_categoria"]);
		$this->db->where('Categoria_Productos.estado', '1');
		$query = $this->db->get('Categoria_Productos');
        return $query->result();
    }
    
    public function getCategoryByID($category_data) {
		$this->db->where('Categoria_Productos.id_empresa', $category_data["id_empresa"]);
		$this->db->where('Categoria_Productos.id_categoria', $category_data["id_categoria"]);
		$this->db->where('Categoria_Productos.estado', '1');
		$query = $this->db->get('Categoria_Productos');
        return $query->result();
    }
    
    public function deleteCategoryByID($category_data) {
		$this->db->where('Categoria_Productos.id_empresa', $category_data["id_empresa"]);
		$this->db->where('Categoria_Productos.id_categoria', $category_data["id_categoria"]);
		if ($this->db->update('Categoria_Productos', array('Categoria_Productos.estado'=> 0)))	{
			return TRUE;
		}
		return FALSE;
	}
    
    public function updateNameCategory($category_data) {
		$this->db->where('Categoria_Productos.id_empresa', $category_data["id_empresa"]);
		$this->db->where('Categoria_Productos.id_categoria', $category_data["id_categoria"]);
		if ($this->db->update('Categoria_Productos', array('Categoria_Productos.nombre_categoria'=> $category_data["nombre_categoria"])))	{
			return TRUE;
		}
		return FALSE;
	}
    
    public function insertCategory($category_data) {
        $data = array(
			'id_categoria_superior'  => $category_data["id_categoria_superior"],
			'id_empresa'             => $category_data["id_empresa"],
			'nombre_categoria'       => $category_data["nombre_categoria"],
			'nivel_categoria'        => $category_data["nivel_categoria"]
		);

		if ($this->db->insert('Categoria_Productos', $data)) {
			return $this->db->insert_id();
		}
		
		return FALSE;
    }
    
}