<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
//        $this->usersession->validateSession("panel-store");
        $this->load->model('store/M_Store');
        $this->load->helper('store/h_store');
    }

    public function index() {
        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);
        $modulo->has_user_session = $this->usersession->isClient();

        $dataEmpresa = $this->M_Store->getCompanyAndStore(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4)
            )
        );

        if (sizeof($dataEmpresa) == 0) {
            redirect("not-found/store");
        }

        if ($this->usersession->isClient()) {
            $dataUsuario = $this->M_Store->getUserBYEmail(
                array(
                    "email_usuario" => $this->session->email_usuario
                )
            );

            if (sizeof($dataUsuario) > 0) {
                $modulo->data_usuario = $dataUsuario[0];
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-account', $data);
    }

    public function accountSettings() {
        $this->load->model('store/M_Archivo');
        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);
        $modulo->has_user_session = $this->usersession->isClient();

        $dataEmpresa = $this->M_Store->getCompanyAndStore(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4)
            )
        );

        if (sizeof($dataEmpresa) == 0) {
            redirect("not-found/store");
        }

        if ($this->usersession->isClient()) {
            $dataUsuario = $this->M_Store->getUserBYEmail(
                array(
                    "email_usuario" => $this->session->email_usuario
                )
            );

            if (sizeof($dataUsuario) > 0) {
                $modulo->data_usuario = $dataUsuario[0];
            }

            cargarLogoEmpresa($modulo, $dataEmpresa[0]);
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-account-settings', $data);
    }

}