<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserSession extends CI_Controller {
    // var $session;
    // 
    // public function loadSession($session){
    //     $this->session = $session;
    // }

	public function validateSessionEntry($url_redirect) {
                
		if ($this->session->has_userdata('user_session')) {
			redirect($url_redirect);
		} else {
			$this->load->view('login');
		}
        
	}
    
    public function validateSessionBack($name_view) {
        
		if ($this->session->has_userdata('user_session')) {
            $this->load->view($name_view);
		} else {
			redirect("/login");
		}
        
	}

}