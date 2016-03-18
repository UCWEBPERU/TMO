<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Sign_In extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('store/h_store');
        $this->load->library('session');
        $this->load->library('user_agent');
        $this->load->model('store/M_Store');
        $this->load->model("M_Archivo");
    }

    public function index() {
        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);
        $modulo->previuos_url = $this->agent->referrer();

        $dataEmpresa = $this->M_Store->getCompanyAndStore(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4)
            )
        );

        if (sizeof($dataEmpresa) == 0) {
            redirect("not-found/store");
        }

        cargarLogoEmpresa($modulo, $dataEmpresa[0]);

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-sign-in', $data);
    }

    public function signOut() {
        $sessionUser = array(
            'user_session',
            'id_usuario',
            'nombres_usuario',
            'apellidos_usuario',
            'email_usuario',
            'id_tipo_usuario',
            'nombre_tipo_usuario'
        );
        $this->session->unset_userdata($sessionUser);
        $this->session->sess_destroy();
        $urlAccount = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4)."/account";
        redirect($urlAccount);
    }

}