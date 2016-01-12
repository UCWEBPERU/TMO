<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserSession {
    var $session;
    
    public function loadSession($session){
        $this->session = $session;
    }

	public function validateSession() {
                
		if ($this->session->has_userdata('user_session')) {
			return TRUE;
		} else {
            return FALSE;
        }
        
	}

}