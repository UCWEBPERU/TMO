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

    public function getCategoriesByCompanyAndStore($data) {
//        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
//        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
//        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_tienda = Tienda.id_tienda');
//        $this->db->join('Producto', 'Producto.id_producto = Catalogo_Productos.id_producto');
//        $this->db->join('Categoria_Productos', 'Categoria_Productos.id_categoria = Producto.id_categoria');
//        $this->db->where('Empresa.id_empresa', $data["id_empresa"]);
//        $this->db->where('Tienda.id_tienda', $data["id_tienda"]);
//        $this->db->where('Empresa.estado', '1');
//        $this->db->where('Tienda.estado', '1');
//        $this->db->where('Producto.estado', '1');
//        $this->db->where('Categoria_Productos.estado', '1');
//        $query = $this->db->get('Empresa');
//
//        return $query->result();


        $this->db->join('Producto', 'Producto.id_categoria = Categoria_Productos.id_categoria');
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_producto = Producto.id_producto');
        $this->db->join('Tienda', 'Tienda.id_tienda = Catalogo_Productos.id_tienda');
        $this->db->join('Sucursales', 'Sucursales.id_tienda = Tienda.id_tienda');
        $this->db->join('Empresa', 'Empresa.id_empresa = Sucursales.id_empresa');
        $this->db->where('Empresa.id_empresa', $data["id_empresa"]);
        $this->db->where('Tienda.id_tienda', $data["id_tienda"]);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
        $this->db->where('Categoria_Productos.estado', '1');
        $query = $this->db->get('Empresa');

        return $query->result();
    }

}