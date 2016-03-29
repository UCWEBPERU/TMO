<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_CompanyAdmin_Promotion extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function fetchProduct($limit, $start, $id_empresa) {
        $this->db->select("Producto.id_producto,
                            Producto.nombre_producto,
                            Producto.descripcion_producto,
                            Producto.stock,
                            Producto.precio_producto,
                            Oferta.id_oferta,
                            Oferta.precio_oferta,
							Tienda.nombre_tienda");
        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_tienda = Tienda.id_tienda');
        $this->db->join('Producto', 'Producto.id_producto = Catalogo_Productos.id_producto');
        $this->db->join('Oferta', 'Oferta.id_oferta = Producto.id_oferta');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
        $this->db->where('Oferta.estado', '1');
        $this->db->group_by('Catalogo_Productos.id_producto');
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

    public function getTotalProduct($id_empresa) {
        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_tienda = Tienda.id_tienda');
        $this->db->join('Producto', 'Producto.id_producto = Catalogo_Productos.id_producto');
        $this->db->join('Oferta', 'Oferta.id_oferta = Producto.id_oferta');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
        $this->db->where('Oferta.estado', '1');
        $query = $this->db->get('Empresa');
        return $query->num_rows();
    }

    public function getProducts($id_empresa) {
        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_tienda = Tienda.id_tienda');
        $this->db->join('Producto', 'Producto.id_producto = Catalogo_Productos.id_producto');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Producto.id_oferta', NULL);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
        $query = $this->db->get('Empresa');
        return $query->result();
    }

    public function getProductByPromotion($data_producto) {
        $this->db->select("Producto.id_producto,
							Producto.nombre_producto,
							Producto.descripcion_producto,
							Producto.stock,
							Producto.precio_producto,
							Oferta.id_oferta,
							Oferta.precio_oferta,
							Oferta.fecha_inicio,
							Oferta.fecha_fin,
							Oferta.descripcion_oferta");
        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_tienda = Tienda.id_tienda');
        $this->db->join('Producto', 'Producto.id_producto = Catalogo_Productos.id_producto');
        $this->db->join('Oferta', 'Oferta.id_oferta = Producto.id_oferta');
        $this->db->where('Empresa.id_empresa', $data_producto["id_empresa"] );
        $this->db->where('Oferta.id_oferta', $data_producto["id_oferta"]);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
        $this->db->where('Oferta.estado', '1');
        $query = $this->db->get('Empresa');
        return $query->result();
    }

    public function getGalleryByProduct($data_producto) {
        $this->db->join('Galeria_Producto', 'Galeria_Producto.id_archivo = Archivo.id_archivo');
        $this->db->where('Galeria_Producto.id_producto', $data_producto["id_producto"] );
        $this->db->where('Archivo.estado', '1');
        $query = $this->db->get('Archivo');
        return $query->result();
    }

    public function insertPromotion($promotion) {
        $data = array(
            'precio_oferta'         => $promotion["precio_oferta"],
            'fecha_inicio'          => $promotion["fecha_inicio"],
            'fecha_fin'             => $promotion["fecha_fin"],
            'descripcion_oferta'    => $promotion["descripcion_oferta"]
        );

        if ($this->db->insert('Oferta', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function updatePromotion($promotion) {
        $data = array(
            'precio_oferta'         => $promotion["precio_oferta"],
            'fecha_inicio'          => $promotion["fecha_inicio"],
            'fecha_fin'             => $promotion["fecha_fin"],
            'descripcion_oferta'    => $promotion["descripcion_oferta"]
        );

        $this->db->where('id_oferta', $promotion["id_oferta"]);
        if ($this->db->update('Oferta', $data)) {
            return TRUE;
        }

        return FALSE;

        return FALSE;
    }

    public function deletePromotion($promotion) {
        $data = array(
            'estado' => 0
        );

        $this->db->where('id_oferta', $promotion["id_oferta"]);
        if ($this->db->update('Oferta', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function updatePromotionOnProduct($promotion) {
        $data = array(
            'id_oferta' => $promotion["id_oferta"]
        );

        $this->db->where('id_producto', $promotion["id_producto"]);
        if ($this->db->update('Producto', $data)) {
            return TRUE;
        }

        return FALSE;
    }

}