<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_CompanyAdmin_Store extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();

    }

    public function fetchStore($limit, $start, $id_empresa) {
        $this->db->select("Tienda.id_tienda,
							Tienda.nombre_tienda,
							Tienda.nro_celular,
							Tienda.nro_telefono,
							Tienda.pais,
							Tienda.region,
							Tienda.ciudad,
							Tienda.direccion,
							Tienda.gps_latitud,
							Tienda.gps_longitud");
        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
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

    public function getSuscripcionPaqueteTMO($id_empresa) {
        $this->db->join('Suscripcion_Paquete_TMO', 'Suscripcion_Paquete_TMO.id_empresa = Empresa.id_empresa');
        $this->db->join('Paquetes_TMO', 'Paquetes_TMO.id_paquetes_tmo = Suscripcion_Paquete_TMO.id_paquete_tmo');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Paquetes_TMO.estado', '1');
        $query = $this->db->get('Empresa');
        return $query->result();
    }

    public function getTotalStore($id_empresa) {
        $this->db->join('Sucursales', 'Sucursales.id_empresa = Empresa.id_empresa');
        $this->db->join('Tienda', 'Tienda.id_tienda = Sucursales.id_tienda');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Tienda.estado', '1');
        $query = $this->db->get('Empresa');
        return $query->num_rows();
    }

    public function insertStore($data) {
        $data = array(
            "nombre_tienda"     => $data["nombre_tienda"],
            "nro_celular"       => $data["nro_celular"],
            "nro_telefono"      => $data["nro_telefono"],
            "pais"              => $data["pais"],
            "region"		    => $data["region"],
            "ciudad"		    => $data["ciudad"],
            "direccion"		    => $data["direccion"],
            "gps_latitud"       => $data["gps_latitud"],
            "gps_longitud"      => $data["gps_longitud"],
            "id_pay_account"    => $data["id_pay_account"]
        );
        if ($this->db->insert('Tienda', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function insertSucursales($data) {
        $data = array(
            "id_empresa" => $data["id_empresa"],
            "id_tienda"  => $data["id_tienda"]
        );
        if ($this->db->insert('Sucursales', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function insertPayAccount($data_pay_account) {
        $data = array(
            'pay_id'             => $data_pay_account["pay_id"],
            'tipo_metodo_pago'   => $data_pay_account["tipo_metodo_pago"]
        );

        if ($this->db->insert('Pay_Account', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function updatePayAccount($data_pay_account) {
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


    public function delete($id_empresa) {
        $this->db->where('Empresa.id_empresa', $id_empresa);
        if ($this->db->update('Empresa', array('Empresa.estado'=> 0)))	{
            return TRUE;
        }
        return FALSE;
    }

}