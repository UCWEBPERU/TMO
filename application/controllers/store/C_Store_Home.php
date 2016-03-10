<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('store/M_Store_Home');
    }

    public function index() {

        $modulo = new stdClass();

        $dataEmpresa = $this->M_Store_Home->getCompanyAndStore(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4)
            )
        );

        if (sizeof($dataEmpresa) == 0) {
            redirect("not-found/store");
        }

        $dataCategorias = $this->M_Store_Home->getPrimaryCategories($this->uri->segment(2));
        $modulo->data_categorias = $dataCategorias;

        if (sizeof($dataCategorias) > 0) {
            $dataSubCategorias = $this->M_Store_Home->getSubCategories(
                array(
                    "id_empresa"            => $this->uri->segment(2),
                    "id_categoria_superior" => $dataCategorias[0]->id_categoria
                )
            );

            $modulo->sub_categorias = $dataSubCategorias;
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-home', $data);
    }

}