<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Store_Home extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getCompanyAndStore($data) {
        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
        $this->db->where('Empresa.id_empresa', $data["id_empresa"]);
        $this->db->where('Tienda.id_tienda', $data["id_tienda"]);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $query = $this->db->get('Empresa');

        return $query->result();
    }

    public function getPrimaryCategories($id_empresa) {
        $this->db->where('Categoria_Productos.id_empresa', $id_empresa);
        $this->db->where('Categoria_Productos.estado', '1');
        $this->db->where('Categoria_Productos.nivel_categoria', '1');
        $this->db->order_by('Categoria_Productos.nombre_categoria', 'asc');
        $query = $this->db->get('Categoria_Productos');

        return $query->result();
    }

    public function getSubCategories($data) {
        $this->db->where('Categoria_Productos.id_empresa', $data["id_empresa"]);
        $this->db->where('Categoria_Productos.id_categoria_superior', $data["id_categoria_superior"]);
        $this->db->where('Categoria_Productos.estado', '1');
        $this->db->order_by('Categoria_Productos.nombre_categoria', 'asc');
        $query = $this->db->get('Categoria_Productos');

        return $query->result();
    }



}