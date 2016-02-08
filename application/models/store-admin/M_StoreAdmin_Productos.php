<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_StoreAdmin_Productos extends CI_Model{
    
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
    
	public function fetchProductos($limit, $start, $id_empresa) {
		$this->db->select("Producto.id_producto,
            Producto.nombre_producto,
            Producto.descripcion_producto,
            Producto.stock,
            Producto.precio_producto,
            Producto.id_categoria");		
		$this->db->join('Catalogo_Productos','Catalogo_Productos.id_producto = Producto.id_producto');
		$this->db->join('Empresa','Empresa.id_empresa = Catalogo_Productos.id_empresa');
		$this->db->where('Empresa.id_empresa', $id_empresa);
		$this->db->where('Producto.estado', '1');
		$this->db->limit($limit, $start);
		$query = $this->db->get('Producto');

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		
		return FALSE;
	}

	public function getTotalProductos($id_empresa) {
		$this->db->join('Catalogo_Productos','Catalogo_Productos.id_producto = Producto.id_producto');
		$this->db->join('Empresa','Empresa.id_empresa = Catalogo_Productos.id_empresa');
		$this->db->where('Empresa.id_empresa', $id_empresa);
		$this->db->where('Producto.estado', '1');
		$query = $this->db->get('Producto');
		return $query->num_rows();
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
			'id_categoria'        => $data_producto["id_categoria"],
			'nombre_producto'     => $data_producto["nombre_producto"],
			'descripcion_producto' => $data_producto["descripcion_producto"],
			'stock'               => $data_producto["stock"],
            'precio_producto'     => $data_producto["precio_producto"]
		);

		if ($this->db->insert('Producto', $data)) {
			return $this->db->insert_id();
		}
		
		return FALSE;
    }
    
    public function insertDatosCatalogoProductos($data_catalogo_producto) {
        $data = array(
			'id_empresa'  => $data_catalogo_producto["id_empresa"],
			'id_producto' => $data_catalogo_producto["id_producto"]
		);

		if ($this->db->insert('Catalogo_Productos', $data)) {
			return TRUE;
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