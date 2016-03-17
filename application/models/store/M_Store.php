<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Store extends CI_Model {

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

    public function getCategories($data) {
        $this->db->where('Categoria_Productos.id_empresa', $data["id_empresa"]);
        $this->db->where('Categoria_Productos.estado', '1');
        $this->db->order_by('Categoria_Productos.nombre_categoria', 'asc');
        $query = $this->db->get('Categoria_Productos');

        return $query->result();
    }

    public function getCategory($data) {
        $this->db->where('Categoria_Productos.id_categoria', $data["id_categoria"]);
        $this->db->where('Categoria_Productos.id_empresa', $data["id_empresa"]);
        $this->db->where('Categoria_Productos.estado', '1');
        $query = $this->db->get('Categoria_Productos');

        return $query->result();
    }

    public function getCategoryUp($data) {
        $this->db->where('Categoria_Productos.id_empresa', $data["id_empresa"]);
        $this->db->where('Categoria_Productos.id_categoria', $data["id_categoria"]);
        $this->db->where('Categoria_Productos.id_categoria_superior', $data["id_categoria_superior"]);
        $this->db->where('Categoria_Productos.estado', '1');
        $query = $this->db->get('Categoria_Productos');

        return $query->result();
    }

    public function getPrimaryCategories($id_empresa) {
        $this->db->join('Archivo', 'Archivo.id_archivo = Categoria_Productos.id_imagen_Categoria');
        $this->db->where('Categoria_Productos.id_empresa', $id_empresa);
        $this->db->where('Categoria_Productos.estado', '1');
        $this->db->where('Categoria_Productos.nivel_categoria', '1');
        $this->db->order_by('Categoria_Productos.nombre_categoria', 'asc');
        $query = $this->db->get('Categoria_Productos');

        return $query->result();
    }

    public function getSubCategories($data) {
        $this->db->join('Archivo', 'Archivo.id_archivo = Categoria_Productos.id_imagen_Categoria');
        $this->db->where('Categoria_Productos.id_empresa', $data["id_empresa"]);
        $this->db->where('Categoria_Productos.id_categoria_superior', $data["id_categoria_superior"]);
        $this->db->where('Categoria_Productos.estado', '1');
        $this->db->order_by('Categoria_Productos.nombre_categoria', 'asc');
        $query = $this->db->get('Categoria_Productos');

        return $query->result();
    }

    public function getProducts($data) {
        $this->db->select("Tienda.id_tienda,
                    Producto.id_categoria,
                    Producto.id_producto,
                    Producto.nombre_producto,
                    Producto.descripcion_producto,
                    Producto.stock,
                    Producto.precio_producto,
                    Producto.fecha_registro");
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_producto = Producto.id_producto');
        $this->db->join('Tienda', 'Tienda.id_tienda = Catalogo_Productos.id_tienda');
        $this->db->join('Categoria_Productos', 'Categoria_Productos.id_categoria = Producto.id_categoria');
        $this->db->where('Categoria_Productos.id_empresa', $data["id_empresa"]);
        $this->db->where('Categoria_Productos.id_categoria', $data["id_categoria"]);
        $this->db->where('Tienda.id_tienda', $data["id_tienda"]);
        $this->db->where('Categoria_Productos.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
        $this->db->order_by('Producto.nombre_producto', 'asc');
        $query = $this->db->get('Producto');

        return $query->result();
    }

    public function getGalleryByProduct($data) {
        $this->db->join('Galeria_Producto', 'Galeria_Producto.id_archivo = Archivo.id_archivo');
        $this->db->where('Galeria_Producto.id_producto', $data["id_producto"] );
        $this->db->where('Archivo.estado', '1');
        $query = $this->db->get('Archivo');
        return $query->result();
    }

    public function getProduct($data) {
        $this->db->select("Tienda.id_tienda,
                    Producto.id_categoria,
                    Producto.id_producto,
                    Producto.nombre_producto,
                    Producto.descripcion_producto,
                    Producto.stock,
                    Producto.precio_producto,
                    Producto.fecha_registro");
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_producto = Producto.id_producto');
        $this->db->join('Tienda', 'Tienda.id_tienda = Catalogo_Productos.id_tienda');
        $this->db->join('Categoria_Productos', 'Categoria_Productos.id_categoria = Producto.id_categoria');
        $this->db->where('Categoria_Productos.id_empresa', $data["id_empresa"]);
        $this->db->where('Producto.id_producto', $data["id_producto"]);
        $this->db->where('Tienda.id_tienda', $data["id_tienda"]);
        $this->db->where('Categoria_Productos.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
        $this->db->order_by('Producto.nombre_producto', 'asc');
        $query = $this->db->get('Producto');

        return $query->result();
    }
    public function getProductByName($data) {
        $this->db->select("Tienda.id_tienda,
                    Producto.id_categoria,
                    Producto.id_producto,
                    Producto.nombre_producto,
                    Producto.descripcion_producto,
                    Producto.stock,
                    Producto.precio_producto,
                    Producto.fecha_registro");
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_producto = Producto.id_producto');
        $this->db->join('Tienda', 'Tienda.id_tienda = Catalogo_Productos.id_tienda');
        $this->db->join('Categoria_Productos', 'Categoria_Productos.id_categoria = Producto.id_categoria');
        $this->db->where('Categoria_Productos.id_empresa', $data["id_empresa"]);
        $this->db->where('Tienda.id_tienda', $data["id_tienda"]);
        $this->db->where('Categoria_Productos.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
        $this->db->like('Producto.nombre_producto', $data["nombre_producto"]);
        $this->db->order_by('Producto.nombre_producto', 'asc');
        $query = $this->db->get('Producto');

        return $query->result();
    }

    public function getModifiers($data) {
        $this->db->select("Modificador_Productos.id_modificador_productos,
                    Modificador_Productos.tipo_modificador,
                    Detalle_Modificador_Productos.descripcion_modificador,
                    Detalle_Modificador_Productos.costo_modificador,
                    Detalle_Modificador_Productos.stock");
        $this->db->join('Modificador_Productos', 'Modificador_Productos.id_modificador_productos = Detalle_Modificador_Productos.id_modificador_productos');
        $this->db->join('Producto', 'Producto.id_producto = Detalle_Modificador_Productos.id_producto');
        $this->db->where('Producto.id_producto', $data["id_producto"]);
        $this->db->where('Producto.estado', '1');
        $this->db->where('Producto.estado', '1');
        $this->db->where('Modificador_Productos.estado', '1');
        $this->db->where('Detalle_Modificador_Productos.estado', '1');
        $this->db->order_by('Modificador_Productos.tipo_modificador', 'asc');
        $this->db->order_by('Detalle_Modificador_Productos.descripcion_modificador', 'asc');
        $this->db->group_by('Detalle_Modificador_Productos.descripcion_modificador');
        $query = $this->db->get('Detalle_Modificador_Productos');
        return $query->result();
    }

    public function getUserBYEmail($data) {
        $this->db->select("Modificador_Productos.id_modificador_productos,
                    Modificador_Productos.tipo_modificador,
                    Detalle_Modificador_Productos.descripcion_modificador,
                    Detalle_Modificador_Productos.costo_modificador,
                    Detalle_Modificador_Productos.stock");
        $this->db->join('Modificador_Productos', 'Modificador_Productos.id_modificador_productos = Detalle_Modificador_Productos.id_modificador_productos');
        $this->db->join('Producto', 'Producto.id_producto = Detalle_Modificador_Productos.id_producto');
        $this->db->where('Producto.id_producto', $data["id_producto"]);
        $this->db->where('Producto.estado', '1');
        $this->db->where('Producto.estado', '1');
        $this->db->where('Modificador_Productos.estado', '1');
        $this->db->where('Detalle_Modificador_Productos.estado', '1');
        $this->db->order_by('Modificador_Productos.tipo_modificador', 'asc');
        $this->db->order_by('Detalle_Modificador_Productos.descripcion_modificador', 'asc');
        $this->db->group_by('Detalle_Modificador_Productos.descripcion_modificador');
        $query = $this->db->get('Detalle_Modificador_Productos');
        return $query->result();
    }

}