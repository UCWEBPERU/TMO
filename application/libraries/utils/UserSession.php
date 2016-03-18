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
            case 'panel-company-admin':
                $this->validatePanelStoreAdmin();
                break;
            case 'panel-store':
                $this->validatePanelStore();
                break;
        }
    }

	public function validateTypeUser() {
		if ($this->CI->session->has_userdata('user_session')) {
            if ($this->CI->session->nombre_tipo_usuario == "SuperAdministrador") {
                return 1;
            } else if ($this->CI->session->nombre_tipo_usuario == "Administrador") {
                return 2;
            } else if ($this->CI->session->nombre_tipo_usuario == "Cliente") {
                return 3;
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
                redirect("/company/".$this->CI->session->id_empresa."/admin");
            }
            if ($this->validateTypeUser() == 3) {
                redirect("/company/".$this->CI->uri->segment(2)."/store/".$this->CI->uri->segment(4));
            }
        }
    }
    
    private function validatePanelStoreAdmin() {
        if (!$this->validateTypeUser()) {
            redirect("/company/".$this->CI->uri->segment(2)."/admin/login");
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
                    redirect("not-found/company");
                }
            }
        }
    }

    private function validatePanelStore() {
        if (!$this->validateTypeUser() || $this->validateTypeUser() != 3) {
            redirect("/company/".$this->CI->uri->segment(2)."/store/".$this->CI->uri->segment(4)."/signin");
        }
    }

    public function isClient() {
        if ($this->validateTypeUser() == 3) {
            return TRUE;
        }
        return FALSE;
    }

}