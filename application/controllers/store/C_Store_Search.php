<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('store/M_Store');
    }

    public function index() {
        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);

        $dataEmpresa = $this->M_Store->getCompanyAndStore(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4)
            )
        );

        if (sizeof($dataEmpresa) == 0) {
            redirect("not-found/store");
        }

        $modulo->data_empresa = $dataEmpresa[0];

        $dataCategorias = $this->cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;

        if (sizeof($dataCategorias) > 0) {
            $dataSubCategorias = $this->M_Store->getCategories(
                array(
                    "id_empresa"    => $this->uri->segment(2)
                )
            );

            var_dump($dataSubCategorias);
            $dataSubCategorias = $this->seleccionarSubCategorias($dataSubCategorias);
            var_dump($dataSubCategorias);

        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-search', $data);
    }

    public function cargarDatosCategoriasPrincipales() {
        return $this->M_Store->getPrimaryCategories($this->uri->segment(2));
    }

    public function seleccionarSubCategorias($dataSubCategorias) {
        $listaSubCategorias = array();
        for ( $c = 0; $c < sizeof($dataSubCategorias); $c++ ) {
//            if ( intval($dataSubCategorias[$c]->nivel_categoria) == 1 ) { // Buscar Categorias principales
//                array_splice($dataSubCategorias, $c, 1);
//            }
            if ( intval($dataSubCategorias[$c]->nivel_categoria) != 1 ) { // Buscar Sub Categorias
                array_push($listaSubCategorias, $dataSubCategorias[$c]);
            }
        }
        return $listaSubCategorias;
    }

}