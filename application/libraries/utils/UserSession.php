<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserSession {
    var $session;
    
    public function loadSession($session){
        $this->session = $session;
    }

	public function validateSession() {
                
		if ($this->session->has_userdata('user_session')) {
            
            if ($this->session->nombre_tipo_usuario == "SuperAdministrador") {
                return 1;
            } else if ($this->session->nombre_tipo_usuario == "Administrador") {
                return 2;
            }
            
		} else {
            return FALSE;
        }
        
	}

}