<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_CompanyAdmin_User extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function fetchUser($limit, $start, $id_empresa) {
        $this->db->select("Usuario.id_usuario,
                            Usuario.email_usuario,
							Usuario.fecha_registro_usuario,
							Persona.nombres_persona,
							Persona.apellidos_persona,
							Persona.celular_personal,
							Persona.telefono,
							Persona.celular_trabajo");
        $this->db->join('Usuarios_Asignados', 'Usuarios_Asignados.id_empresa = Empresa.id_empresa');
        $this->db->join('Usuario', 'Usuario.id_usuario = Usuarios_Asignados.id_usuario');
        $this->db->join('Persona', 'Persona.id_usuario = Usuario.id_usuario');
        $this->db->where('Empresa.id_empresa', $id_empresa);
        $this->db->where('Empresa.estado', '1');
        $this->db->where('Usuario.estado', '1');
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

    public function getTotalUser($id_empresa) {
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
        if ($this->db->insert('Sucursales', $data)) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

}