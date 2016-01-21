<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserSession {
    
    var $CI;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->library("session");
    }
    
    public function validateSession($section_name) {
        switch ($section_name) {
            case 'panel-admin':
                $this->validatePanelAdmin();
                break;
            case 'panel-store-admin':
                $this->validatePanelStoreAdmin();
                break;
        }
    }

	public function validateTypeUser() {
		if ($this->CI->session->has_userdata('user_session')) {
            if ($this->CI->session->nombre_tipo_usuario == "SuperAdministrador") {
                return 1;
            } else if ($this->CI->session->nombre_tipo_usuario == "Administrador") {
                return 2;
            }
		} else {
            return FALSE;
        }
	}
    
    private function validatePanelAdmin() {
        if (!$this->validateTypeUser()) {
            redirect("/admin/login");
        } else {
            if ($this->validateTypeUser() == 2) {
                redirect("/store/".$this->CI->session->id_empresa."/admin");
            }
        }
    }
    
    private function validatePanelStoreAdmin() {
        if (!$this->validateTypeUser()) {
            redirect("/store/".$this->CI->uri->segment(2)."/admin/login");
        } else {
            if ($this->validateTypeUser() != 2) {
                $this->CI->load->model('M_Empresa');
                
                if ($this->CI->session->id_empresa != "") {
                    $dataEmpresa = $this->CI->M_Empresa->getByID( $this->CI->session->id_empresa );
                } else {
                    $dataEmpresa = $this->CI->M_Empresa->getByID( $this->CI->uri->segment(2) );
                }
                
                if (sizeof($dataEmpresa) > 0) {
                    redirect("forbidden-access");
                } else {
                    redirect("not-found/store");
                }
            }
        }
    }

}