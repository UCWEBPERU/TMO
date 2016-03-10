<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('M_Store_Home');
    }

    public function index() {

        $dataEmpresa = $this->M_Store_Home->getCompanyAndStore(
            array(
                "id_empresa" => $this->uri->segment(2),
                "id_tienda" => $this->uri->segment(4)
            )
        );

        if (sizeof($dataEmpresa) == 0) {
            redirect("not-found/store");
        }

        $this->load->view('store/v-store-home');
    }

}