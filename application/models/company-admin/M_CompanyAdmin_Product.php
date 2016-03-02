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

    public function getSuscripcionPaqueteTMO($id_empresa) {
        $this->db->join('Suscripcion_Paquete_TMO', 'Suscripcion_Paquete_TMO.id_empresa = Empresa.id_empresa');
        $this->db->join('Paquetes_TMO', 'Paquetes_TMO.id_paquetes_tmo = Suscripcion_Paquete_TMO.id_paquete_tmo');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Paquetes_TMO.estado', '1');
        $query = $this->db->get('Empresa');
        return $query->result();
    }

    public function getTotalProduct($id_empresa) {
        $this->db->join('Usuarios_Asignados', 'Usuarios_Asignados.id_empresa = Empresa.id_empresa');
        $this->db->join('Usuario', 'Usuario.id_usuario = Usuarios_Asignados.id_usuario');
        $this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Usuario.estado', '1');
        $query = $this->db->get('Empresa');
        return $query->num_rows();
    }

    public function insertUsuario($data) {
        $data = array(
            'id_tipo_usuario'  => 2,
            'email_usuario'    => $data["email_usuario"],
            'password_usuario' => $data["password_usuario"]
        );

        if ($this->db->insert('Usuario', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function updateUsuario($datosUsuario) {
        $data = array(
            'nombres_persona'   => $datosUsuario["nombres_persona"],
            'apellidos_persona' => $datosUsuario["apellidos_persona"],
            'celular_personal'	=> $datosUsuario["celular_personal"],
            'telefono'	        => $datosUsuario["telefono"],
            'celular_trabajo'	=> $datosUsuario["celular_trabajo"],
            'direccion_persona' => $datosUsuario["direccion_persona"],
            'pais_persona'      => $datosUsuario["pais_persona"],
            'region_persona'    => $datosUsuario["region_persona"],
            'ciudad_persona'    => $datosUsuario["ciudad_persona"]
        );

        $this->db->where('Persona.id_usuario', $datosUsuario["id_usuario"]);
        if ($this->db->update('Persona', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function updatePassWordUsuario($dataUsuario) {
        $data = array(
            'password_usuario' => $dataUsuario["password_usuario"]
        );

        $this->db->where('Usuario.id_usuario', $dataUsuario["id_usuario"]);
        if ($this->db->update('Usuario', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function insertPersona($data) {
        $data = array(
            'id_usuario'		    => $data["id_usuario"],
            'nombres_persona'		=> $data["nombres_persona"],
            'apellidos_persona'		=> $data["apellidos_persona"],
            'pais_persona'			=> $data["pais_persona"],
            'region_persona'		=> $data["region_persona"],
            'ciudad_persona'		=> $data["ciudad_persona"],
            'direccion_persona'		=> $data["direccion_persona"],
            'celular_personal'		=> $data["celular_personal"],
            'telefono'				=> $data["telefono"],
            'celular_trabajo'		=> $data["celular_trabajo"]
        );

        if ($this->db->insert('Persona', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function insertUsuariosAsignados($data) {
        $data = array(
            "id_empresa" => $data["id_empresa"],
            "id_usuario" => $data["id_usuario"]
        );
        if ($this->db->insert('Usuarios_Asignados', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

}