<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_CompanyAdmin_Product extends CI_Model {

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
							Tienda.nombre_tienda");
        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_tienda = Tienda.id_tienda');
        $this->db->join('Producto', 'Producto.id_producto = Catalogo_Productos.id_producto');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
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

    public function getAllStore($id_empresa) {
        $this->db->select("Tienda.id_tienda,
							Tienda.nombre_tienda,
							Tienda.nro_celular,
							Tienda.nro_telefono,
							Tienda.pais,
							Tienda.region,
							Tienda.ciudad,
							Tienda.direccion,
							Tienda.gps_latitud,
							Tienda.gps_longitud,
							Pay_Account.id_pay_account,
							Pay_Account.pay_id,
							Pay_Account.tipo_metodo_pago");
        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
        $this->db->join('Pay_Account', 'Pay_Account.id_pay_account = Tienda.id_tienda');
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Pay_Account.estado', '1');
        $this->db->where('Empresa.id_empresa', $id_empresa);
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
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $this->db->where('Producto.estado', '1');
        $query = $this->db->get('Empresa');
        return $query->num_rows();
    }

    public function getProductByID($data_producto) {
        $this->db->join('Catalogo_Productos', 'Catalogo_Productos.id_producto = Producto.id_producto');
        $this->db->where('Catalogo_Productos.id_empresa', $data_producto["id_empresa"] );
        $this->db->where('Producto.id_producto', $data_producto["id_producto"]);
        $this->db->where('Producto.estado', '1');
        $query = $this->db->get('Producto');
        return $query->result();
    }

    public function getGalleryByProduct($data_producto) {
        $this->db->join('Galeria_Producto', 'Galeria_Producto.id_archivo = Archivo.id_archivo');
        $this->db->where('Galeria_Producto.id_producto', $data_producto["id_producto"] );
        $this->db->where('Archivo.estado', '1');
        $query = $this->db->get('Archivo');
        return $query->result();
    }

    public function updateDatosEmpresa($data_empresa) {
        $data = array(
            'nombre_empresa'			=> $data_empresa["nombre_empresa"],
            'id_tipo_empresa'			=> $data_empresa["id_tipo_empresa"],
            'descripcion_empresa'		=> $data_empresa["descripcion_empresa"],
            'direccion_empresa'			=> $data_empresa["direccion_empresa"],
            'pais_region_empresa'		=> $data_empresa["pais_region_empresa"],
            'estado_region_empresa'		=> $data_empresa["estado_region_empresa"],
            'codigo_postal_empresa'		=> $data_empresa["codigo_postal_empresa"],
            'telefono_empresa'			=> $data_empresa["telefono_empresa"],
            'movil_empresa'				=> $data_empresa["movil_empresa"]
        );

        $this->db->where('id_empresa', $data_empresa["id_empresa"]);
        if ($this->db->update('Empresa', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function insertDatosProducto($data_producto) {
        $data = array(
            'id_categoria'          => $data_producto["id_categoria"],
            'nombre_producto'       => $data_producto["nombre_producto"],
            'descripcion_producto'  => $data_producto["descripcion_producto"],
            'stock'                 => $data_producto["stock"],
            'precio_producto'       => $data_producto["precio_producto"]
        );

        if ($this->db->insert('Producto', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function insertModificadorProductos($data) {
        $data = array(
            'tipo_modificador' => $data["tipo_modificador"]
        );

        if ($this->db->insert('Modificador_Productos', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function insertDetalleModificadorProductos($data) {
        $data = array(
            'id_modificador_productos'  => $data["id_modificador_productos"],
            'id_producto'               => $data["id_producto"],
            'descripcion_modificador'   => $data["descripcion_modificador"],
            'costo_modificador'         => $data["costo_modificador"],
            'stock'                     => $data["stock"]
        );

        if ($this->db->insert('Detalle_Modificador_Productos', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function insertDatosCatalogoProductos($data_catalogo_producto) {
        $data = array(
            'id_tienda'   => $data_catalogo_producto["id_tienda"],
            'id_producto' => $data_catalogo_producto["id_producto"]
        );

        if ($this->db->insert('Catalogo_Productos', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function insertGaleriaProducto($data_galeria_producto) {
        $data = array(
            'id_producto' => $data_galeria_producto["id_producto"],
            'id_archivo'  => $data_galeria_producto["id_archivo"]
        );

        if ($this->db->insert('Galeria_Producto', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function insertImagenProducto($data_galeria_producto) {
        $data = array(
            'url_archivo'      => $data_galeria_producto["url_archivo"],
            'tipo_archivo'     => $data_galeria_producto["tipo_archivo"],
            'relacion_recurso' => $data_galeria_producto["relacion_recurso"],
            'nombre_archivo'   => $data_galeria_producto["nombre_archivo"]
        );

        if ($this->db->insert('Archivo', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function updateDatosPayAccount($data_pay_account) {
        $data = array(
            'pay_id'             => $data_pay_account["pay_id"],
            'tipo_metodo_pago'   => $data_pay_account["tipo_metodo_pago"]
        );

        $this->db->where('id_pay_account', $data_pay_account["id_pay_account"]);
        if ($this->db->update('Pay_Account', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function updateIDPayAccountOnEmpresa($data_pay_account) {
        $data = array(
            'id_pay_account' => $data_pay_account["id_pay_account"]
        );

        $this->db->where('id_empresa', $data_pay_account["id_empresa"]);
        if ($this->db->update('Empresa', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function updateLogoOnEmpresa($data_logo_empresa) {
        $data = array(
            'url_archivo' => $data_logo_empresa["url_archivo"]
        );

        $this->db->where('id_archivo', $data_logo_empresa["id_archivo"]);
        if ($this->db->update('Archivo', $data)) {
            return TRUE;
        }

        return FALSE;
    }

}