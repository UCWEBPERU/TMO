<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_Admin_Paquetes_TMO extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function fetchPaquetesTMO($limit, $start) {
        $this->db->where('Paquetes_TMO.estado', '1');
        $this->db->limit($limit, $start);
        $query = $this->db->get('Paquetes_TMO');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return FALSE;
    }

    public function getTotalPaquetesTMO() {
        $this->db->where('Paquetes_TMO.estado', '1');
        $query = $this->db->get('Paquetes_TMO');
        return $query->num_rows();
    }

    public function getPaqueteTMOByID($id_paquete_tmo) {
        $this->db->where('Paquetes_TMO.estado', '1');
        $this->db->where('Paquetes_TMO.id_paquetes_tmo', $id_paquete_tmo);
        $query = $this->db->get('Paquetes_TMO');
        return $query->result();
    }

    public function getPaqueteTMOByName($name_paquete_tmo) {
        $this->db->where('Paquetes_TMO.estado', '1');
        $this->db->where('Paquetes_TMO.nombre_paquete', $name_paquete_tmo);
        $query = $this->db->get('Paquetes_TMO');
        return $query->result();
    }

    public function insert($paquete_tmo) {
        $data = array(
            'nombre_paquete'        => $paquete_tmo["nombre_paquete"],
            'descripcion_paquete'   => $paquete_tmo["descripcion_paquete"],
            'total_store'           => $paquete_tmo["total_store"],
            'total_products'        => $paquete_tmo["total_products"],
            'total_users'           => $paquete_tmo["total_users"],
            'total_categorias'      => $paquete_tmo["total_categorias"],
            'tiempo_meses_paquete'  => $paquete_tmo["tiempo_meses_paquete"],
            'precio_paquete'        => $paquete_tmo["precio_paquete"]
        );

        if ($this->db->insert('Paquetes_TMO', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    public function update($paquete_tmo) {
        $data = array(
            'nombre_paquete'        => $paquete_tmo["nombre_paquete"],
            'descripcion_paquete'   => $paquete_tmo["descripcion_paquete"],
            'total_store'           => $paquete_tmo["total_store"],
            'total_products'        => $paquete_tmo["total_products"],
            'total_users'           => $paquete_tmo["total_users"],
            'total_categorias'      => $paquete_tmo["total_categorias"],
            'tiempo_meses_paquete'  => $paquete_tmo["tiempo_meses_paquete"],
            'precio_paquete'        => $paquete_tmo["precio_paquete"]
        );

        $this->db->where('Paquetes_TMO.id_paquetes_tmo', $paquete_tmo["id_paquete_tmo"]);
        if ($this->db->update('Paquetes_TMO', $data)) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete($id_paquete_tmo) {
        $this->db->where('Paquetes_TMO.id_paquetes_tmo', $id_paquete_tmo);
        if ($this->db->update('Paquetes_TMO', array('Paquetes_TMO.estado' => 0)))	{
            return TRUE;
        }
        return FALSE;
    }
}